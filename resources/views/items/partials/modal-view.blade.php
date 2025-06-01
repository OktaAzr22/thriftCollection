<div id="modal-view-{{ $item->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity bg-black bg-opacity-50 opacity-0 pointer-events-none">
  <div class="w-full max-w-lg p-6 space-y-4 bg-white rounded-lg shadow-lg">
    <div class="flex items-center justify-between mb-2">
      <h3 class="text-lg font-bold text-gray-700">Detail Item</h3>
      <button onclick="closeModal('view-{{ $item->id }}')" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
      <p><strong>Nama:</strong> {{ $item->nama }}</p>
      <p><strong>Harga:</strong> Rp{{ number_format($item->harga) }}</p>
      <p><strong>Ongkir:</strong> Rp{{ number_format($item->ongkir) }}</p>
      <p><strong>Kategori:</strong> {{ $item->kategori->nama }}</p>
      <p><strong>Brand:</strong> {{ $item->brand->nama }}</p>
      <p><strong>Toko:</strong> {{ $item->toko->nama }}</p>
      <p><strong>Rating:</strong> {{ $item->rating }}/5</p>
      <p class="col-span-2"><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
    </div>
  </div>
</div>
