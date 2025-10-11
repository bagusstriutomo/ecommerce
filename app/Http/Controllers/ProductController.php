<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar produk.
     */
    public function index()
    {
        // 2. Ambil semua produk yang aktif dari database
        $products = Product::where('is_active', true)->latest()->get();

        // 3. Kirim data produk ke view 'products.index'
        return view('products.index', ['products' => $products]);
    }
}
