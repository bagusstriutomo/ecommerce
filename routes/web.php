<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route halaman utama (katalog publik)
Route::get('/', [ProductController::class, 'index'])->name('home');

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