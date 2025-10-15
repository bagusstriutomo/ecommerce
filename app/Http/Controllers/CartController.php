<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart; // WAJIB: Import Facade Cart
// use App\Http\Controllers\Controller; // Tidak perlu diimpor jika sudah ada di namespace

class CartController extends Controller
{
    /**
     * Menampilkan isi keranjang belanja. (User Story #3, Melihat Keranjang)
     */
    public function index()
    {
        // Ambil semua item dari keranjang
        $cartItems = Cart::content();

        // HITUNG TOTAL HARGA. Menggunakan Cart::total(false) untuk mendapatkan nilai FLOAT murni 
        // yang dapat diformat oleh number_format() di view tanpa error.
        $total = Cart::total(false); 

        // Kirim data ke view
        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Menambah item baru ke keranjang. (User Story #3, Menambah Item)
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari tombol "Tambah ke Keranjang"
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'qty' => 'required|integer|min:1',
        ]);

        // Tambahkan item ke keranjang
        Cart::add(
            $validatedData['product_id'],
            $validatedData['name'],
            $validatedData['qty'],
            $validatedData['price']
        )->associate('App\Models\Product'); // Asosiasi (opsional, jika Anda menggunakan Eloquent Model)

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Mengubah kuantitas item dalam keranjang. (User Story #4, Mengubah Kuantitas)
     * @param string $rowId ID unik item dalam keranjang.
     */
    public function update(Request $request, $rowId)
    {
        // Validasi input kuantitas
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        // Perbarui kuantitas
        Cart::update($rowId, $request->qty);

        return redirect()->route('cart.index')->with('success', 'Kuantitas produk berhasil diperbarui!');
    }

    /**
     * Menghapus item dari keranjang. (User Story #4, Menghapus Item)
     * @param string $rowId ID unik item dalam keranjang.
     */
    public function destroy($rowId)
    {
        // Hapus item berdasarkan rowId
        Cart::remove($rowId);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}