<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\User; // Tambahkan import Model User

class AuthController extends Controller
{
    /**
     * Menampilkan Tampilan Form Login (Sign In)
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Proses Autentikasi User (Login)
     */
    public function auth(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Selamat Datang, ' . Auth::user()->name);
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid'
        ]);
    }

    /**
     * Menampilkan Tampilan Form Register (Sign Up)
     */
    public function registerView()
    {
        return view('register');
    }

    /**
     * Proses Pendaftaran Akun Baru (Register)
     */
    public function register(Request $request)
    {
        // Validasi input registrasi
        $validated = $request->validate([
            'first_name'  => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name'   => 'required|string|max:100',
            'username'    => 'required|string|max:50|unique:users,username',
            'email'       => 'required|email|max:255|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
            'gender'      => 'required|in:male,female',
            'birth_date'  => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload Foto Profil jika ada
        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Gabungkan Nama Lengkap
        $fullName = trim($validated['first_name'] . ' ' . ($validated['middle_name'] ?? '') . ' ' . $validated['last_name']);

        // Simpan Data User
        User::create([
            'name'          => $fullName,
            'username'      => $validated['username'],
            'email'         => $validated['email'],
            'password'      => Hash::make($validated['password']),
            'gender'        => $validated['gender'],
            'birth_date'    => $validated['birth_date'] ?? null,
            'profile_photo' => $photoPath,
            'role'          => 'kasir', // Default role saat mendaftar
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Silakan login dengan akun baru Anda.');
    }

    /**
     * Proses Keluar Aplikasi (Logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah keluar aplikasi!');
    }
}
