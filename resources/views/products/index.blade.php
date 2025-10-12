<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Grid untuk menampilkan produk --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        {{-- Ulangi untuk setiap produk --}}
                        @forelse ($products as $product)
                            <div class="border rounded-lg p-4 flex flex-col">
                                {{-- Gambar Produk (Jika ada) --}}
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                                @else
                                    {{-- Placeholder jika tidak ada gambar --}}
                                    <div class="w-full h-48 bg-gray-200 rounded-md mb-4 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif

                                {{-- Nama Produk --}}
                                <h3 class="text-lg font-semibold mb-2 flex-grow">{{ $product->name }}</h3>

                                {{-- Harga Produk --}}
                                <p class="text-gray-700 font-bold mb-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                {{-- Stok Produk --}}
                                <p class="text-sm text-gray-500 mb-4">
                                    Stok: {{ $product->stock }}
                                </p>

                                {{-- Tombol Aksi --}}
                                <a href="#" class="mt-auto bg-blue-500 text-white text-center font-bold py-2 px-4 rounded hover:bg-blue-700">
                                    Tambah ke Keranjang
                                </a>
                            </div>
                        @empty
                            {{-- Pesan jika tidak ada produk --}}
                            <p class="col-span-full text-center text-gray-500">
                                Belum ada produk yang tersedia.
                            </p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>