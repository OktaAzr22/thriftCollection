@extends('layouts.app')

@section('content')
 <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
   <!-- Total Brand -->
  <div class="p-4 transition-shadow rounded-lg shadow-md bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-lg">
    <div class="flex items-center space-x-3">
      <div class="p-2 text-white bg-blue-500 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
      </div>
      <div>
        <h3 class="text-sm text-blue-600">Total Brand</h3>
        <p class="text-xl font-semibold text-gray-800">{{ $totalBrands }}</p>
      </div>
    </div>
  </div>

  <!-- Total Ongkir -->
  <div class="p-4 transition-shadow rounded-lg shadow-md bg-gradient-to-br from-purple-50 to-purple-100 hover:shadow-lg">
    <div class="flex items-center space-x-3">
      <div class="p-2 text-white bg-purple-500 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
        </svg>
      </div>
      <div>
        <h3 class="text-sm text-purple-600">Total Ongkir</h3>
        <p class="text-xl font-semibold text-gray-800">Rp {{ number_format($totalOngkir, 0, ',', '.') }}</p>
      </div>
    </div>
  </div>

  <!-- Total Item -->
  <div class="p-4 transition-shadow rounded-lg shadow-md bg-gradient-to-br from-green-50 to-green-100 hover:shadow-lg">
    <div class="flex items-center space-x-3">
      <div class="p-2 text-white bg-green-500 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
      </div>
      <div>
        <h3 class="text-sm text-green-600">Total Item</h3>
        <p class="text-xl font-semibold text-gray-800">{{ $totalItems }}</p>
      </div>
    </div>
  </div>

  <!-- Total Harga -->
  <div class="p-4 transition-shadow rounded-lg shadow-md bg-gradient-to-br from-amber-50 to-amber-100 hover:shadow-lg">
    <div class="flex items-center space-x-3">
      <div class="p-2 text-white rounded-md bg-amber-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <div>
        <h3 class="text-sm text-amber-600">Total Harga</h3>
        <p class="text-xl font-semibold text-gray-800">Rp {{ number_format($totalHargaItems, 0, ',', '.') }}</p>
      </div>
    </div>
  </div>
</div>
    <div class="flex flex-col transition-shadow rounded-lg shadow-md bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-lg">
      <div class="flex flex-col p-6">
            <!-- Table Header -->
            <div class="flex flex-col justify-between mb-6 space-y-4 sm:space-y-0 sm:flex-row sm:items-center">
              <h2 class="text-xl font-semibold text-gray-800">Product List</h2>
              <div class="flex gap-2">
                {{-- <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                  <i class="mr-2 fas fa-plus"></i> Add Product
                </button> --}}
                <a href="{{ route('admin.print-pdf') }}" target="_blank"
  class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
  <i class="mr-2 fas fa-file-pdf"></i> Download PDF
</a>

              </div>
            </div>
            
           <!-- Search Bar -->
<form method="GET" action="{{ route('admin.dashboard') }}">
   <label for="search" class="sr-only">Search products</label>
   <div class="w-full mb-4 sm:w-1/4">
      <div class="relative">
         <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <i class="text-gray-400 fas fa-search"></i>
         </div>
         <input type="text" id="search" name="search" value="{{ request('search') }}"
            class="block w-full py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
            placeholder="Search products...">
      </div>
   </div>
</form>

         
            <!-- Table Container -->
            <div class="flex flex-col ">
              <div class="overflow-auto border border-gray-200 rounded-lg scrollbar-hide" style="max-height: calc(100vh - 420px);">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="sticky top-0 bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Product</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Harga</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Category</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Brand</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Asal</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total Price</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-100">
                     @forelse  ($items as $item)
                        <tr class="hover:bg-gray-50">
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                 <div class="flex-shrink-0 w-10 h-10">
                                    <img class="object-cover w-10 h-10 rounded-md" src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('default-brand.png') }}" alt="{{ $item->nama }}">
                                 </div>
                                 <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->created_at->format('d-m-Y') }}</div>
                                 </div>
                              </div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">Rp. {{ number_format($item->harga, 0, ',', '.') }}</div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              {{ $item->kategori->nama ?? '-' }}
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <span class="inline-block px-2 py-1 text-xs font-bold leading-none text-blue-700 bg-blue-100 rounded whitespace-nowrap">
                              {{ $item->brand->name ?? '-' }}
                              </span>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">{{ $item->toko->asal ?? $item->toko->nama_toko ?? '-' }}</div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-500">Rp. {{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</div>

                           </td>
                        </tr>
                     @empty
          <tr>
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ADA DATA</td>
          </tr>
        @endforelse
                  </tbody>
                </table>
              </div>
              
              <!-- Pagination -->
              <div class="sticky bottom-0 z-10 flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                  <div class="text-sm text-gray-700">
                     Showing 
                     <span class="font-medium">{{ $items->firstItem() }}</span>
                     to
                     <span class="font-medium">{{ $items->lastItem() }}</span>
                     of
                     <span class="font-medium">{{ $items->total() }}</span>
                     results
                  </div>
                  {{ $items->links() }}
               </div>

            </div>
          </div>

    </div>
@endsection