<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pesanan, urutkan dari yang terbaru
        // 'with('user')' untuk mengambil data user yang memesan (optimization)
        $orders = Order::with('user')->latest()->get();

        // Kirim data ke view
        return view('admin.orders.index', compact('orders'));
    }
}
