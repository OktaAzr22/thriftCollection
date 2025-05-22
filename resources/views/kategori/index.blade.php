@extends('layouts.app')
@section('title', 'Halaman Brand')
@push('styles')
<style>
      /* Animasi dropdown form */
      #formContainer {
         max-height: 0;
         opacity: 0;
         transform: translateY(-10px);
         overflow: hidden;
         transition:
         max-height 0.4s ease,
         opacity 0.3s ease 0.1s,
         transform 0.3s ease 0.1s;
      }
      #formContainer.show {
         max-height: 1000px; /* cukup besar untuk isi form */
         opacity: 1;
         transform: translateY(0);
      }
</style>
@endpush
@section('content')

   <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Data</h1>
   <nav class="flex px-5 py-3 text-gray-700 bg-white rounded-lg shadow" aria-label="Breadcrumb">
   <ol class="inline-flex items-center space-x-1 md:space-x-3">
      <li class="inline-flex items-center">
         <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
         <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" >
            <path d="M10 20v-6h4v6h5v-8h3L10 0 0 12h3v8z"/>
         </svg>
         Dashboard
         </a>
      </li>
      <li>
         <div class="flex items-center">
         <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" 
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
         </svg>
         <a href="#" class="ml-1 text-sm font-medium text-gray-500 hover:text-gray-700 md:ml-2">Kategori</a>
         </div>
      </li>
      <li aria-current="page">
         <div class="flex items-center">
         <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" 
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
         </svg>
         <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Tambah Kategori</span>
         </div>
      </li>
   </ol>
   </nav>

    <!-- Tombol toggle form -->
    <button id="toggleFormBtn" 
      class="mb-6 px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
      Tambah Data Baru
    </button>

    <!-- Form Tambah Data (hidden by default) -->
    <div id="formContainer" class="bg-white rounded-lg shadow-md p-6 mb-8">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Data Baru</h2>
      <form id="dataForm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input
              type="text"
              id="nama"
              name="nama"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>
          <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
            <input
              type="tel"
              id="telepon"
              name="telepon"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>
          <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select
              id="status"
              name="status"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
              <option value="">Pilih Status</option>
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
        </div>
        <div class="mt-6">
          <button
            type="submit"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          >
            Simpan Data
          </button>
          <button
            type="reset"
            class="ml-3 px-6 py-2 bg-gray-200 text-gray-800 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
          >
            Reset
          </button>
        </div>
      </form>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div
        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center"
      >
        <h2 class="text-xl font-semibold text-gray-700">Daftar Data</h2>
        <div class="relative">
          <input
            type="text"
            id="searchInput"
            placeholder="Cari..."
            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <svg
            class="absolute left-3 top-2.5 h-5 w-5 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            ></path>
          </svg>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="dataTable">
          <thead class="bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                No
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Nama
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Email
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Telepon
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Status
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
            <tr>
              <td
                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                >1</td
              >
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">John Doe</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                john@example.com
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                08123456789
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  >Aktif</span
                >
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
              </td>
            </tr>
            <tr>
              <td
                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                >2</td
              >
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">Jane Smith</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                jane@example.com
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                08234567890
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                  >Nonaktif</span
                >
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
              </td>
            </tr>
            <tr>
              <td
                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                >3</td
              >
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">Robert Johnson</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                robert@example.com
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                08345678901
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  >Aktif</span
                >
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div
        class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"
      >
        <div class="text-sm text-gray-500">
          Menampilkan <span class="font-medium">1</span> sampai
          <span class="font-medium">3</span> dari <span class="font-medium"
            >3</span
          >
          data
        </div>
        <div class="flex space-x-2">
          <button
            class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
          >
            Sebelumnya
          </button>
          <button
            class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
          >
            Selanjutnya
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
    // Toggle form dropdown
    const toggleBtn = document.getElementById('toggleFormBtn');
    const formContainer = document.getElementById('formContainer');

    toggleBtn.addEventListener('click', () => {
      formContainer.classList.toggle('show');
      if (formContainer.classList.contains('show')) {
        toggleBtn.textContent = 'Tutup Form';
      } else {
        toggleBtn.textContent = 'Tambah Data Baru';
      }
    });

    // Cari/filter tabel sederhana
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');

    searchInput.addEventListener('input', () => {
      const filter = searchInput.value.toLowerCase();
      const rows = tableBody.querySelectorAll('tr');

      rows.forEach((row) => {
        const cellsText = row.textContent.toLowerCase();
        row.style.display = cellsText.includes(filter) ? '' : 'none';
      });
    });

    // Optional: bisa tambahkan event form submit untuk simpan data baru ke tabel (kalau mau)
  </script>
@endpush