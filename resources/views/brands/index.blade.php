@extends('layouts.app')

@section('content')
<x-alert />
    {{-- sec 1 --}}
    <div class="p-6 mb-6 bg-white rounded-lg shadow-xl/30">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Tambah Brand</h2>
            <button id="toggleFormBtn" onclick="toggleForm()"
                    aria-expanded="false" aria-controls="formContent">
                <i id="toggleIcon" class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div id="formContent"
             class="overflow-hidden transition-all duration-300 ease-in-out"
             style="height: 0px;">
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700" for="name">Nama Brand<span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400" placeholder="Masukkan Brand name"/>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Gambar Brand</label>
                    <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-gray-500 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                </div>           
                <div class="md:col-span-2">
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-green-700">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- sec 2 --}}
   <div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
    <!-- Header with Search -->
    <div class="flex flex-col items-start justify-between gap-4 mb-4 sm:flex-row sm:items-center">
        <h2 class="text-xl font-semibold text-gray-800">List Brand</h2>
        <form action="{{ route('brands.index') }}" method="GET" class="relative w-full sm:w-auto">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama brand..."
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 sm:w-64" />
                @if(request('search'))
                <button type="button" onclick="this.form.search.value='';this.form.submit()"
                    class="absolute text-xl text-gray-400 -translate-y-1/2 right-3 top-1/2 hover:text-red-500 focus:outline-none">
                    &times;
                </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="overflow-auto border border-gray-200 rounded-lg scroll-hidden">
        <table class="min-w-full text-sm bg-white divide-y divide-gray-200">
            <thead class="sticky top-0 z-10 text-xs text-left text-gray-500 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3 font-medium">Logo</th>
                    <th class="px-6 py-3 font-medium">Brand Name</th>
                    <th class="px-6 py-3 font-medium">Item</th>
                    <th class="px-6 py-3 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse ($brands as $brand)
                <tr class="transition-colors hover:bg-gray-50/50">
                    <!-- Logo Column -->
                    <td class="px-6 py-4">
                        <div class="flex justify-center">
                            <div class="flex items-center justify-center p-2 bg-white border border-gray-100 rounded-lg shadow-sm">
                                <img class="object-contain h-12 max-w-[80px]" 
                                     src="{{ $brand->image_url }}" 
                                     alt="{{ $brand->name }}" 
                                     onerror="this.src='https://via.placeholder.com/100?text=LOGO'">
                            </div>
                        </div>
                    </td>
                    
                    <!-- Brand Name Column -->
                    <td class="px-6 py-4">
                        <div>
                            <div class="font-medium text-gray-900">{{ $brand->name }}</div>
                            <div class="mt-1 text-xs text-gray-500">Since {{ $brand->created_at->format('d M Y') }}</div>
                        </div>
                    </td>
                    
                    <!-- Items Count Column -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 text-green-800 bg-green-100 rounded-full">
                                {{ $brand->items_count }} products
                            </span>
                        </div>
                    </td>
                    
                    <!-- Actions Column -->
                    <td class="px-6 py-4">
                        <div class="flex justify-end space-x-2">
                            <!-- View Button -->
                            <a href="{{ route('brand.items', $brand->id) }}" 
                               class="p-1.5 text-gray-400 transition-colors rounded-full hover:text-blue-600 hover:bg-blue-50"
                               title="View Products">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            
                            <!-- Edit Button -->
                            <button onclick="openModal('{{ $brand->id }}')"
                                class="p-1.5 text-gray-400 transition-colors rounded-full hover:text-yellow-600 hover:bg-yellow-50" 
                                title="Edit Brand">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="form-delete" data-jenis="Brand">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="p-1.5 text-gray-400 transition-colors rounded-full hover:text-red-600 hover:bg-red-50" 
                                        title="Delete Brand">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                
                <!-- Edit Modal for each brand -->
                <div id="modal-{{ $brand->id }}" role="dialog" aria-modal="true"
                     class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 pointer-events-none">
                    <div class="relative w-full max-w-md p-6 transition-transform duration-300 transform scale-95 bg-white rounded-lg shadow-lg sm:p-8">
                        <button onclick="closeModal('{{ $brand->id }}')" 
                                class="absolute text-gray-400 top-4 right-4 hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <h2 class="mb-4 text-xl font-bold text-gray-800">Edit Brand</h2>
                        <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Nama Brand</label>
                                <input type="text" name="name" value="{{ $brand->name }}" 
                                       class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                       required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Baru (opsional)</label>
                                <input type="file" name="image" accept="image/*" 
                                       class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                            @if($brand->image)
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-700">Gambar Saat Ini:</span>
                                <img src="{{ asset('storage/'.$brand->image) }}" class="h-16 mt-2 border border-gray-200 rounded">
                            </div>
                            @endif
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button" onclick="closeModal('{{ $brand->id }}')"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Batal
                                </button>
                                <button type="submit" 
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada brand yang ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($brands->hasPages())
    <div class="flex flex-col items-center justify-between mt-6 space-y-4 sm:flex-row sm:space-y-0">
        <div class="text-sm text-gray-600">
            Menampilkan <span class="font-semibold">{{ $brands->firstItem() }}</span> -
            <span class="font-semibold">{{ $brands->lastItem() }}</span> dari
            <span class="font-semibold">{{ $brands->total() }}</span> Brand
        </div>
        <div class="text-sm">
            {{ $brands->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection


