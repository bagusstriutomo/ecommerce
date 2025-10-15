<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Produk: ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium">Nama Produk</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium">Harga</label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
                        </div>
                         <div class="mb-4">
                            <label for="stock" class="block text-sm font-medium">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ $product->stock }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black">{{ $product->description }}</textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Perbarui
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>