@extends('layouts.app')

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

<div class=" bg-white p-6 rounded shadow">
  <h1 class="text-2xl font-bold mb-4">Manajemen Toko</h1>
  {{-- FILTER PENCARIAN --}}
   <form method="GET" action="{{ route('toko.index') }}" class="mb-6 w-full max-w-md mx-auto">
      <div class="relative flex items-center">
         <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari toko..."
               class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-full py-2 pl-4 pr-10 text-sm shadow-sm">
         @if(request('search'))
         <button type="button" onclick="clearSearch()" class="absolute right-20 text-gray-400 hover:text-gray-600" title="Hapus pencarian">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
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
   <form action="{{ route('toko.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      @csrf
      <div>
        <input type="text" name="nama" placeholder="Nama Toko" value="{{ old('nama') }}" class="border p-2 rounded w-full">
        @error('nama')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <input type="text" name="asal" placeholder="Asal" value="{{ old('asal') }}" class="border p-2 rounded w-full">
        @error('asal')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <input type="text" name="deskripsi" placeholder="Deskripsi" value="{{ old('deskripsi') }}" class="border p-2 rounded w-full">
        @error('deskripsi')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="md:col-span-3 flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
      </div>
   </form>
   <hr>
  {{-- DAFTAR TOKO --}}
<h2 class="text-2xl font-semibold mb-4 text-gray-800">Daftar Toko</h2>

@if($tokos->isEmpty())
  <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
    <div class="flex items-center">
      <i class="fas fa-info-circle text-blue-500 mr-3"></i>
      <p class="text-sm text-blue-700">Data Toko Tidak Ada</p>
    </div>
  </div>
@else
  <div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="min-w-full text-sm text-gray-700">
      <thead class="bg-gray-100 text-gray-700">
        <tr>
          <th class="p-3 border text-center">#</th>
          <th class="p-3 border text-left">Nama</th>
          <th class="p-3 border text-left">Asal</th>
          <th class="p-3 border text-left">Deskripsi</th>
          <th class="p-3 border text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tokos as $index => $toko)
          <tr class="hover:bg-gray-50">
            <td class="p-3 border text-center">{{ $tokos->firstItem() + $index }}</td>
            <td class="p-3 border">{{ $toko->nama }}</td>
            <td class="p-3 border">{{ $toko->asal }}</td>
            <td class="p-3 border">{{ $toko->deskripsi }}</td>
            <td class="p-3 border text-center">
              <div class="flex justify-center gap-3 text-gray-600">
                <button 
                  onclick="openModal({{ $toko }})" 
                  class="hover:text-yellow-500 transition-colors"
                  title="Edit"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('toko.destroy', $toko->id) }}" method="POST" class="inline form-delete">
                  @csrf
                  @method('DELETE')
                  <button 
                    type="submit" 
                    class="hover:text-red-500 transition-colors"
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
  <div class="flex flex-col md:flex-row justify-between items-center mt-4 text-sm text-gray-600">
    <div class="mb-2 md:mb-0">
      Menampilkan <span class="font-medium">{{ $tokos->firstItem() }}</span>
      sampai <span class="font-medium">{{ $tokos->lastItem() }}</span>
      dari total <span class="font-semibold">{{ $tokos->total() }}</span> toko
    </div>
    <div>
      <nav class="inline-flex shadow-sm rounded-md" aria-label="Pagination">
        {{-- Previous --}}
              @if ($tokos->onFirstPage())
                  <span class="px-3 py-1 border border-gray-300 bg-gray-200 text-gray-500 rounded-l-md">←</span>
              @else
                  <a href="{{ $tokos->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 rounded-l-md">←</a>
              @endif

              {{-- Page numbers --}}
              @foreach ($tokos->getUrlRange(1, $tokos->lastPage()) as $page => $url)
                  @if ($page == $tokos->currentPage())
                      <span class="px-3 py-1 border border-gray-300 bg-blue-600 text-white">{{ $page }}</span>
                  @else
                      <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600">{{ $page }}</a>
                  @endif
              @endforeach

              {{-- Next --}}
              @if ($tokos->hasMorePages())
                  <a href="{{ $tokos->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 rounded-r-md">→</a>
              @else
                  <span class="px-3 py-1 border border-gray-300 bg-gray-200 text-gray-500 rounded-r-md">→</span>
              @endif
      </nav>
    </div>
  </div>
@endif

</div>
{{-- MODAL --}}
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center invisible opacity-0 transition-opacity duration-300 z-50">
   <div id="modalBox" class="bg-white p-6 rounded w-full max-w-md transform scale-95 translate-y-10 transition duration-300">
      <h3 class="text-lg font-semibold mb-4">Edit Toko</h3>
      <form id="editForm" method="POST">
        @csrf @method('PUT')
        <input type="text" name="nama" id="editNama" placeholder="Nama" class="border p-2 rounded w-full mb-3" required>
        <input type="text" name="asal" id="editAsal" placeholder="Asal" class="border p-2 rounded w-full mb-3" required>
        <input type="text" name="deskripsi" id="editDeskripsi" placeholder="Deskripsi" class="border p-2 rounded w-full mb-3">
        <div class="flex justify-end space-x-2">
          <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
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