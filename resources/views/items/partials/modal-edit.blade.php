<div id="modal-edit-{{ $item->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity bg-black bg-opacity-50 opacity-0 pointer-events-none">
  <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
    <div class="flex items-center justify-between mb-3">
      <h3 class="text-lg font-bold text-gray-700">Edit Item</h3>
      <button onclick="closeModal('edit-{{ $item->id }}')" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <form action="{{ route('items.update', $item->id) }}" method="POST">
      @csrf @method('PUT')
      <div class="grid gap-4 text-sm">
        <input type="text" name="nama" value="{{ $item->nama }}" class="w-full p-2 border rounded" required placeholder="Nama Item">
        <input type="number" name="harga" value="{{ $item->harga }}" class="w-full p-2 border rounded" required placeholder="Harga">
        <input type="number" name="ongkir" value="{{ $item->ongkir }}" class="w-full p-2 border rounded" placeholder="Ongkir">
        <textarea name="deskripsi" class="w-full p-2 border rounded" placeholder="Deskripsi">{{ $item->deskripsi }}</textarea>
        <input type="number" name="rating" value="{{ $item->rating }}" max="5" min="0" class="w-full p-2 border rounded" placeholder="Rating (0-5)">
        <button type="submit" class="w-full px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">Update</button>
      </div>
    </form>
  </div>
</div>
