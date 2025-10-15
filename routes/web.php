<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; // Controller Keranjang Anda
use App\Http\Controllers\Admin\ProductController as AdminProductController; // Controller Admin dari teman Anda

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dalam sebuah grup yang berisi
| middleware "web". Sekarang buat sesuatu yang hebat!
|
*/

// --- START: RUTE PUBLIC (Tidak Perlu Login) ---

// 1. Ini route halaman utama (Departemen B) - HANYA SATU DEFINISI
Route::get('/', [ProductController::class, 'index'])->name('home');

// 2. RUTE DEPARTEMEN C (Alur Belanja Pengguna)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/{rowId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');

// --- END: RUTE PUBLIC ---

// Ini route dashboard dari Breeze (membutuhkan login dan verifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route default dari Breeze untuk profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ======================================================================
// == ZONA AMAN UNTUK SEMUA HALAMAN ADMIN (SATU GRUP SAJA) ==
// ======================================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute dashboard untuk admin (opsional untuk tes)
    Route::get('/dashboard', function () {
        return 'Welcome to the Admin Dashboard!';
    })->name('dashboard');

    // Rute untuk CRUD Produk, sekarang sudah aman di dalam grup ini
    Route::resource('products', AdminProductController::class);

    // Semua rute admin lainnya (seperti manajemen pesanan) akan ditambahkan di sini.

});
// ======================================================================


// Route untuk login, register, dll. dari Breeze
require __DIR__.'/auth.php';