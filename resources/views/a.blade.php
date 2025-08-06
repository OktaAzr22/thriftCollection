@extends('layouts.app')

@section('content')
    <div class="overflow-x-auto">
  <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
    <thead class="text-xs text-gray-600 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-4 py-3">Gambar</th>
        <th scope="col" class="px-4 py-3">Brand</th>
        <th scope="col" class="px-4 py-3">Item</th>
        <th scope="col" class="px-4 py-3 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-900">
      <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-800">
        <td class="px-4 py-3">
          <img src="{{ asset('images/PoloPlayer.png') }}" alt="Item Image" class="object-cover w-12 h-12 rounded">

        </td>
        <td class="px-4 py-3 font-semibold">Nike</td>
        <td class="px-4 py-3">
          <span class="inline-block px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">Air Max 90</span>
        </td>
        <td class="px-4 py-3 space-x-2 text-center">
          <button title="Lihat" class="text-green-600 hover:text-green-800">
            <i class="fas fa-eye"></i>
          </button>
          <button title="Edit" class="text-yellow-500 hover:text-yellow-700">
            <i class="fas fa-edit"></i>
          </button>
          <button title="Hapus" class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>
      <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-800">
        <td class="px-4 py-3">
          <img src="{{ asset('images/default-brand.png') }}" alt="Item Image" class="object-cover w-12 h-12 rounded">

        </td>
        <td class="px-4 py-3 font-semibold">Nike</td>
        <td class="px-4 py-3">
          <span class="inline-block px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">Air Max 90</span>
        </td>
        <td class="px-4 py-3 space-x-2 text-center">
          <button title="Lihat" class="text-green-600 hover:text-green-800">
            <i class="fas fa-eye"></i>
          </button>
          <button title="Edit" class="text-yellow-500 hover:text-yellow-700">
            <i class="fas fa-edit"></i>
          </button>
          <button title="Hapus" class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>
      <!-- Tambahkan baris lain di sini -->
    </tbody>
  </table>
</div>

@endsection