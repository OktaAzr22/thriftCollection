@extends('layouts.app')

@section('content')
    <div class="max-w-2xl p-6 mx-auto">
        <h2 class="mb-6 text-2xl font-bold">Tambah Item Wishlist</h2>

        <form action="{{ route('wishlist.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nama Barang --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Barang</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                    required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Harga (Rp)</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                @error('price')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL Gambar --}}
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-200">URL Gambar</label>
                <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                @error('image_url')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <div class="flex justify-end">
                <a href="{{ route('wishlist.index') }}"
                   class="inline-block mr-4 text-gray-600 dark:text-gray-300 hover:underline">Kembali</a>

                <button type="submit"
                    class="px-6 py-2 font-semibold text-white bg-blue-600 rounded-md shadow hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection