<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi (bisa ditambahkan nanti jika perlu)
        // Contoh: $request->validate([...]);

        // 2. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to checkout.');
        }

        // 3. Pastikan keranjang tidak kosong
        if (Cart::count() == 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        // Gunakan Database Transaction untuk memastikan semua query berhasil
        DB::beginTransaction();

        try {
            // 4. Buat pesanan baru di tabel 'orders'
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => Cart::total(2, '.', ''), // Ambil total harga dari keranjang
                'status' => 'pending', // Status awal pesanan
                // Tambahkan kolom lain jika ada, seperti alamat, dll.
            ]);

            // 5. Pindahkan setiap item dari keranjang ke tabel 'order_items'
            foreach (Cart::content() as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->id,
                    'quantity' => $cartItem->qty,
                    'price' => $cartItem->price,
                ]);
            }

            // Jika semua berhasil, konfirmasi transaksi
            DB::commit();

            // 6. Hancurkan (kosongkan) keranjang belanja
            Cart::destroy();

            // 7. Arahkan ke halaman sukses (bisa dibuat nanti)
            return redirect()->route('home')->with('success', 'Thank you! Your order has been placed.');

        } catch (\Exception $e) {
            // Jika ada error, batalkan semua query
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
