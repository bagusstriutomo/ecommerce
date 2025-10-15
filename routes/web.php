<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; // Pastikan ini ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ini route untuk login, register, dll. dari Breeze
require __DIR__.'/auth.php';