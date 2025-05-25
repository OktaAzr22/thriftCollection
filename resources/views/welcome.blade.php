@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Brand</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ $data['brandCount'] }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Kategori</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ $data['kategoriCount'] }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Item</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ $data['itemCount'] }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Toko</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ $data['tokoCount'] }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Harga Item</h2>
                <p class="text-2xl font-bold text-green-600">Rp {{ number_format($data['totalHarga'], 0, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Ongkir</h2>
                <p class="text-2xl font-bold text-green-600">Rp {{ number_format($data['totalOngkir'], 0, ',', '.') }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-gray-700 text-lg font-semibold">Total Biaya</h2>
                <p class="text-2xl font-bold text-blue-600">
                    Rp {{ number_format($data['totalBiaya'], 0, ',', '.') }}
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Top 5 Ongkir Termahal</h2>
                    <ul class="space-y-1">
                        @foreach ($data['topOngkir'] as $item)
                            <li class="flex justify-between">
                                <span>{{ $item->nama }}</span>
                                <span class="text-red-600 font-bold">Rp {{ number_format($item->ongkir, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Top 5 Harga Item Tertinggi</h2>
                    <ul class="space-y-1">
                        @foreach ($data['topHarga'] as $item)
                            <li class="flex justify-between">
                                <span>{{ $item->nama }}</span>
                                <span class="text-green-600 font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
