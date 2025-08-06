@extends('layouts.app')

@section('content')
<x-alert />
<div class="p-4 bg-white rounded-lg shadow-lg">
    @if($items->count() > 0)
    <div class="flex items-start justify-between mb-4">
        <div>
            <a href="{{ url()->previous() }}">
                <button class="flex items-center gap-2 text-gray-600 hover:text-black">
                    <i class="fas fa-arrow-left"></i>
                    <span class="text-sm font-medium">Kembali</span>
                </button>
            </a>
        </div>
        <span class="px-4 py-1 text-sm text-gray-600 bg-gray-100 rounded-full shadow">{{ $items->count() }} items available</span>
    </div>
    <hr>
    <h3 class="mb-4 text-gray-900">List {{ $brand->name }}</h3>
    <div class="grid grid-rows-2 auto-cols-[13rem] grid-flow-col gap-6 overflow-x-auto p-3 max-w-full scrollbar-hide">
        @foreach($items as $item)
        <div onclick="openDrawer(this)"
            class="overflow-hidden transition-transform rounded-lg shadow-lg cursor-pointer w-52 h-52 group hover:scale-105"
            data-nama="{{ $item->nama }}"
            data-brand="{{ $item->brand->name }}"
            data-kategori="{{ $item->kategori->nama ?? 'General' }}"
            data-toko="{{ $item->toko->nama ?? 'Unknown Store' }}"
            data-asal="{{ $item->toko->asal ?? 'Not Found' }}"
            data-tanggal="{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}"
            data-harga="{{ number_format($item->harga) }}"
            data-ongkir="{{ number_format($item->ongkir) }}"
            data-total="{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}"
            data-deskripsi="{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}"
            data-gambar="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
        >
            <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}" alt="{{ $item->nama }}" class="object-cover w-full h-full transition duration-300 group-hover:grayscale" />
        </div>
        @endforeach
    </div>
    @include('brands.partials.drawer')
</div>
    @else
    <x-empty-message 
        title="Oops, Data Tidak Ditemukan!" 
        message="Maaf, produk untuk brand ini belum tersedia." 
        button-text="Back" 
        button-url="{{ route('brands.index') }}"/>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function openDrawer(el) {

    document.getElementById('drawerImage').src = el.dataset.gambar;
    document.getElementById('drawerName').innerText = el.dataset.nama;
    document.getElementById('drawerBrand').innerText = el.dataset.brand;
    document.getElementById('drawerCategory').innerText = el.dataset.kategori;
    document.getElementById('drawerStore').innerText = el.dataset.toko;
    document.getElementById('drawerDate').innerText = el.dataset.tanggal;
    document.getElementById('drawerPrice').innerText = "Rp " + el.dataset.harga;
    document.getElementById('drawerShipping').innerText = "Rp " + el.dataset.ongkir;
    document.getElementById('drawerTotal').innerText = "Rp " + el.dataset.total;
    document.getElementById('drawerDesc').innerText = el.dataset.deskripsi;
    document.getElementById('drawerAsal').innerText = el.dataset.asal;

    const overlay = document.getElementById('drawer');
    overlay.classList.remove('opacity-0', 'pointer-events-none');
    const drawerBox = overlay.querySelector('.transform');
    drawerBox.classList.remove('-translate-x-full');
    drawerBox.classList.add('translate-x-0');
}

function closeDrawer() {
    const overlay = document.getElementById('drawer');
    overlay.classList.add('opacity-0', 'pointer-events-none');
    const drawerBox = overlay.querySelector('.transform');
    drawerBox.classList.add('-translate-x-full');
    drawerBox.classList.remove('translate-x-0');
}
</script>
@endpush    