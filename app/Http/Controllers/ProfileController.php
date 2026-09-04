<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        return view('profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Disesuaikan jadi 'photo'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Cek jika ada file photo yang diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama dari storage jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('profiles', 'public');
            $data['photo'] = $path; // Menyimpan ke kolom 'photo'
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}