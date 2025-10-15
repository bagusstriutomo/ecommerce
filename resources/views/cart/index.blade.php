<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja Minimalis</title>
</head>
<body>
    <h1>Isi Keranjang Belanja Anda</h1>

    @if (session('success'))
        <p style="color: green; border: 1px solid green; padding: 10px;">{{ session('success') }}</p>
    @endif

    @if(Cart::content()->count() > 0)
        <table border="1" style="width: 80%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        
                        {{-- HARGA SATUAN: Dipaksa ke float --}}
                        <td>Rp{{ number_format(floatval($item->price), 0, ',', '.') }}</td> 

                        <td>
                            {{-- FORM UNTUK UPDATE KUANTITAS --}}
                            <form method="POST" action="{{ route('cart.update', $item->rowId) }}">
                                @csrf
                                @method('PUT')
                                <input type="number" name="qty" value="{{ $item->qty }}" min="1" style="width: 50px;">
                                <button type="submit">Ubah</button>
                                
                                @error('qty')
                                    <span style="color: red; font-size: small;">{{ $message }}</span>
                                @enderror
                            </form>
                        </td>
                        
                        {{-- SUBT0TAL ITEM: Dipaksa ke float (menggunakan subtotal(false) dari Controller) --}}
                        <td>Rp{{ number_format(floatval($item->subtotal(false)), 0, ',', '.') }}</td>

                        <td>
                            {{-- FORM UNTUK HAPUS ITEM --}}
                            <form method="POST" action="{{ route('cart.destroy', $item->rowId) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;">**TOTAL**</td>
                    {{-- 🛑 BAGIAN tfoot (TOTAL KESELURUHAN) --}}
                    {{-- Dipaksa ke float ($total dari Controller) untuk menghindari error Baris 65/sekitarnya --}}
                    <td colspan="2">**Rp{{ number_format(floatval($total), 0, ',', '.') }}**</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>Keranjang belanja Anda kosong. <a href="{{ route('home') }}">Silakan belanja!</a></p>
    @endif
    
</body>
</html>