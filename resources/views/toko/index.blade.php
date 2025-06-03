



@extends('layouts.app')

@section('content')
<x-alert />

<!-- Global Error Display -->


<!-- Form Tambah Toko -->
<div class="p-6 mb-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold">Tambah Toko</h2>
        <button id="toggleFormBtn" onclick="toggleForm()" aria-expanded="false" aria-controls="formContent">
            <i id="toggleIcon" class="fas fa-chevron-down"></i>
        </button>
    </div>
    <div id="formContent" class="overflow-hidden transition-all duration-300 ease-in-out" style="height: 0px;">
        <form action="{{ route('toko.store') }}" method="POST" class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @csrf
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Toko <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                @error('nama')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Asal <span class="text-red-500">*</span></label>
                <input type="text" name="asal" value="{{ old('asal') }}" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                @error('asal')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Submit</button>
            </div>
        </form>
    </div>
</div>


<!-- List Toko -->
<div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
    <div class="flex flex-col items-start justify-between gap-4 mb-4 sm:flex-row sm:items-center">
        <h2 class="text-xl font-semibold text-gray-800">List Toko</h2>
        <form method="GET" action="{{ route('toko.index') }}">
            <div class="relative">
                <input type="text" 
                        name="search" 
                        value="{{ old('search', $search) }}"
                        placeholder="Cari nama toko..." class="px-4 py-2 text-sm border border-gray-300 rounded-lg sm:w-64">
                @if(request('search'))
                <button type="button" onclick="clearSearch()" class="absolute text-gray-400 right-2 top-2 hover:text-gray-600" title="Hapus pencarian">
                    ✕
                </button>
                @endif
            </div>
        </form>
    </div>
    @if(request('search'))
    <div class="mb-4 text-sm text-gray-700">
        Hasil pencarian untuk: <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>
    </div>
    @endif

    @if($tokos->isEmpty())
    <div class="p-4 border-l-4 border-blue-500 rounded bg-blue-50">
        <div class="flex items-center">
            <i class="mr-3 text-blue-500 fas fa-info-circle"></i>
            <p class="text-sm text-blue-700">Data Toko Tidak Ada</p>
        </div>
    </div>
    @else
    <div class="overflow-auto border border-gray-200 rounded-lg max-h-[400px] scroll-hidden">
    <table class="min-w-full text-sm bg-white divide-y divide-gray-200">
             <thead class="sticky top-0 z-10 text-xs text-left text-gray-500 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3 font-medium bg-gray-100">Nama</th>
                <th class="px-6 py-3 font-medium bg-gray-100">Asal</th>
                <th class="px-6 py-3 font-medium bg-gray-100">Deskripsi</th>
                <th class="px-6 py-3 font-medium bg-gray-100">Ongkir</th>
                <th class="px-6 py-3 font-medium text-right bg-gray-100">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @foreach ($tokos as $toko)
                <tr class="transition hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $toko->nama }}</td>
                    <td class="px-6 py-4">{{ $toko->asal ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $toko->deskripsi ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if ($toko->items_max_ongkir !== null)
                             Rp {{ number_format($toko->items_max_ongkir, 0, ',', '.') }}
                        @else
                            Belum ada data ongkir
                        @endif
                    </td>

                    <td class="px-6 py-4 space-x-2 text-right">
                        <button onclick="openModal('{{ $toko->id }}')" class="px-3 py-1 text-yellow-600 border rounded hover:bg-yellow-50">Edit</button>
                        <form action="{{ route('toko.destroy', $toko->id) }}" method="POST" class="inline form-delete">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-red-600 border rounded hover:bg-red-50">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
<div id="modal-{{ $toko->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 pointer-events-none">
  <div class="relative w-full max-w-md p-6 transition-transform duration-300 transform scale-95 bg-white rounded-lg">
    <button onclick="closeModal('{{ $toko->id }}')" class="absolute text-gray-400 top-4 right-4 hover:text-gray-600">✕</button>
    <h2 class="mb-4 text-xl font-bold text-gray-800">Edit Toko</h2>
    <form action="{{ route('toko.update', $toko) }}" method="POST">
      @csrf @method('PUT')

      <!-- Grid 2 kolom untuk Nama & Asal -->
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
          <input type="text" name="nama" value="{{ $toko->nama }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Asal</label>
          <input type="text" name="asal" value="{{ $toko->asal }}" class="w-full px-3 py-2 border rounded">
        </div>
      </div>

      <!-- Deskripsi tetap satu baris penuh -->
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="deskripsi" class="w-full px-3 py-2 border rounded">{{ $toko->deskripsi }}</textarea>
      </div>

      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('{{ $toko->id }}')" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Batal</button>
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>
</div>

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($tokos->hasPages())
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-600">
            Menampilkan {{ $tokos->firstItem() }} - {{ $tokos->lastItem() }} dari {{ $tokos->total() }} Toko
        </div>
        <div>
            {{ $tokos->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
    @endif
</div>
@endsection

@push('scripts')
<script>
function clearSearch() {
    const url = new URL(window.location.href);
    url.searchParams.delete('search');
    window.location.href = url.toString();
}

// Buka form jika ada error validasi
document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('formContent');
    const icon = document.getElementById('toggleIcon');

    @if ($errors->any())
        content.style.height = content.scrollHeight + "px";
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    @endif
});


</script>
@endpush
