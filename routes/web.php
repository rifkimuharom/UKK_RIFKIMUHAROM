<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController; // <--- Import KategoriController
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;

// Redirect halaman utama langsung ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// --- GUEST ROUTES (Belum Login) ---
Route::middleware('guest')->group(function () {
    // Login / Sign In
    Route::get('/login', [Authcontroller::class, 'index'])->name('login');
    Route::post('/auth', [Authcontroller::class, 'auth'])->name('auth');

    // Sign Up / Register
    Route::get('/register', [Authcontroller::class, 'registerView'])->name('register.page');
    Route::post('/register', [Authcontroller::class, 'register'])->name('register');
});

// --- AUTHENTICATED ROUTES (Sudah Login) ---
Route::middleware('auth')->group(function () {

    // Dashboard & Logout
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');

    // --- KHUSUS ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Kelola Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/update/{user}', [UserController::class, ('update')])->name('users.update');
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // --- ADMIN & KASIR ---
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('kategori', KategoriController::class); // <--- Route Kategori ditambahkan di sini
        Route::resource('produk', ProdukController::class);
        Route::resource('penjualan', PenjualanController::class);
        Route::resource('itempenjualan', ItemPenjualanController::class);

        // Setting App
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

});