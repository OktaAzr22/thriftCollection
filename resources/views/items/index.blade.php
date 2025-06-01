@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold text-gray-700">Daftar Item</h2>
    <a href="{{ route('items.create') }}">
        <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            <i class="mr-2 fas fa-plus"></i>Tambah Item
        </button>
    </a>
</div>

<!-- Form Search -->
<form method="GET" action="{{ route('items.index') }}" class="mb-4">
    <input 
        type="text" 
        name="search" 
        placeholder="Cari nama item..." 
        value="{{ request('search') }}" 
        class="w-full max-w-xs px-3 py-2 border rounded"
    >
</form>

<div class="overflow-auto bg-white rounded shadow">
    <table class="min-w-full text-sm divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 font-semibold text-left text-gray-600">Gambar</th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => (request('sort') === 'nama' && request('direction') === 'asc') ? 'desc' : 'asc']) }}">
                        Nama {!! (request('sort') === 'nama' ? (request('direction') === 'asc' ? '↑' : '↓') : '') !!}
                    </a>
                </th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'harga', 'direction' => (request('sort') === 'harga' && request('direction') === 'asc') ? 'desc' : 'asc']) }}">
                        Harga {!! (request('sort') === 'harga' ? (request('direction') === 'asc' ? '↑' : '↓') : '') !!}
                    </a>
                </th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'ongkir', 'direction' => (request('sort') === 'ongkir' && request('direction') === 'asc') ? 'desc' : 'asc']) }}">
                        Ongkir {!! (request('sort') === 'ongkir' ? (request('direction') === 'asc' ? '↑' : '↓') : '') !!}
                    </a>
                </th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600">Total</th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600">Kategori</th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600">Brand</th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600">Toko</th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'tanggal', 'direction' => (request('sort') === 'tanggal' && request('direction') === 'asc') ? 'desc' : 'asc']) }}">
                        Tanggal {!! (request('sort') === 'tanggal' ? (request('direction') === 'asc' ? '↑' : '↓') : '') !!}
                    </a>
                </th>
                <th class="px-4 py-2 font-semibold text-left text-gray-600">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @forelse($items as $item)
            <tr>
                <td class="px-4 py-2">
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="object-cover w-12 h-12 rounded" alt="{{ $item->nama }}">
                    @else
                        <span class="italic text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $item->nama }}</td>
                <td class="px-4 py-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="px-4 py-2">Rp{{ number_format($item->ongkir, 0, ',', '.') }}</td>
                <td class="px-4 py-2">Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</td>
                <td class="px-4 py-2">{{ $item->kategori->nama }}</td>
                <td class="px-4 py-2">{{ $item->brand->name }}</td>
                <td class="px-4 py-2">{{ $item->toko->nama }}</td>
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                <td class="px-4 py-2 space-x-2">
                    <button onclick="openDrawer('drawer-view-{{ $item->id }}')" class="text-blue-500 hover:underline">
    <i class="fas fa-eye"></i>
</button>

                    <button onclick="openDrawer('drawer-edit-{{ $item->id }}')" class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Edit
                    </button>
                    <form method="POST" action="{{ route('items.destroy', $item->id) }}" class="inline form-delete" data-jenis="item">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>

            {{-- Include modal view dan drawer edit sebagai partial --}}
           @include('items.partials.drawer-view', ['item' => $item])

            @include('items.partials.drawer-edit', ['item' => $item, 'tokos' => $toko, 'brands' => $brand, 'kategoris' => $kategori])
            @empty
            <tr>
                <td colspan="10" class="px-4 py-6 italic text-center text-gray-500">Data item tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex items-center justify-between mt-4 text-sm text-gray-600">
        <div>
            Menampilkan {{ $items->firstItem() }} sampai {{ $items->lastItem() }} dari total {{ $items->total() }} item
        </div>
        <div>
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   function openDrawer(id) {
    const drawer = document.getElementById(id);
    drawer.classList.remove('opacity-0', 'pointer-events-none');
    const content = drawer.querySelector('.transform');
    if (id.startsWith('drawer-view')) {
      content.classList.remove('-translate-x-full');
    } else {
      content.classList.remove('translate-x-full');
    }
  }

  function closeDrawer(id) {
    const drawer = document.getElementById(id);
    const content = drawer.querySelector('.transform');
    if (id.startsWith('drawer-view')) {
      content.classList.add('-translate-x-full');
    } else {
      content.classList.add('translate-x-full');
    }
    drawer.classList.add('opacity-0', 'pointer-events-none');
  }

  function handleOverlayClick(event, id) {
    // Kalau kliknya di luar drawer (overlay), maka tutup drawer
    if (event.target.id === id) {
      closeDrawer(id);
    }
  }

  function previewImage(event, previewId) {
    const reader = new FileReader();
    const imageField = document.getElementById(previewId);
    reader.onload = function () {
      imageField.src = reader.result;
      imageField.classList.remove('hidden');
    };
    reader.readAsDataURL(event.target.files[0]);
  }

 





</script>
@endpush
