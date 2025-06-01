@extends('layouts.app')

@section('content')
 <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
               <div class="p-4 bg-white rounded-lg shadow">
                  <h3 class="text-sm text-gray-500">Total Brand</h3>
                  <p class="text-xl font-semibold">{{ $totalBrands }}</p>
               </div>
               <div class="p-4 bg-white rounded-lg shadow">
                  <h3 class="text-sm text-gray-500">Total Kategori</h3>
                  <p class="text-xl font-semibold">{{ $totalCategories }}</p>
               </div>
               <div class="p-4 bg-white rounded-lg shadow">
                  <h3 class="text-sm text-gray-500">Total Item</h3>
                  <p class="text-xl font-semibold">{{ $totalItems }}</p>
               </div>
               <div class="p-4 bg-white rounded-lg shadow">
                  <h3 class="text-sm text-gray-500">Total Toko</h3>
                  <p class="text-xl font-semibold">{{ $totalTokos }}</p>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
               
               <div class="p-6 bg-white rounded-lg shadow">
                  <div class="text-sm text-gray-500">Total Harga Item</div>
                  <div class="mt-1 text-3xl font-bold">Rp {{ number_format($totalHargaItems, 0, ',', '.') }}</div>
               </div>
               
               <div class="p-6 bg-white rounded-lg shadow">
                  <div class="text-sm text-gray-500">Total Ongkir</div>
                  <div class="mt-1 text-3xl font-bold">Rp {{ number_format($totalOngkir, 0, ',', '.') }}</div>
               </div>
            </div>
    <div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
    </div>
@endsection