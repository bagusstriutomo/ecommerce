<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
<<<<<<< HEAD
use App\Http\Controllers\CartController; // Pastikan ini ada
=======
use App\Http\Controllers\Admin\ProductController as AdminProductController;
>>>>>>> 0d405354789cc96dcbbc82f6311c81eb536cfe2a

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
<<<<<<< HEAD
|
| ... (Penjelasan Laravel)
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

// Ini route profile dari Breeze (membutuhkan login)
=======
*/

// Route halaman utama (katalog publik)
Route::get('/', [ProductController::class, 'index'])->name('home');

// Route default dari Breeze untuk profile
>>>>>>> 0d405354789cc96dcbbc82f6311c81eb536cfe2a
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