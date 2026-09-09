<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'nama_toko' => 'KUDE POS',
                'alamat' => 'Jl. Raya Utama No. 123, Bandung',
                'telepon' => '0812-3456-7890',
                'ppn' => 10,
                'footer_struk' => 'Terima kasih atas kunjungan Anda',
                'ukuran_kertas' => '58mm',
                'auto_print' => 1,
            ]);
        }

        return view('setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'ppn' => 'nullable|numeric|min:0',
            'footer_struk' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('logo')) {
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            unset($data['logo']);
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}