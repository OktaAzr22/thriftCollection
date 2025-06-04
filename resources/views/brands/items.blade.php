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

    <!-- Overlay -->
<div id="drawer-overlay" class="fixed inset-0 z-40 hidden bg-black bg-opacity-40" onclick="closeDrawer()"></div>

<!-- Drawer mirip sebelumnya -->
<div id="drawer" class="fixed inset-0 z-50 flex justify-start pl-6 transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-40"
     onclick="closeDrawer()">

  <div class="bg-white w-full max-w-xl h-[90vh] my-auto rounded-lg shadow-2xl transform -translate-x-full transition-transform duration-300 flex flex-col"
       onclick="event.stopPropagation()">

    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b rounded-t-lg">
      <h2 class="text-lg font-semibold">Detail Produk</h2>
      <button onclick="closeDrawer()" class="text-gray-600 hover:text-black">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Konten utama -->
    <div class="flex-1 p-4 space-y-3 overflow-hidden text-sm text-gray-700">
     <!-- Bagian atas: Gambar + Informasi -->
<div class="flex flex-col gap-4 p-4 rounded-lg sm:flex-row bg-gray-50">
  <!-- Gambar -->
  <div class="flex items-center justify-center w-full sm:w-1/3">
    <img id="drawerImage" src="" alt="Image"
      class="object-contain w-full p-2 bg-white border rounded-lg shadow-sm max-h-48" />
  </div>

  <!-- Info Produk -->
  <div class="flex flex-col justify-between w-full space-y-3 text-sm text-gray-700 sm:w-2/3">
    <!-- Nama dan Brand -->
    <div>
      <p id="drawerName" class="text-lg font-semibold text-gray-900"></p>
      <p id="drawerBrand" class="text-sm italic text-gray-500"></p>
    </div>

    <!-- Tanggal -->
    <p>
      <span class="font-medium text-gray-500">Tanggal:</span>
      <span id="drawerDate" class="ml-2 text-gray-800"></span>
    </p>

    <!-- Harga & Ongkir -->
    <div class="grid grid-cols-2 gap-4">
      <div>
        <p class="text-gray-500">Harga:</p>
        <p id="drawerPrice" class="text-base font-semibold text-green-600"></p>
      </div>
      <div>
        <p class="text-gray-500">Ongkir:</p>
        <p id="drawerShipping" class="text-base font-semibold text-blue-600"></p>
      </div>
    </div>

    <!-- Total -->
    <div class="flex justify-between pt-2 mt-2 text-base font-bold text-red-600 border-t">
      <span>Total</span>
      <span id="drawerTotal"></span>
    </div>

    <!-- Info Tambahan: Kategori, Toko, Asal -->
    <div class="grid grid-cols-1 gap-3 mt-3 text-sm sm:grid-cols-3">
      <div class="p-2 bg-white rounded shadow-sm">
        <span class="text-gray-500">Kategori:</span><br>
        <span id="drawerCategory" class="font-medium text-gray-800"></span>
      </div>
      <div class="p-2 bg-white rounded shadow-sm">
        <span class="text-gray-500">Toko:</span><br>
        <span id="drawerStore" class="font-medium text-gray-800"></span>
      </div>
      <div class="p-2 bg-white rounded shadow-sm">
        <span class="text-gray-500">Asal:</span><br>
        <span id="drawerAsal" class="font-medium text-gray-800"></span>
      </div>
    </div>
  </div>
</div>


      <!-- Deskripsi -->
      <!-- Deskripsi (scrollable only) -->
<div class="px-6 py-4 mt-2 border-t">
  <h3 class="mb-2 text-sm font-semibold text-gray-600 uppercase">Deskripsi</h3>
  <div class="pr-1 overflow-y-auto max-h-40"> <!-- SCROLL AREA -->
    <p id="drawerDesc" class="text-gray-700 whitespace-pre-line"></p>
  </div>
</div>

    </div>
  </div>
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
    // Set data
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

    // Show drawer
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


    