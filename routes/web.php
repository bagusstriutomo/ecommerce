<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- Controller untuk Publik & Pengguna ---
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// --- Controller Khusus untuk Admin ---
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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
*/

// --- RUTE UNTUK PENGUNJUNG & PENGGUNA BIASA ---
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Rute yang membutuhkan pengguna untuk login (Middleware 'auth')
Route::middleware('auth')->group(function () {
    
    // Rute untuk keranjang belanja (Departemen C) - DIBAWAH AUTH
    // Catatan: Biasanya index (melihat keranjang) bisa publik, tapi untuk keamanan, kita taruh di sini.
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{rowId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Rute dashboard default dari Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Rute profil pengguna dari Breeze
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Keranjang Belanja (Departemen C)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');

    // Rute untuk proses checkout (Misi Anda - Departemen D)
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
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
// --- ZONA KHUSUS ADMIN ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute untuk Laporan Pesanan Admin (Misi Anda - Departemen D)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');

    // Rute untuk Manajemen Inventaris (Departemen B)
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/products', AdminProductController::class);
});


require __DIR__.'/auth.php';

