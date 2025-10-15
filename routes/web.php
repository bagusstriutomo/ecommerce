<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- Controller untuk Publik & Pengguna ---
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// --- Controller Khusus untuk Admin ---
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dalam sebuah grup yang
| berisi grup middleware "web". Buat sesuatu yang hebat!
|
*/

// ======================================================================
// == RUTE PUBLIK & PENGGUNA TERAUTENTIKASI ==
// ======================================================================

// Rute halaman utama (katalog produk) untuk semua pengunjung
Route::get('/', [ProductController::class, 'index'])->name('home');

// Rute yang membutuhkan pengguna untuk login
Route::middleware('auth')->group(function () {
    // Rute untuk keranjang belanja (Departemen C)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{rowId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Rute dashboard default dari Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Rute profil pengguna dari Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ======================================================================
// == RUTE KHUSUS ADMIN (Dilindungi Middleware) ==
// ======================================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute dashboard admin
    Route::get('/dashboard', function () {
        return 'Welcome to the Admin Dashboard!';
    })->name('dashboard');

    // Rute untuk CRUD Produk (Departemen B)
    Route::resource('products', AdminProductController::class);

    // Tambahkan semua rute admin lainnya di sini
});

// File rute autentikasi dari Laravel Breeze
require __DIR__.'/auth.php';