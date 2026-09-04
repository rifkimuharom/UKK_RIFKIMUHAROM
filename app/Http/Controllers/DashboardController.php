<?php

namespace App\Http\Controllers;

use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {
    }

    public function index(Request $request)
    {
        $fromDate = $request->input('from_date', now()->format('Y-m-d'));
        $toDate = $request->input('to_date', now()->format('Y-m-d'));

        $start = Carbon::parse($fromDate)->startOfDay();
        $end = Carbon::parse($toDate)->endOfDay();

        if ($end->lt($start)) {
            [$start, $end] = [$end->copy()->startOfDay(), $start->copy()->endOfDay()];
        }

        $pakaiHariIni = $start->isSameDay(now()) && $end->isSameDay(now());

        if ($pakaiHariIni || !method_exists($this->laporanService, 'ringkasanPeriode')) {
            $ringkasan = $this->laporanService->ringkasanHariIni();
            $produkTerlaris = $this->laporanService->produkTerlarisHariIni();
        } else {
            $ringkasan = $this->laporanService->ringkasanPeriode($start, $end);
            $produkTerlaris = method_exists($this->laporanService, 'produkTerlarisPeriode')
                ? $this->laporanService->produkTerlarisPeriode($start, $end)
                : $this->laporanService->produkTerlarisHariIni();
        }

        $ringkasan = array_merge([
            'total_penjualan' => 0,
            'total_transaksi' => 0,
            'total_cash' => 0,
            'total_non_tunai' => 0,
        ], $ringkasan ?? []);

        $q = trim((string) $request->input('q', ''));
        $hasilCariProduk = collect();
        $hasilCariTransaksi = collect();

        if ($q !== '') {
            $hasilCariProduk = DB::table('produk')
                ->where('nama', 'like', '%' . $q . '%')
                ->orderBy('nama')
                ->limit(10)
                ->get();

            $hasilCariTransaksi = DB::table('penjualan')
                ->where('id', $q)
                ->orWhere('id', 'like', '%' . $q . '%')
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();
        }

        return view('dashboard', [
            'tanggalHariIni' => Carbon::now(),
            'ringkasan' => $ringkasan,
            'produkTerlaris' => $produkTerlaris ?? collect(),
            'produkStokRendah' => $this->stokService->produkStokRendah() ?? collect(),
            'produkStokHabis' => $this->stokService->produkStokHabis() ?? collect(),
            'hasilCariProduk' => $hasilCariProduk,
            'hasilCariTransaksi' => $hasilCariTransaksi,
        ]);
    }
}