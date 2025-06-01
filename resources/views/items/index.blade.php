@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold text-gray-700">Daftar Item</h2>
    <button onclick="openDrawer()" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
        <i class="mr-2 fas fa-plus"></i>Tambah Item
    </button>
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
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc']) }}">
                Nama {!! ($sort === 'nama' ? ($direction === 'asc' ? '↑' : '↓') : '') !!}
            </a>
        </th>

        <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'harga', 'direction' => ($sort === 'harga' && $direction === 'asc') ? 'desc' : 'asc']) }}">
                Harga {!! ($sort === 'harga' ? ($direction === 'asc' ? '↑' : '↓') : '') !!}
            </a>
        </th>

        <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'ongkir', 'direction' => ($sort === 'ongkir' && $direction === 'asc') ? 'desc' : 'asc']) }}">
                Ongkir {!! ($sort === 'ongkir' ? ($direction === 'asc' ? '↑' : '↓') : '') !!}
            </a>
        </th>

        <th class="px-4 py-2 font-semibold text-left text-gray-600">Total</th>

        <th class="px-4 py-2 font-semibold text-left text-gray-600">Kategori</th>
        <th class="px-4 py-2 font-semibold text-left text-gray-600">Brand</th>
        <th class="px-4 py-2 font-semibold text-left text-gray-600">Toko</th>

        <th class="px-4 py-2 font-semibold text-left text-gray-600 cursor-pointer">
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'tanggal', 'direction' => ($sort === 'tanggal' && $direction === 'asc') ? 'desc' : 'asc']) }}">
                Tanggal {!! ($sort === 'tanggal' ? ($direction === 'asc' ? '↑' : '↓') : '') !!}
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
                    <button onclick="openModal('view-{{ $item->id }}')" class="text-blue-500 hover:underline"><i class="fas fa-eye"></i></button>
                    <button onclick="openModal('edit-{{ $item->id }}')" class="text-yellow-500 hover:underline"><i class="fas fa-edit"></i></button>
                    <form method="POST" action="{{ route('items.destroy', $item->id) }}" class="inline form-delete" data-jenis="item">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>

            @include('items.partials.modal-view', ['item' => $item])
            @include('items.partials.modal-edit', ['item' => $item])
            @empty
            <tr>
                <td colspan="10" class="px-4 py-6 italic text-center text-gray-500">Data item tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="flex items-center justify-between mt-4 text-sm text-gray-600">
    <div>
        Menampilkan {{ $items->firstItem() }} sampai {{ $items->lastItem() }} dari total {{ $items->total() }} item
    </div>
    <div>
        {{ $items->links() }}
    </div>
</div>


@include('items.partials.drawer-create')
@endsection
