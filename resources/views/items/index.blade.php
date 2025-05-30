@extends('layouts.app')

@section('content')
<x-alert />
<x-breadcrumb :items="autoBreadcrumb()" />

<div class="container px-4 py-6 mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Daftar Item</h1>
        <a href="{{ route('items.create') }}"
            class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
            + Tambah Item
        </a>
        <a onclick="openDrawer()" class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
              <i class="w-5 text-center fas fa-home"></i>
                <span class="sidebar-text whitespace-nowrap">Drawer</span>
              </a>
    </div>

   

    @if($items->isEmpty())
        <p class="text-gray-500">Belum ada item yang tersedia.</p>
    @else
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($items as $item)
        <div class="p-4 bg-white shadow rounded-2xl">
            <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                 alt="{{ $item->nama }}"
                 class="object-cover w-full h-48 mb-4 rounded-lg">

            <h2 class="mb-1 text-lg font-semibold">{{ $item->nama }}</h2>
            <p class="mb-1 text-sm text-gray-500">Kategori: {{ $item->kategori->nama ?? '-' }}</p>
            <p class="mb-1 text-sm text-gray-500">Brand: {{ $item->brand->name ?? '-' }}</p>
            <p class="mb-1 text-sm text-gray-500">Toko: {{ $item->toko->nama ?? '-' }}</p>
            <p class="mb-1 text-sm text-gray-500">
                Tanggal Ditambahkan: {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
            </p>
            <p class="mb-2 text-sm font-bold text-gray-700">
                Rp{{ number_format($item->harga, 0, ',', '.') }} + Ongkir Rp{{ number_format($item->ongkir, 0, ',', '.') }}
            </p>

            <div class="flex justify-between mt-4">
                <a href="{{ route('items.show', $item) }}"
                   class="text-sm text-blue-600 hover:underline">Detail</a>
                <div class="flex space-x-2">
                    <button onclick="openEditModal({{ json_encode($item) }})"
                       class="text-sm text-yellow-600 hover:underline">Edit</button>
                    <form action="{{ route('items.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
<!-- Modal Edit Item -->
<div id="modal-edit-item" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="relative w-full max-w-2xl p-4">
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t">
                <h3 class="text-lg font-semibold">Edit Item</h3>
                <button type="button" class="text-gray-400 hover:text-gray-900" onclick="closeEditModal()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="form-edit-item" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="edit-nama" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" id="edit-harga" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Ongkir</label>
                        <input type="number" name="ongkir" id="edit-ongkir" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori_id" id="edit-kategori_id" class="w-full px-3 py-2 border rounded-lg" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Toko</label>
                        <select name="toko_id" id="edit-toko_id" class="w-full px-3 py-2 border rounded-lg" required>
                            @foreach ($tokos as $toko)
                                <option value="{{ $toko->id }}">{{ $toko->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Brand</label>
                        <select name="brand_id" id="edit-brand_id" class="w-full px-3 py-2 border rounded-lg" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gambar Saat Ini -->
                    <div class="mt-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                        <img id="edit-current-image" src="https://via.placeholder.com/150x100?text=No+Image"
                             class="object-cover w-40 border rounded-md h-28">
                    </div>

                    <div class="mt-4">
                        <div id="edit-new-image-label-container" class="flex items-center mb-1 transition-opacity duration-300 opacity-0">
                            <label id="edit-new-image-label" class="block text-sm font-medium text-gray-700">
                                Gambar Barunya
                            </label>
                            <button type="button" id="edit-clear-image-btn" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none" title="Hapus gambar baru">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <img id="edit-preview-image" class="hidden object-cover w-40 border rounded-md h-28" alt="Preview Gambar">
                    </div>

                    <div class="mt-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Gambar Baru</label>
                        <label for="edit-gambar" class="block w-full px-4 py-10 text-center text-gray-500 border-2 border-dashed rounded-lg cursor-pointer">
                            <span class="text-sm">Klik untuk unggah gambar baru</span>
                            <input type="file" name="gambar" id="edit-gambar" class="hidden">
                        </label>
                    </div>

                    <div class="mt-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="w-full px-3 py-2 border rounded-lg"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--  --}}
<!-- Drawer Overlay -->
 <div id="drawer" class="fixed inset-0 z-50 flex justify-end pr-6 transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-40">
  <!-- Drawer Content -->
  <div class="bg-white w-full max-w-xl h-[90vh] my-auto rounded-lg shadow-2xl transform translate-x-full transition-transform duration-300 flex flex-col">
    
    <!-- Sticky Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b rounded-t-lg">
      <h2 class="text-lg font-semibold">Tambah Data</h2>
      <button onclick="closeDrawer()" class="text-gray-600 hover:text-black">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Form Start -->
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
      @csrf
      <div class="flex-1 px-6 py-4 space-y-4 overflow-y-auto">
        <div>
          <label class="block mb-1 text-sm font-medium">Nama</label>
          <input type="text" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded" required />
        </div>
        <div class="flex gap-x-4">
            <div class="w-1/2">
                <label class="block mb-1 text-sm font-medium">Harga</label>
                <input type="number" name="harga" placeholder="Masukkan Harga" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded" required />
            </div>
            <div class="w-1/2">
                <label class="block mb-1 text-sm font-medium">Ongkir</label>
                <input type="number"name="ongkir" placeholder="Ongkir" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded" required />
            </div>
        </div>
        <div class="flex gap-x-4">
            <div class="w-1/3">
                <label class="block mb-1 text-sm font-medium">Toko</label>
                <select name="toko_id" required class="w-full px-3 py-2 border border-gray-300 rounded">
                <option value="">Pilih Toko</option>
                @foreach($tokos as $toko)
                    <option value="{{ $toko->id }}">{{ $toko->nama }}</option>
                @endforeach
                </select>
            </div>
            <div class="w-1/3">
                <label class="block mb-1 text-sm font-medium">Brand</label>
                <select name="brand_id" required class="w-full px-3 py-2 border border-gray-300 rounded">
                <option value="">Pilih Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="w-1/3">
                <label class="block mb-1 text-sm font-medium">Kategori</label>
                <select name="kategori_id" required class="w-full px-3 py-2 border border-gray-300 rounded">
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium">Tanggal (Opsional)</label>
          <input type="date" name="tanggal" id="tanggal" class="w-full px-3 py-2 border border-gray-300 rounded" value="{{ old('tanggal') }}">
        </div>
        <div>
            <label class="block mb-1 text-sm font-medium">Gambar</label>
            <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded" onchange="previewImage()" />
            <img id="preview" class="hidden mt-3 rounded shadow max-h-48" />
        </div>


        <div>
          <label class="block mb-1 text-sm font-medium">Keterangan</label>
          <textarea name="deskripsi" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded"></textarea>
        </div>

       
      </div>

      <!-- Sticky Footer -->
      <div class="sticky bottom-0 z-10 p-4 bg-white border-t rounded-b-lg">
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
            Simpan
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
{{--  --}}
<script>
    const basePath = '/storage/';

    const inputGambar = document.getElementById('edit-gambar');
    const previewImage = document.getElementById('edit-preview-image');
    const previewLabel = document.getElementById('edit-new-image-label');

    inputGambar.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                previewLabel.classList.remove('opacity-0');
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
            previewLabel.classList.add('opacity-0');
        }
    });

    function openEditModal(item) {
        document.getElementById('edit-nama').value = item.nama;
        document.getElementById('edit-harga').value = item.harga;
        document.getElementById('edit-ongkir').value = item.ongkir;
        document.getElementById('edit-kategori_id').value = item.kategori_id;
        document.getElementById('edit-toko_id').value = item.toko_id;
        document.getElementById('edit-brand_id').value = item.brand_id;
        document.getElementById('edit-deskripsi').value = item.deskripsi || '';
        document.getElementById('edit-current-image').src = item.gambar ? basePath + item.gambar : 'https://via.placeholder.com/150x100?text=No+Image';

        document.getElementById('form-edit-item').action = `/items/${item.id}`;

        // Reset preview dan label
        inputGambar.value = '';
        previewImage.src = '';
        previewImage.classList.add('hidden');
        previewLabel.classList.add('opacity-0');

        document.getElementById('modal-edit-item').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modal-edit-item').classList.add('hidden');
    }
</script>
<script>
 
</script>

@endsection