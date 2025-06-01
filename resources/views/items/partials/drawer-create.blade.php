<div id="drawer" class="fixed inset-0 z-50 flex justify-end transition-opacity bg-black bg-opacity-50 opacity-0 pointer-events-none">
  <div class="w-full h-full max-w-md p-6 overflow-y-auto transition-transform transform translate-x-full bg-white shadow-lg">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-bold text-gray-700">Tambah Item</h3>
      <button onclick="closeDrawer()" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid gap-4 text-sm">

        <input type="text" name="nama" class="w-full p-2 border rounded" required placeholder="Nama Item">
        <input type="number" name="harga" class="w-full p-2 border rounded" required placeholder="Harga">
        <input type="number" name="ongkir" class="w-full p-2 border rounded" placeholder="Ongkir">

        <select name="kategori_id" class="w-full p-2 border rounded" required>
          <option value="">Pilih Kategori</option>
          @foreach($kategori as $k)
          <option value="{{ $k->id }}">{{ $k->nama }}</option>
          @endforeach
        </select>

        <select name="brand_id" class="w-full p-2 border rounded" required>
          <option value="">Pilih Brand</option>
          @foreach($brand as $b)
          <option value="{{ $b->id }}">{{ $b->name }}</option>
          @endforeach
        </select>

        <select name="toko_id" class="w-full p-2 border rounded" required>
          <option value="">Pilih Toko</option>
          @foreach($toko as $t)
          <option value="{{ $t->id }}">{{ $t->nama }}</option>
          @endforeach
        </select>

        <textarea name="deskripsi" class="w-full p-2 border rounded" placeholder="Deskripsi"></textarea>
        <input type="number" name="rating" max="5" min="0" class="w-full p-2 border rounded" placeholder="Rating (0-5)">

        <!-- Input Upload Gambar -->
        <label class="block font-medium text-gray-700">Upload Gambar:</label>
        <input type="file" name="gambar" id="gambarInput" accept="image/*" class="w-full p-2 border rounded">

        <!-- Preview Gambar -->
        <div id="previewContainer" class="hidden mt-2">
          <p class="mb-1 text-sm font-semibold">Preview Gambar:</p>
          <img id="previewImage" src="#" alt="Preview Gambar" class="max-w-full border rounded max-h-48" />
        </div>

        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
  const gambarInput = document.getElementById('gambarInput');
  const previewContainer = document.getElementById('previewContainer');
  const previewImage = document.getElementById('previewImage');

  gambarInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      previewContainer.classList.remove('hidden');
      reader.addEventListener('load', function () {
        previewImage.setAttribute('src', this.result);
      });
      reader.readAsDataURL(file);
    } else {
      previewContainer.classList.add('hidden');
      previewImage.setAttribute('src', '');
    }
  });

  // Fungsi closeDrawer (kalau belum ada)
  function closeDrawer() {
    const drawer = document.getElementById('drawer');
    drawer.classList.add('opacity-0', 'pointer-events-none');
    drawer.firstElementChild.classList.add('translate-x-full');
  }

  // Kamu juga bisa buat openDrawer fungsi supaya drawer muncul, contohnya:
  function openDrawer() {
    const drawer = document.getElementById('drawer');
    drawer.classList.remove('opacity-0', 'pointer-events-none');
    drawer.firstElementChild.classList.remove('translate-x-full');
  }
</script>



