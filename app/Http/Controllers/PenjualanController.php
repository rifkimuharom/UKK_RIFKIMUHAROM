<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Menampilkan daftar transaksi penjualan.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');
        $metode = $request->input('metode');

        $sales = Penjualan::query()
            ->with(['user', 'itemPenjualan.produk'])
            ->when($user->role && $user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->when($metode, function ($query) use ($metode) {
                $metodeLower = strtolower($metode);

                $values = [$metodeLower];
                if (in_array($metodeLower, ['tunai', 'cash'])) {
                    $values = ['tunai', 'cash', 'TUNAI', 'CASH', 'Cash', 'Tunai'];
                } elseif ($metodeLower === 'qris') {
                    $values = ['qris', 'QRIS', 'Qris'];
                } elseif ($metodeLower === 'transfer') {
                    $values = ['transfer', 'TRANSFER', 'Transfer'];
                }

                $query->whereIn('metode_pembayaran', $values);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Menampilkan detail transaksi penjualan (Nota / Rincian).
     */
    public function show(Penjualan $penjualan)
    {
        $user = Auth::user();
        if ($user->role && $user->role->name === 'kasir' && $penjualan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        $penjualan->load(['itemPenjualan.produk', 'user']);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Menampilkan halaman kasir (POS) untuk transaksi baru / aktif.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        // 🔄 Hitung ulang total pembayaran berdasarkan item di keranjang jika ada
        $sale->load('itemPenjualan');
        $calculatedTotal = $sale->itemPenjualan->sum('subtotal');
        if ($sale->total_pembayaran !== $calculatedTotal) {
            $sale->update(['total_pembayaran' => $calculatedTotal]);
        }

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Membuka halaman POS untuk mengedit transaksi OPEN yang ada.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if(in_array($sale->status, ['COMPLETED', 'PAID', 'Selesai']), 403, 'Transaksi yang sudah selesai tidak dapat diubah.');

        $user = Auth::user();
        if ($user->role && $user->role->name === 'kasir' && $sale->user_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengedit transaksi pengguna lain.');
        }

        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Menyelesaikan / Checkout transaksi.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS,TRANSFER',
            'bayar' => 'nullable|numeric'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses sebelumnya.');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang belanja masih kosong.');
        }

        DB::transaction(function () use ($penjualan, $request) {
            // 🔄 Hitung total harga dari seluruh subtotal item
            $total = $penjualan->itemPenjualan()->sum('subtotal');
            $bayar = $request->input('bayar', $total);
            $kembalian = max(0, $bayar - $total);

            // Sesuaikan nilai status dengan enum/standar DB kamu (misal: 'COMPLETED' atau 'PAID' atau 'SELESAI')
            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran' => $total,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
                'status' => 'COMPLETED',
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan.');
    }

    /**
     * Membatalkan transaksi OPEN dan mengembalikan stok barang.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.create')
                ->with('errors', 'Transaksi yang sudah selesai tidak dapat dibatalkan.');
        }

        $user = Auth::user();
        if ($user->role && $user->role->name === 'kasir' && $penjualan->user_id != $user->id) {
            return redirect()->route('penjualan.create');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan.');
    }
}