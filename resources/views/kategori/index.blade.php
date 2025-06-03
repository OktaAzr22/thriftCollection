@extends('layouts.app')

@push('styles')
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .card-gradient-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }
    .hover-scale {
        transition: transform 0.2s ease;
    }
    .hover-scale:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<x-alert />
{{-- <x-breadcrumb :items="autoBreadcrumb()" /> --}}

<div class="container px-4 mx-auto">
    

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <!-- Form Card -->
        <div class="overflow-hidden bg-white shadow-sm rounded-xl hover-scale">
            <div class="px-6 py-4 card-gradient-header">
                <h2 class="text-lg font-medium text-white">
                    <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ isset($kategori) ? 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' : 'M12 6v6m0 0v6m0-6h6m-6 0H6' }}"></path>
                    </svg>
                    {{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                </h2>
            </div>
            <div class="p-6">
               <form method="POST" action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}">
    @csrf
    @if(isset($kategori))
        @method('PUT')
    @endif

    <div class="mb-6">
        <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama Kategori</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <input type="text" id="nama" name="nama"
                   class="w-full pl-10 pr-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                   placeholder="Contoh: Elektronik"
                   value="{{ old('nama', isset($kategori) ? $kategori->nama : '') }}">
        </div>
        
        @error('nama')
            <div class="flex items-start mt-2 text-sm text-red-600">
                <svg class="flex-shrink-0 w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="flex justify-end space-x-3">
        @if(isset($kategori))
            <a href="{{ route('kategori.index') }}"
               class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Batal
            </a>
        @endif
        <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            {{ isset($kategori) ? 'Update Kategori' : 'Simpan Kategori' }}
        </button>
    </div>
</form>
            </div>
        </div>

        <!-- List Card -->
        <div class="overflow-hidden bg-white shadow-sm rounded-xl hover-scale">
            <div class="px-6 py-4 card-gradient-header">
                <h2 class="text-lg font-medium text-white">
                    <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Daftar Kategori
                </h2>
            </div>
            <div class="p-6">
                @if($kategoris->isEmpty())
                    <div class="p-4 rounded-lg bg-blue-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">Belum ada kategori yang tersedia</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="overflow-y-auto border border-gray-200 rounded-lg hide-scrollbar">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="sticky top-0 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">#</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        <a href="{{ route('kategori.index', ['sort' => $sort === 'asc' ? 'desc' : 'asc']) }}" class="inline-flex items-center group">
                                            <span>Nama Kategori</span>
                                            <svg class="w-4 h-4 ml-1 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sort === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                            </svg>
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($kategoris as $index => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $kategoris->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->nama }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('kategori.index', ['kategori' => $item->id]) }}"
                                                   class="p-2 text-blue-600 rounded-full hover:bg-blue-50" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="form-delete" data-jenis="kategori">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 rounded-full hover:bg-red-50" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($kategoris->hasPages())
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-sm text-gray-600">
                                Menampilkan <span class="font-medium">{{ $kategoris->firstItem() }}</span> sampai <span class="font-medium">{{ $kategoris->lastItem() }}</span> dari <span class="font-medium">{{ $kategoris->total() }}</span> kategori
                            </div>
                            <div class="flex space-x-2">
                                {{ $kategoris->links('pagination::tailwind') }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection