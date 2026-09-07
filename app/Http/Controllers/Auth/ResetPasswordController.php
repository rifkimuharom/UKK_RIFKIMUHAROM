<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetDirect(Request $request)
    {
        // 1. Validasi input dari modal
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.exists' => 'Email tidak terdaftar di sistem.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // 2. Cari user berdasarkan email dan simpan password baru
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // 3. Kembalikan ke halaman login dengan pesan sukses
        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui! Silakan masuk dengan kata sandi baru.');
    }
}