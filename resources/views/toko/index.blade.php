@extends('layouts.fiks')

@push('styles')
<style>
  @keyframes slideIn {
    0%   { opacity: 0; transform: translateX(100%); }
    100% { opacity: 1; transform: translateX(0); }
  }

  @keyframes slideOut {
    0%   { opacity: 1; transform: translateX(0); }
    100% { opacity: 0; transform: translateX(100%); }
  }

  .animate-slide-in {
    animation: slideIn 0.5s ease-out forwards;
  }

  .animate-slide-out {
    animation: slideOut 0.5s ease-in forwards;
  }

  .animate-progress {
    animation: progressBar 4s linear forwards;
  }

  @keyframes progressBar {
    from { width: 100%; }
    to   { width: 0%; }
  }
</style>
@endpush

@section('content')
<x-alert />

<div class="p-6 bg-white rounded shadow ">
  <h1 class="mb-4 text-2xl font-bold">Manajemen Toko</h1>
  <x-breadcrumb :items="autoBreadcrumb()" />

  {{-- FILTER PENCARIAN --}}
   <form method="GET" action="{{ route('toko.index') }}" class="w-full max-w-md mx-auto mb-6">
      <div class="relative flex items-center">
         <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari toko..."
               class="w-full py-2 pl-4 pr-10 text-sm border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
         @if(request('search'))
         <button type="button" onclick="clearSearch()" class="absolute text-gray-400 right-20 hover:text-gray-600" title="Hapus pencarian">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
               d="M6 18L18 6M6 6l12 12" />
            </svg>
         </button>
         @endif
         <button
            type="submit"
            class="absolute right-2 bg-blue-600 text-white text-sm px-4 py-1.5 rounded-full hover:bg-blue-700 transition-all"
            >
            Cari
         </button>
      </div>
   </form>
  {{-- FORM TAMBAH TOKO --}}
   <form action="{{ route('toko.store') }}" method="POST" class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
      @csrf
      <div>
        <input type="text" name="nama" placeholder="Nama Toko" value="{{ old('nama') }}" class="w-full p-2 border rounded">
        @error('nama')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <input type="text" name="asal" placeholder="Asal" value="{{ old('asal') }}" class="w-full p-2 border rounded">
        @error('asal')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <input type="text" name="deskripsi" placeholder="Deskripsi" value="{{ old('deskripsi') }}" class="w-full p-2 border rounded">
        @error('deskripsi')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex justify-end md:col-span-3">
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
      </div>
   </form>
   <hr>
  {{-- DAFTAR TOKO --}}
<h2 class="mb-4 text-2xl font-semibold text-gray-800">Daftar Toko</h2>

@if($tokos->isEmpty())
  <div class="p-4 border-l-4 border-blue-500 rounded bg-blue-50">
    <div class="flex items-center">
      <i class="mr-3 text-blue-500 fas fa-info-circle"></i>
      <p class="text-sm text-blue-700">Data Toko Tidak Ada</p>
    </div>
  </div>
