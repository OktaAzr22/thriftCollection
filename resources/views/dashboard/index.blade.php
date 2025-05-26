@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <!-- Section 1: Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white p-4 rounded-lg shadow">
      <h3 class="text-sm text-gray-500">Total Item</h3>
      <p class="text-xl font-semibold">{{ $totalItems }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <h3 class="text-sm text-gray-500">Total Ongkir</h3>
      <p class="text-xl font-semibold">{{ $totalShipping }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <h3 class="text-sm text-gray-500">Total Brand</h3>
      <p class="text-xl font-semibold">{{ $totalBrands }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <h3 class="text-sm text-gray-500">Total Pengeluaran</h3>
      <p class="text-xl font-semibold">{{ formatCurrency($totalExpenses) }}</p>
    </div>
  </div>
  
  <!-- Section 2: Form -->
  <div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold">Input Form</h2>
      <button id="toggleFormBtn" onclick="toggleForm()" aria-expanded="false" aria-controls="formContent">
        <i id="toggleIcon" class="fas fa-chevron-down"></i>
      </button>
    </div>
    <div id="formContent" class="overflow-hidden transition-all duration-300 ease-in-out" style="height: 0px;">
      <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="POST" action="">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Name</label>
          <input id="name" name="name" type="text" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400" placeholder="Enter name" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
          <input id="email" name="email" type="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400" placeholder="Enter email" required />
        </div>
        <div class="md:col-span-2">
          <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Section 3: Table -->
  <div class="bg-white p-4 rounded-lg shadow flex flex-col flex-1 overflow-hidden">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Daftar Pengguna</h2>
      <div class="relative flex items-center gap-2">
        <input type="text" placeholder="Cari nama atau email..." class="border border-gray-300 rounded-lg px-3 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
        <button id="optionsToggle" class="w-10 h-10 flex items-center justify-center rounded-md hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition">
          <i class="fas fa-ellipsis-v"></i>
        </button>
        
        <div id="optionsMenu" class="hidden absolute right-0 top-12 w-32 bg-white border border-gray-200 rounded shadow text-sm z-50">
          <button onclick="setAction('edit', 1)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-700">Edit</button>
          <button onclick="setAction('delete', 1)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-700">Hapus</button>
        </div>
      </div>
    </div>
    
    <div class="overflow-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-left text-xs uppercase text-gray-500 sticky top-0 z-10">
          <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($users as $user)
            <tr>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
              <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                  <img class="w-10 h-10 rounded-full object-cover" src="{{ $user->avatar_url }}" alt="Avatar">
                  <div>
                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($user->role) }}</td>
              <td class="px-6 py-4">
                <button id="actionBtn" onclick="goToAction({{ $user->id }})" class="text-blue-600 hover:text-blue-800 text-lg transition">
                  <i id="actionIcon" class="fas fa-eye"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
      <div>Showing <span class="font-medium">{{ $users->firstItem() }}</span> to <span class="font-medium">{{ $users->lastItem() }}</span> of <span class="font-medium">{{ $users->total() }}</span> results</div>
      <div class="space-x-1">
        @if($users->previousPageUrl())
          <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Prev</a>
        @endif
        
        @foreach(range(1, $users->lastPage()) as $page)
          <a href="{{ $users->url($page) }}" class="px-3 py-1 {{ $users->currentPage() == $page ? 'bg-blue-600 text-white' : 'bg-gray-200' }} rounded hover:bg-gray-300">{{ $page }}</a>
        @endforeach
        
        @if($users->nextPageUrl())
          <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next</a>
        @endif
      </div>
    </div>
  </div>
  
  @push('modals')
    <!-- Modal Overlay -->
    <div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 opacity-0 pointer-events-none transition-opacity duration-300">
      <!-- Modal Content -->
      <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg transform scale-95 transition-transform duration-300">
        <h2 class="text-lg font-semibold mb-4">Tambah Data</h2>
        
        <form onsubmit="event.preventDefault(); closeModal(); alert('Data disimpan!');">
          <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400" required />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"></textarea>
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
          </div>
        </form>
      </div>
    </div>
    
    <!-- Drawer Overlay -->
    <div id="drawer" class="fixed inset-0 z-50 bg-black bg-opacity-40 flex justify-end pr-6 pointer-events-none opacity-0 transition-opacity duration-300">
      <!-- Drawer Content -->
      <div class="bg-white w-full max-w-md h-[90vh] my-auto rounded-lg shadow-2xl transform translate-x-full transition-transform duration-300 flex flex-col">
        <!-- Sticky Header -->
        <div class="p-4 border-b sticky top-0 bg-white z-10 flex justify-between items-center rounded-t-lg">
          <h2 class="text-lg font-semibold">Tambah Data</h2>
          <button onclick="closeDrawer()" class="text-gray-600 hover:text-black">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
          <div>
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" required />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Keterangan</label>
            <textarea rows="4" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
          </div>

          <!-- Simulasi isi panjang -->
          <div class="space-y-3">
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Input tambahan..." />
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Input tambahan..." />
          </div>
        </div>

        <!-- Sticky Footer -->
        <div class="p-4 border-t sticky bottom-0 bg-white z-10 rounded-b-lg">
          <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
              Simpan
            </button>
          </div>
        </div>
      </div>
    </div>
  @endpush
@endsection

@push('scripts')
  <script>
    // Pastikan form tertutup saat pertama kali dimuat
    document.addEventListener("DOMContentLoaded", function() {
      const formContent = document.getElementById("formContent");
      formContent.style.height = "0px";
    });
  </script>
@endpush