@extends('layouts.app')

@section('content')
<x-alert />
<div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
    @if($items->count() > 0)
    <!-- HEADER -->
    <div class="flex flex-col items-start justify-between gap-4 mb-8 md:flex-row md:items-end">
        <div>
            <div class="flex items-center mb-2">
                <a href="{{ url()->previous() }}" class="mr-4 text-gray-500 transition-colors hover:text-blue-600">
                    <i class="text-xl fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">{{ $brand->nama_brand }}</h1>
            </div>
            <p class="ml-10 text-gray-500">Discover our premium collection</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-500">{{ $items->count() }} products available</span>
        </div>
    </div>

    <!-- PRODUK SCROLLABLE CARD -->
    <div class="w-full max-w-full overflow-x-auto">
        <div class="flex gap-6 flex-nowrap">
            @foreach($items as $item)
            <div 
                class="flex-shrink-0 overflow-hidden bg-white border border-gray-100 shadow-md rounded-xl w-72"
                x-data="{ openModal: false }">

                <!-- Gambar Klikable -->
                <div class="relative cursor-pointer" @click="openModal = true">
                    <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="{{ $item->nama }}"
                        class="object-cover w-full h-48 bg-white">
                    <div class="absolute px-3 py-1 text-sm font-bold text-white bg-blue-600 rounded-full top-3 right-3">
                        Rp{{ number_format($item->harga) }}
                    </div>
                </div>

                <!-- Info -->
                <div class="p-5">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-lg font-semibold text-gray-900 line-clamp-1">{{ $item->nama }}</h3>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                            {{ $item->kategori->nama ?? 'General' }}
                        </span>
                    </div>
                    <div class="flex items-center mb-1 text-sm text-gray-500">
                        <i class="mr-1 text-gray-400 fas fa-store"></i>
                        <span>{{ $item->toko->nama ?? 'Unknown Store' }}</span>
                    </div>
                    <div class="flex items-center mb-3 text-sm text-gray-400">
                        <i class="mr-1 fas fa-calendar-alt"></i>
                        <span>Masuk: {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                    </div>
                    <p class="mb-4 text-sm text-gray-600 line-clamp-2">
                        {{ $item->deskripsi ?: 'No description available.' }}
                    </p>
                    <button class="flex items-center justify-center w-full py-2 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        <i class="mr-2 fas fa-shopping-cart"></i>
                        Add to Cart
                    </button>
                </div>

                <!-- MODAL DETAIL -->
                <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
                    <div @click.away="openModal = false" class="w-11/12 max-w-xl p-6 bg-white rounded-lg shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">{{ $item->nama }}</h2>
                            <button @click="openModal = false" class="text-gray-500 hover:text-red-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                             alt="{{ $item->nama }}" class="object-contain w-full h-64 mb-4 rounded">
                        <p class="mb-2 text-gray-700">Harga: <strong>Rp{{ number_format($item->harga) }}</strong></p>
                        <p class="mb-2 text-gray-700">Kategori: {{ $item->kategori->nama ?? 'General' }}</p>
                        <p class="mb-2 text-gray-700">Toko: {{ $item->toko->nama ?? 'Unknown Store' }}</p>
                        <p class="text-gray-700">Deskripsi: {{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <x-empty-message 
        title="Oops, Data Tidak Ditemukan!" 
        message="Maaf, produk untuk brand ini belum tersedia." 
        button-text="Back" 
        button-url="{{ route('brands.index') }}"/>
    @endif
</div>
@endsection

@push('scripts')
<!-- Alpine.js for modal -->
<script src="//unpkg.com/alpinejs" defer></script>
@endpush
