@extends('layouts.app')

@section('content')
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
  @php
    $cards = [
      [
        'title' => 'Total Brand',
        'value' => $totalBrands,
        'bgFrom' => 'from-blue-50',
        'bgTo' => 'to-blue-100',
        'iconBg' => 'bg-blue-500',
        'textColor' => 'text-blue-600',
      ],
      [
        'title' => 'Total Ongkir',
        'value' => 'Rp ' . number_format($totalOngkir, 0, ',', '.'),
        'bgFrom' => 'from-purple-50',
        'bgTo' => 'to-purple-100',
        'iconBg' => 'bg-purple-500',
        'textColor' => 'text-purple-600',
      ],
      [
        'title' => 'Total Item',
        'value' => $totalItems,
        'bgFrom' => 'from-green-50',
        'bgTo' => 'to-green-100',
        'iconBg' => 'bg-green-500',
        'textColor' => 'text-green-600',
      ],
      [
        'title' => 'Total Harga',
        'value' => 'Rp ' . number_format($totalHargaItems, 0, ',', '.'),
        'bgFrom' => 'from-amber-50',
        'bgTo' => 'to-amber-100',
        'iconBg' => 'bg-amber-500',
        'textColor' => 'text-amber-600',
      ],
    ];
  @endphp

  @foreach ($cards as $card)
  <div class="p-4 transition-shadow rounded-lg shadow-md hover:shadow-lg
              bg-gradient-to-br {{ $card['bgFrom'] }} {{ $card['bgTo'] }}
              dark:bg-none dark:bg-slate-900 dark:shadow dark:hover:shadow-lg">
    <div class="flex items-center space-x-3">
      <div class="p-2 text-white rounded-md {{ $card['iconBg'] }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
      </div>
      <div>
        <h3 class="text-sm {{ $card['textColor'] }} dark:text-slate-300">{{ $card['title'] }}</h3>
        <p class="text-xl font-semibold text-gray-800 dark:text-white">{{ $card['value'] }}</p>
      </div>
    </div>
  </div>
  @endforeach
</div>

  <div class="flex flex-col transition-shadow rounded-lg shadow-xl bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-lg dark:bg-slate-800 dark:from-slate-800 dark:to-slate-900">
    <div class="flex flex-col p-6">
      <div class="flex flex-col justify-between mb-6 space-y-4 sm:space-y-0 sm:flex-row sm:items-center">
        <h2 class="text-xl font-semibold text-sky-400/25">Product List</h2>
        <div class="flex gap-2">
          <a href="{{ route('admin.print-pdf') }}" target="_blank" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
            <i class="mr-2 fas fa-file-pdf"></i> Download PDF
          </a>
        </div>
      </div>
      <form method="GET" action="{{ route('admin.dashboard') }}">
        <label for="search" class="sr-only">Search products</label>
        <div class="w-full mb-4 sm:w-1/4">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <i class="text-gray-400 fas fa-search"></i>
              </div>
              <input type="text" id="search" name="search" value="{{ request('search') }}"
                  class="block w-full py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 placeholder:text-gray-500 placeholder:italic"
                  placeholder="Search products...">
            </div>
        </div>
      </form>
      
      <div class="flex flex-col ">
        <div class="overflow-auto border border-gray-200 rounded-lg scrollbar-hidden" style="max-height: calc(100vh - 420px); ">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-600">
            <thead class="sticky top-0 bg-gray-50 dark:bg-slate-700">
              <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Product</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Harga</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Category</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Brand</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Asal</th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Total Price</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100 dark:bg-slate-800 dark:divide-slate-700">
              @forelse  ($items as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-600">
                  <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10">
                          <img class="object-cover w-10 h-10 rounded-md" src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('default-brand.png') }}" alt="{{ $item->nama }}">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->nama }}</div>
                          <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
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
                    <span class="inline-block px-2 py-1 text-xs font-bold leading-none bg-blue-100 rounded ttext-blue-700 dark:bg-blue-900 dark:text-blue-200 whitespace-nowrap">
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
                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">Tidak ADA DATA</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="sticky bottom-0 z-10 flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 dark:bg-slate-800 dark:border-slate-600 sm:px-6">
            <div class="text-sm text-gray-700 dark:text-gray-300">
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