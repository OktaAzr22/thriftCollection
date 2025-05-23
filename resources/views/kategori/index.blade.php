@extends('layouts.app')

@push('styles')
<style>
    /* Hilangkan scrollbar tapi tetap bisa scroll */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush

@section('content')
<x-alert />

<h1 class="text-2xl font-bold text-gray-800 mb-6">
    <i class="fas fa-tags mr-2"></i> Manajemen Kategori
</h1>

<div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden min-h-[500px]">
            <div class="bg-blue-600 px-6 py-4 text-white">
                <h2 class="text-lg font-semibold">
                    <i class="fas {{ isset($kategori) ? 'fa-edit' : 'fa-plus' }} mr-2"></i>
                    {{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                </h2>
            </div>
            <div class="p-6">
                <form method="POST"
                      action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}">
                    @csrf
                    @if(isset($kategori))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-gray-400"></i>
                            </div>
                            <input type="text" id="nama" name="nama"
                                   class="pl-10 w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500
                                   @error('nama') border-red-500 @enderror"
                                   placeholder="Masukkan nama kategori"
                                   value="{{ old('nama', isset($kategori) ? $kategori->nama : '') }}">
                        </div>
                        @error('nama')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        @if(isset($kategori))
                            <a href="{{ route('kategori.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                        @endif
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas {{ isset($kategori) ? 'fa-save' : 'fa-plus' }} mr-1"></i>
                            {{ isset($kategori) ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden min-h-[500px]">
            <div class="bg-blue-600 px-6 py-4 text-white">
                <h2 class="text-lg font-semibold">
                    <i class="fas fa-list-ul mr-2"></i> Daftar Kategori
                </h2>
            </div>
            <div class="p-6">
                @if($kategoris->isEmpty())
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">Tidak ada data kategori</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="overflow-y-auto max-h-[450px] border rounded hide-scrollbar">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50">
                                        <a href="{{ route('kategori.index', ['sort' => $sort === 'asc' ? 'desc' : 'asc']) }}" class="inline-flex items-center space-x-1 hover:text-blue-600">
                                            <span>Nama Kategori</span>
                                            @if($sort === 'asc')
                                                <i class="fas fa-caret-up"></i>
                                            @else
                                                <i class="fas fa-caret-down"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($kategoris as $index => $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('kategori.index', ['kategori' => $item->id]) }}"
                                                   class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="form-delete" data-jenis="kategori">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $kategoris->count() }} kategori dari total {{ $kategoris->count() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
