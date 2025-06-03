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
    <div class="flex-1 p-6 overflow-y-auto">
      <!-- Image -->
      @if($item->gambar)
      <div>
        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="object-contain w-full rounded max-h-60" />
      </div>
      @endif
      
      <!-- Details Grid -->
      <div class="grid grid-cols-1 gap-4">
        <div class="p-4 rounded-lg bg-gray-50">
          <h3 class="text-sm font-medium text-gray-500">Nama Produk</h3>
          <p class="mt-1 text-lg font-semibold text-gray-900">{{ $item->nama }}</p>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
          <div class="p-4 rounded-lg bg-gray-50">
            <h3 class="text-sm font-medium text-gray-500">Harga</h3>
            <p class="mt-1 text-lg font-semibold text-gray-900">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
          </div>
          
          <div class="p-4 rounded-lg bg-gray-50">
            <h3 class="text-sm font-medium text-gray-500">Ongkir</h3>
            <p class="mt-1 text-lg font-semibold text-gray-900">Rp{{ number_format($item->ongkir, 0, ',', '.') }}</p>
          </div>
        </div>
        
        <div class="p-4 rounded-lg bg-blue-50">
          <h3 class="text-sm font-medium text-blue-600">Total</h3>
          <p class="mt-1 text-xl font-bold text-blue-800">Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</p>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
          <div class="p-4 rounded-lg bg-gray-50">
            <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
            <p class="mt-1 font-medium text-gray-900">{{ $item->kategori->nama }}</p>
          </div>
          
          <div class="p-4 rounded-lg bg-gray-50">
            <h3 class="text-sm font-medium text-gray-500">Brand</h3>
            <p class="mt-1 font-medium text-gray-900">{{ $item->brand->name }}</p>
          </div>
        </div>
        
        <div class="p-4 rounded-lg bg-gray-50">
          <h3 class="text-sm font-medium text-gray-500">Toko</h3>
          <p class="mt-1 font-medium text-gray-900">{{ $item->toko->nama }}</p>
        </div>
        
        <div class="p-4 rounded-lg bg-gray-50">
          <h3 class="text-sm font-medium text-gray-500">Tanggal Pembelian</h3>
          <p class="mt-1 font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</p>
        </div>
      </div>
    </div>

  </div>
</div>
