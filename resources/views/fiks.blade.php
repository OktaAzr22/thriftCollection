@extends('layouts.fiks')

@section('content')
<!-- sec 1 -->
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
@endsection

