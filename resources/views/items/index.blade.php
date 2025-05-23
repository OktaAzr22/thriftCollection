@extends('layouts.app')

@section('content')
<x-breadcrumb :items="autoBreadcrumb()" />

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Item</h1>
        <a href="{{ route('items.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Tambah Item
        </a>
    </div>

    

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <p class="text-gray-500">Belum ada item yang tersedia.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
        <div class="bg-white rounded-2xl shadow p-4">
            <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                 alt="{{ $item->nama }}"
                 class="w-full h-48 object-cover rounded-lg mb-4">

            <h2 class="text-lg font-semibold mb-1">{{ $item->nama }}</h2>
            <p class="text-sm text-gray-500 mb-1">Kategori: {{ $item->kategori->nama ?? '-' }}</p>
            <p class="text-sm text-gray-500 mb-1">Brand: {{ $item->brand->name ?? '-' }}</p>
            <p class="text-sm text-gray-500 mb-1">Toko: {{ $item->toko->nama ?? '-' }}</p>
            <p class="text-sm text-gray-500 mb-1">
                Tanggal Ditambahkan: {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
            </p>
            <p class="text-sm text-gray-700 font-bold mb-2">
                Rp{{ number_format($item->harga, 0, ',', '.') }} + Ongkir Rp{{ number_format($item->ongkir, 0, ',', '.') }}
            </p>

            <div class="flex justify-between mt-4">
                <a href="{{ route('items.show', $item) }}"
                   class="text-blue-600 hover:underline text-sm">Detail</a>
                <div class="flex space-x-2">
                    <button onclick="openEditModal({{ json_encode($item) }})"
                       class="text-yellow-600 hover:underline text-sm">Edit</button>
                    <form action="{{ route('items.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
<!-- Modal Edit Item -->
<div id="modal-edit-item" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-2xl p-4">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center pb-4 mb-4 border-b rounded-t">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="nama" id="edit-nama" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                        <input type="number" name="harga" id="edit-harga" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ongkir</label>
                        <input type="number" name="ongkir" id="edit-ongkir" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori_id" id="edit-kategori_id" class="w-full border rounded-lg px-3 py-2" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Toko</label>
                        <select name="toko_id" id="edit-toko_id" class="w-full border rounded-lg px-3 py-2" required>
                            @foreach ($tokos as $toko)
                                <option value="{{ $toko->id }}">{{ $toko->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <select name="brand_id" id="edit-brand_id" class="w-full border rounded-lg px-3 py-2" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gambar Saat Ini -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                        <img id="edit-current-image" src="https://via.placeholder.com/150x100?text=No+Image"
                             class="w-40 h-28 object-cover rounded-md border">
                    </div>

                    <div class="mt-4">
                        <div id="edit-new-image-label-container" class="flex items-center mb-1 opacity-0 transition-opacity duration-300">
                            <label id="edit-new-image-label" class="block text-sm font-medium text-gray-700">
                                Gambar Barunya
                            </label>
                            <button type="button" id="edit-clear-image-btn" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none" title="Hapus gambar baru">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <img id="edit-preview-image" class="w-40 h-28 object-cover rounded-md border hidden" alt="Preview Gambar">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Baru</label>
                        <label for="edit-gambar" class="block w-full px-4 py-10 text-center text-gray-500 border-2 border-dashed rounded-lg cursor-pointer">
                            <span class="text-sm">Klik untuk unggah gambar baru</span>
                            <input type="file" name="gambar" id="edit-gambar" class="hidden">
                        </label>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="w-full border rounded-lg px-3 py-2"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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




@endsection
