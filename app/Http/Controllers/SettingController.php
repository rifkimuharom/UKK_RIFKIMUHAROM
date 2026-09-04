<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_toko'     => 'nullable|string|max:255',
            'telepon'       => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'ukuran_kertas' => 'nullable|string',
            'auto_print'    => 'nullable|boolean',
            'footer_struk'  => 'nullable|string',
            'ppn'           => 'nullable|numeric|min:0',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 2. Ambil data pertama, jika belum ada buat instance baru
        $setting = Setting::first() ?? new Setting();

        // 3. Masukkan data teks (hanya update jika nilainya diisi/dikirim)
        if ($request->filled('nama_toko')) $setting->nama_toko = $request->nama_toko;
        if ($request->filled('telepon')) $setting->telepon = $request->telepon;
        if ($request->filled('alamat')) $setting->alamat = $request->alamat;
        if ($request->filled('ukuran_kertas')) $setting->ukuran_kertas = $request->ukuran_kertas;
        if ($request->has('auto_print')) $setting->auto_print = $request->auto_print;
        if ($request->filled('footer_struk')) $setting->footer_struk = $request->footer_struk;
        if ($request->filled('ppn')) $setting->ppn = $request->ppn;

        // 4. Simpan File Logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama dari disk public jika ada
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }

            // Simpan file baru ke 'storage/app/public/logos'
            $path = $request->file('logo')->store('logos', 'public');
            $setting->logo = $path; // Hasil simpan: "logos/namafile.png"
        }

        // 5. Simpan ke Database
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}