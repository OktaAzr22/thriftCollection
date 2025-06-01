<div id="drawer-edit-{{ $item->id }}" class="fixed inset-0 z-50 flex justify-end pr-6 transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-40" onclick="handleOverlayClick(event, 'drawer-edit-{{ $item->id }}')">
  <div class="bg-white w-full max-w-xl h-[90vh] my-auto rounded-lg shadow-2xl transform translate-x-full transition-transform duration-300 flex flex-col">

    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b rounded-t-lg">
      <h2 class="text-lg font-semibold">Edit Item</h2>
      <button onclick="closeDrawer('drawer-edit-{{ $item->id }}')" class="text-gray-600 hover:text-black">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Form -->
    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" >
      @csrf
      @method('PUT')

      <div class="flex-1 px-6 py-4 space-y-4 overflow-y-auto">
        <!-- Nama -->
        <div>
          <label class="block mb-1 text-sm font-medium">Nama</label>
          <input type="text" name="nama" value="{{ old('nama', $item->nama) }}" class="w-full px-3 py-2 border border-gray-300 rounded" required />
        </div>

        <!-- Harga & Ongkir -->
        <div class="flex gap-x-4">
          <div class="w-1/2">
            <label class="block mb-1 text-sm font-medium">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $item->harga) }}" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded" required />
          </div>
          <div class="w-1/2">
            <label class="block mb-1 text-sm font-medium">Ongkir</label>
            <input type="number" name="ongkir" value="{{ old('ongkir', $item->ongkir) }}" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded" />
          </div>
        </div>

        <!-- Dropdown Toko, Brand, Kategori -->
        <div class="flex gap-x-4">
          <div class="w-1/3">
            <label class="block mb-1 text-sm font-medium">Toko</label>
            <select name="toko_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
              @foreach($tokos as $tokoOption)
                <option value="{{ $tokoOption->id }}" {{ $item->toko_id == $tokoOption->id ? 'selected' : '' }}>{{ $tokoOption->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="w-1/3">
            <label class="block mb-1 text-sm font-medium">Brand</label>
            <select name="brand_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
              @foreach($brands as $brandOption)
                <option value="{{ $brandOption->id }}" {{ $item->brand_id == $brandOption->id ? 'selected' : '' }}>{{ $brandOption->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="w-1/3">
            <label class="block mb-1 text-sm font-medium">Kategori</label>
            <select name="kategori_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
              @foreach($kategoris as $kategoriOption)
                <option value="{{ $kategoriOption->id }}" {{ $item->kategori_id == $kategoriOption->id ? 'selected' : '' }}>{{ $kategoriOption->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- Tanggal -->
        <div>
          <label class="block mb-1 text-sm font-medium">Tanggal</label>
          <input type="date" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}" class="w-full px-3 py-2 border border-gray-300 rounded" />
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium">Keterangan</label>
          <textarea name="deskripsi" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded">{{ old('deskripsi', $item->deskripsi) }}</textarea>

        </div>
        <!-- Gambar -->
        <div>
          <label class="block mb-1 text-sm font-medium">Gambar</label>
          <input type="file" name="gambar" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded" onchange="previewImage(event, 'preview-{{ $item->id }}')" />
          @if($item->gambar)
            <div class="mt-3">
              <img id="preview-{{ $item->id }}" src="{{ asset('storage/' . $item->gambar) }}" class="object-cover h-24 rounded shadow" />
            </div>
          @else
            <img id="preview-{{ $item->id }}" class="hidden mt-3 rounded shadow max-h-40" />
          @endif
        </div>

      </div>

      <!-- Footer -->
      <div class="flex justify-end p-4 border-t rounded-b-lg bg-gray-50">
        <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>
</div>