@else
  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full text-sm text-gray-700">
      <thead class="text-gray-700 bg-gray-100">
        <tr>
          <th class="p-3 text-center border">#</th>
          <th class="p-3 text-left border">Nama</th>
          <th class="p-3 text-left border">Asal</th>
          <th class="p-3 text-left border">Deskripsi</th>
          <th class="p-3 text-center border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tokos as $index => $toko)
          <tr class="hover:bg-gray-50">
            <td class="p-3 text-center border">{{ $tokos->firstItem() + $index }}</td>
            <td class="p-3 border">{{ $toko->nama }}</td>
            <td class="p-3 border">{{ $toko->asal }}</td>
            <td class="p-3 border">{{ $toko->deskripsi }}</td>
            <td class="p-3 text-center border">
              <div class="flex justify-center gap-3 text-gray-600">
                <button 
                  onclick="openModal({{ $toko }})" 
                  class="transition-colors hover:text-yellow-500"
                  title="Edit"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('toko.destroy', $toko->id) }}" method="POST" class="inline form-delete">
                  @csrf
                  @method('DELETE')
                  <button 
                    type="submit" 
                    class="transition-colors hover:text-red-500"
                    title="Hapus"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Pagination, stats, dll --}}
  <div class="flex flex-col items-center justify-between mt-4 text-sm text-gray-600 md:flex-row">
    <div class="mb-2 md:mb-0">
      Menampilkan <span class="font-medium">{{ $tokos->firstItem() }}</span>
      sampai <span class="font-medium">{{ $tokos->lastItem() }}</span>
      dari total <span class="font-semibold">{{ $tokos->total() }}</span> toko
    </div>
    <div>
      <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
        {{-- Previous --}}
              @if ($tokos->onFirstPage())
                  <span class="px-3 py-1 text-gray-500 bg-gray-200 border border-gray-300 rounded-l-md">←</span>
              @else
                  <a href="{{ $tokos->previousPageUrl() }}" class="px-3 py-1 text-blue-600 bg-white border border-gray-300 hover:bg-blue-100 rounded-l-md">←</a>
              @endif

              {{-- Page numbers --}}
              @foreach ($tokos->getUrlRange(1, $tokos->lastPage()) as $page => $url)
                  @if ($page == $tokos->currentPage())
                      <span class="px-3 py-1 text-white bg-blue-600 border border-gray-300">{{ $page }}</span>
                  @else
                      <a href="{{ $url }}" class="px-3 py-1 text-blue-600 bg-white border border-gray-300 hover:bg-blue-100">{{ $page }}</a>
                  @endif
              @endforeach

              {{-- Next --}}
              @if ($tokos->hasMorePages())
                  <a href="{{ $tokos->nextPageUrl() }}" class="px-3 py-1 text-blue-600 bg-white border border-gray-300 hover:bg-blue-100 rounded-r-md">→</a>
              @else
                  <span class="px-3 py-1 text-gray-500 bg-gray-200 border border-gray-300 rounded-r-md">→</span>
              @endif
      </nav>
    </div>
  </div>
@endif

</div>
{{-- MODAL --}}
<div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center invisible transition-opacity duration-300 bg-black bg-opacity-50 opacity-0">
   <div id="modalBox" class="w-full max-w-md p-6 transition duration-300 transform scale-95 translate-y-10 bg-white rounded">
      <h3 class="mb-4 text-lg font-semibold">Edit Toko</h3>
      <form id="editForm" method="POST">
        @csrf @method('PUT')
        <input type="text" name="nama" id="editNama" placeholder="Nama" class="w-full p-2 mb-3 border rounded" required>
        <input type="text" name="asal" id="editAsal" placeholder="Asal" class="w-full p-2 mb-3 border rounded" required>
        <input type="text" name="deskripsi" id="editDeskripsi" placeholder="Deskripsi" class="w-full p-2 mb-3 border rounded">
        <div class="flex justify-end space-x-2">
          <button type="button" onclick="closeModal()" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Batal</button>
          <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Update</button>
        </div>
      </form>
   </div>
</div>
@endsection

@push('scripts')
  <script>
   function clearSearch() {
    window.location.href = "{{ route('toko.index') }}";
   }

   const modal = document.getElementById('modalEdit');
   const modalBox = document.getElementById('modalBox');

   function openModal(toko) {
      document.getElementById('editNama').value = toko.nama;
      document.getElementById('editAsal').value = toko.asal;
      document.getElementById('editDeskripsi').value = toko.deskripsi;
      document.getElementById('editForm').action = `/toko/${toko.id}`;

      modal.classList.remove('invisible', 'opacity-0');
      modal.classList.add('opacity-100');

      modalBox.classList.remove('translate-y-10', 'scale-95');
      modalBox.classList.add('translate-y-0', 'scale-100');
   }
   function closeModal() {
      modal.classList.remove('opacity-100');
      modal.classList.add('opacity-0');

      modalBox.classList.remove('translate-y-0', 'scale-100');
      modalBox.classList.add('translate-y-10', 'scale-95');

      setTimeout(() => {
        modal.classList.add('invisible');
      }, 300);
   }
</script>
@endpush