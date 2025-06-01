<div id="drawer-view-{{ $item->id }}" 
     class="fixed inset-0 z-50 flex justify-start pl-6 transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-40"
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
    <div class="flex-1 px-6 py-4 space-y-4 overflow-y-auto">
      <div><strong>Nama:</strong> <p>{{ $item->nama }}</p></div>
      <div><strong>Harga:</strong> <p>Rp{{ number_format($item->harga, 0, ',', '.') }}</p></div>
      <div><strong>Ongkir:</strong> <p>Rp{{ number_format($item->ongkir, 0, ',', '.') }}</p></div>
      <div><strong>Total:</strong> <p>Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</p></div>
      <div><strong>Kategori:</strong> <p>{{ $item->kategori->nama }}</p></div>
      <div><strong>Brand:</strong> <p>{{ $item->brand->name }}</p></div>
      <div><strong>Toko:</strong> <p>{{ $item->toko->nama }}</p></div>
      <div><strong>Tanggal:</strong> <p>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</p></div>

      @if($item->gambar)
      <div>
        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="object-contain w-full rounded max-h-60" />
      </div>
      @endif
    </div>
  </div>
</div>
