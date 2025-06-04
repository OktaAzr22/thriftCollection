@extends('layouts.app')

@section('content')
<x-alert />
<div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
    <!-- Header Section -->
    <div class="flex flex-col justify-between mb-4 space-y-3 md:flex-row md:items-center md:space-y-0">
        <h2 class="text-xl font-semibold text-gray-800">Product List</h2>
        
        <!-- Search and Add Product -->
        <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-gray-400 fas fa-search"></i>
                </div>
                <form method="GET" action="{{ route('items.index') }}">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="w-[200px] py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:w-[250px] transition-all duration-300" 
                        placeholder="Search Item..."
                    >
                </form>
            </div>
            
            <a href="{{ route('items.create') }}">
                <button class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="mr-2 fas fa-plus"></i> Add Product
                </button>
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="max-h-[calc(100vh-250px)] overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 hover:[&::-webkit-scrollbar-thumb]:bg-gray-400">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="sticky top-0 z-10 bg-gray-50">
                <tr>
                    <!-- Name Column with Sort -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => (request('sort') === 'nama' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                            Name 
                            @if(request('sort') === 'nama')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </a>
                    </th>
                    
                    <!-- Price Column with Sort -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'harga', 'direction' => (request('sort') === 'harga' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                            Price
                            @if(request('sort') === 'harga')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </a>
                    </th>
                    
                    <!-- Total Price Column with Sort -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'ongkir', 'direction' => (request('sort') === 'ongkir' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                            Total Price
                            @if(request('sort') === 'ongkir')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </a>
                    </th>
                    
                    <!-- Category Column -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Category
                    </th>
                    
                    <!-- Brand Column -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Brand
                    </th>
                    
                    <!-- Store Column -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Store
                    </th>
                    
                    <!-- Actions Column -->
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                <tr class="hover:bg-gray-50">
                    <!-- Name Cell -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                                @if ($item->gambar)
                                    <img class="object-cover w-10 h-10 rounded-full" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                                @else
                                    <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- Price Cell -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                    </td>
                    
                    <!-- Total Price Cell -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</div>
                    </td>
                    
                    <!-- Category Cell -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                            {{ $item->kategori->nama }}
                        </span>
                    </td>
                    
                    <!-- Brand Cell -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $item->brand->name }}
                        </div>
                    </td>
                    
                    <!-- Store Cell -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $item->toko->nama }}
                        </div>
                    </td>
                    
                    <!-- Actions Cell -->
                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                        <div class="flex justify-end space-x-1">
                            <!-- View Button -->
                            <button onclick="openDrawer('drawer-view-{{ $item->id }}')" class="p-2 text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            
                            <!-- Edit Button -->
                            <button onclick="openDrawer('drawer-edit-{{ $item->id }}')" class="p-2 text-yellow-600 bg-yellow-100 rounded-md hover:bg-yellow-200" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <!-- Delete Button -->
                           <form method="POST" action="{{ route('items.destroy', $item->id) }}" class="inline form-delete" data-jenis="item">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 bg-red-100 rounded-md hover:bg-red-200" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                
                <!-- Include Drawers -->
                @include('items.partials.drawer-view', ['item' => $item])
                @include('items.partials.drawer-edit', ['item' => $item, 'tokos' => $toko, 'brands' => $brand, 'kategoris' => $kategori])
                
                @empty
                <!-- Empty State -->
                <tr>
                    <td colspan="10" class="px-6 py-4 text-sm text-center text-gray-500">
                        No items found. <a href="{{ route('items.create') }}" class="text-blue-500 hover:text-blue-700">Add your first item</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 rounded-b-lg sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $items->firstItem() }}</span> to <span class="font-medium">{{ $items->lastItem() }}</span> of <span class="font-medium">{{ $items->total() }}</span> results
                </p>
            </div>
            <div>
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openDrawer(id) {
        const drawer = document.getElementById(id);
        drawer.classList.remove('opacity-0', 'pointer-events-none');
        const content = drawer.querySelector('.transform');
        if (id.startsWith('drawer-view')) {
            content.classList.remove('-translate-x-full');
        } else {
            content.classList.remove('translate-x-full');
        }
    }

    function closeDrawer(id) {
        const drawer = document.getElementById(id);
        const content = drawer.querySelector('.transform');
        if (id.startsWith('drawer-view')) {
            content.classList.add('-translate-x-full');
        } else {
            content.classList.add('translate-x-full');
        }
        drawer.classList.add('opacity-0', 'pointer-events-none');
    }

    function handleOverlayClick(event, id) {
        if (event.target.id === id) {
            closeDrawer(id);
        }
    }

    function previewImage(event, previewId) {
        const reader = new FileReader();
        const imageField = document.getElementById(previewId);
        reader.onload = function () {
            imageField.src = reader.result;
            imageField.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush


 {{-- <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'tanggal', 'direction' => (request('sort') === 'tanggal' && request('direction') === 'asc') ? 'desc' : 'asc']) }}">
                            Category
                            @if(request('sort') === 'tanggal')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif 
                         </a>
                    </th> --}}