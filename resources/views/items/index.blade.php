@extends('layouts.app')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <!-- Header with Add Button -->
    <div class="flex flex-col items-start justify-between gap-4 mb-6 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-light text-gray-800">Item Management</h1>
            <p class="text-sm text-gray-500">Manage your product inventory</p>
        </div>
        <a href="{{ route('items.create') }}" class="flex items-center px-4 py-2 text-white transition-colors duration-200 bg-gray-900 rounded-lg hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Item
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="p-4 mb-6 bg-white shadow-sm rounded-xl">
        <form method="GET" action="{{ route('items.index') }}" class="flex flex-col gap-4 sm:flex-row">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search items..." 
                    value="{{ request('search') }}" 
                    class="w-full py-2 pl-10 pr-4 transition-all duration-200 border border-gray-200 rounded-lg focus:ring-1 focus:ring-gray-300 focus:border-gray-300"
                >
            </div>
            <button type="submit" class="px-4 py-2 text-white transition-colors duration-200 bg-gray-800 rounded-lg hover:bg-gray-700">
                Search
            </button>
        </form>
    </div>

    <!-- Items Table -->
    <div class="overflow-hidden bg-white shadow-sm rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Image</th>
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
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'ongkir', 'direction' => (request('sort') === 'ongkir' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                                Shipping
                                @if(request('sort') === 'ongkir')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Category</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Brand</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Store</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'tanggal', 'direction' => (request('sort') === 'tanggal' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                                Date
                                @if(request('sort') === 'tanggal')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($items as $item)
                    <tr class="transition-colors duration-150 hover:bg-gray-50">
                        <!-- Image Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($item->gambar)
                                <img class="object-cover w-10 h-10 rounded-md" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                            @else
                                <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        
                        <!-- Name Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                        </td>
                        
                        <!-- Price Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
                        </td>
                        
                        <!-- Shipping Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp{{ number_format($item->ongkir, 0, ',', '.') }}</div>
                        </td>
                        
                        <!-- Total Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</div>
                        </td>
                        
                        <!-- Category Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->kategori->nama }}</div>
                        </td>
                        
                        <!-- Brand Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->brand->name }}</div>
                        </td>
                        
                        <!-- Store Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->toko->nama }}</div>
                        </td>
                        
                        <!-- Date Column -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                            </div>
                        </td>
                        
                        <!-- Actions Column -->
                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <div class="flex justify-end space-x-2">
                                <button onclick="openDrawer('drawer-view-{{ $item->id }}')" class="p-2 text-gray-500 transition-colors duration-200 rounded-full hover:text-gray-700 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button onclick="openDrawer('drawer-edit-{{ $item->id }}')" class="p-2 text-blue-500 transition-colors duration-200 rounded-full hover:text-blue-700 hover:bg-blue-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('items.destroy', $item->id) }}" class="inline form-delete" data-jenis="item">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 transition-colors duration-200 rounded-full hover:text-red-700 hover:bg-red-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Include modal view dan drawer edit sebagai partial --}}
                    @include('items.partials.drawer-view', ['item' => $item])
                    @include('items.partials.drawer-edit', ['item' => $item, 'tokos' => $toko, 'brands' => $brand, 'kategoris' => $kategori])
                    
                    @empty
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