@extends('layouts.app')

@push('styles')

@endpush

@section('content')
<x-alert />
<form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <input type="text" name="nama" placeholder="Nama Item" required class="input" />
    <input type="number" name="harga" placeholder="Harga" step="0.01" required class="input" />
    <input type="number" name="ongkir" placeholder="Ongkir" step="0.01" class="input" />

    <select name="toko_id" required class="input">
        <option value="">Pilih Toko</option>
        @foreach($tokos as $toko)
            <option value="{{ $toko->id }}">{{ $toko->nama }}</option>
        @endforeach
    </select>

    <select name="brand_id" required class="input">
        <option value="">Pilih Brand</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
        @endforeach
    </select>

    <select name="kategori_id" required class="input">
        <option value="">Pilih Kategori</option>
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
        @endforeach
    </select>

    <div>
        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal (opsional)</label>
        <input type="date" name="tanggal" id="tanggal"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
               value="{{ old('tanggal') }}">
    </div>

    <input type="file" name="gambar" class="input" />
    <textarea name="deskripsi" placeholder="Deskripsi" class="input"></textarea>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>

@endsection

@push('scripts')

@endpush
