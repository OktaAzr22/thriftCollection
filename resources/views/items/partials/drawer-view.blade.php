<div id="drawer-view-{{ $item->id }}" 
     class="fixed inset-0 z-50 flex justify-center pl-6 transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-40"
     onclick="handleOverlayClick(event, 'drawer-view-{{ $item->id }}')">

  <div class="bg-white w-full max-w-xl h-[90vh] my-auto rounded-lg shadow-2xl transform -translate-x-full transition-transform duration-300 flex flex-col"
       onclick="event.stopPropagation()">

    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b rounded-t-lg">
      <h2 class="text-lg font-semibold">Detail Item</h2>
      <button onclick="closeDrawer('drawer-view-{{ $item->id }}')" class="text-gray-600 hover:text-black">
        <i class="fas fa-times"></i>
      </button>
    </div>
    

  <!-- Content -->
<!-- Content -->
<div class="flex-1 p-4 space-y-3 overflow-y-auto">
  <!-- Gambar + Info -->
  <div class="flex flex-col gap-4 sm:flex-row">
    
    <!-- Gambar -->
    <div class="flex items-center justify-center w-full rounded sm:w-1/2 max-h-52 bg-gray-50">
      @if($item->gambar)
        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="object-contain w-full rounded max-h-52" />
      @else
        <div class="flex items-center justify-center w-full h-48 text-sm text-gray-400 border-2 border-gray-300 border-dashed rounded">
          Tidak ada gambar
        </div>
      @endif
    </div>

    <!-- Info Kanan -->
    <div class="w-full space-y-2 text-sm text-gray-700 sm:w-1/2">
      <p><span class="text-gray-500">Nama Produk :</span> {{ $item->nama }}</p>
      <p><span class="text-gray-500">Brand :</span> {{ $item->brand->name }}</p>
      <p><span class="text-gray-500">Tanggal :</span> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</p>

      <div class="grid grid-cols-2 gap-2">
        <p><span class="text-gray-500">Harga :</span><br>
          <span class="font-semibold text-gray-900">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
        </p>
        <p><span class="text-gray-500">Ongkir :</span><br>
          <span class="font-semibold text-gray-900">Rp{{ number_format($item->ongkir, 0, ',', '.') }}</span>
        </p>
      </div>

      <hr class="border-gray-300">

      <p><span class="font-medium text-blue-600">Total :</span>
        <span class="text-xl font-bold text-blue-800">Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</span>
      </p>
    </div>
  </div>

  <!-- Kategori dan Toko -->
  <div class="grid grid-cols-1 gap-4 mb-2 sm:grid-cols-2">
    <div class="p-3 rounded-lg bg-gray-50">
      <p><span class="text-sm text-gray-500">Kategori :</span> <span class="font-medium text-gray-900">{{ $item->kategori->nama }}</span></p>
      
    </div>
    <div class="p-3 rounded-lg bg-gray-50">
      <p><span class="text-sm text-gray-500">Toko :</span> <span class="font-medium text-gray-900">{{ $item->toko->nama }}</span></p>
    </div>
  </div>

  <!-- Deskripsi -->
<div class="p-4 mt-2 rounded-lg bg-gray-50">
  <h3 class="mb-2 text-sm text-gray-500">Deskripsi :</h3>
  
  @if($item->deskripsi)
    <p class="text-gray-700 whitespace-pre-line">{{ $item->deskripsi }}</p>
  @else
  <div class="flex items-center justify-center h-48 text-sm text-gray-400 border-2 border-gray-300 border-dashed rounded">
  Tidak ada deskripsi
</div>


  @endif

</div>

</div>




  </div>
</div>
