@extends('layouts.app')

@section('content')


<div class="max-w-5xl px-4 py-10 mx-auto">
    <a href="{{ route('items.index') }}" class="inline-flex items-center mb-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-500">
        <i class="mr-2 fas fa-arrow-left"></i> Kembali ke daftar
    </a>
    <div class="overflow-hidden bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
        <div class="grid grid-cols-1 md:grid-cols-2">
            {{-- Gambar Item --}}
            <div class="flex items-center justify-center p-4 bg-gray-100 dark:bg-gray-700">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="object-contain w-full max-h-96">
            </div>

            {{-- Detail --}}
            <div class="p-6 space-y-4">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $item->nama }}</h2>

                <div class="space-y-1 text-gray-700 dark:text-gray-300">
                    <p><span class="font-semibold">Kategori:</span> {{ $item->kategori->nama }}</p>
                    <p><span class="font-semibold">Brand:</span> {{ $item->brand->name }} </p>
                    <p><span class="font-semibold">Toko:</span> {{ $item->toko->nama }} ({{ $item->toko->asal }})</p>
                    <p><span class="font-semibold">Harga:</span> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <p><span class="font-semibold">Ongkir:</span> Rp {{ number_format($item->ongkir, 0, ',', '.') }}</p>
                    @if ($item->tanggal)
                        <p><span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                    @endif
                    <p><span class="font-semibold">Total Harga:</span> <span class="font-semibold text-green-600">Rp {{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</span></p>
                </div>

                <div>
                    <h3 class="mt-4 font-semibold text-gray-900 dark:text-white">Deskripsi:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $item->deskripsi }}</p>
                </div>

                {{-- Gambar Brand --}}
                @if ($item->brand->image)
                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white">Gambar Brand:</h4>
                        <img src="{{ asset('storage/' . $item->brand->image) }}" alt="{{ $item->brand->name }}" class="object-contain w-32 h-32 p-2 mt-2 bg-white border rounded-xl">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
