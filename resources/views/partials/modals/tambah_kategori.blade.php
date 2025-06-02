  <div id="modal-TambahKategori" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 opacity-0 pointer-events-none bg-black/50">
    <div class="w-full max-w-md p-6 transition-all duration-300 transform scale-95 bg-white rounded-lg shadow">
        <button onclick="closeModal('TambahKategori')" class="absolute text-gray-500 top-2 right-3 hover:text-gray-700">✕</button>
        <h2 class="mb-4 text-xl font-semibold">Tambah Kategori</h2>

        <form action="{{ route('kategori.store') }}" method="POST">
          @csrf
          <input name="nama" type="text" placeholder="Nama Kategori" value="{{ old('nama') }}"
            class="w-full px-3 py-2 mb-1 border rounded @error('nama') border-red-500 @enderror"
            required autofocus>
            @error('nama')
              <p class="mb-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded">Simpan</button>
        </form>
    </div>
  </div>
  @if ($errors->any())
    <script>
        window.addEventListener('DOMContentLoaded', () => openModal('TambahKategori'));
    </script>
  @endif
  @if ($errors->any())
  <script>
     let hasValidationError = true;
     window.addEventListener('DOMContentLoaded', () => openModal('TambahKategori'));
  </script>
@else
  <script>
     let hasValidationError = false;
  </script>
@endif
