@extends('layouts.app')

@section('content')
    {{-- sec 1 --}}
    <div class="p-6 mb-6 bg-white rounded-lg shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Tambah Brand</h2>
            <button id="toggleFormBtn" onclick="toggleForm()"
                    aria-expanded="false" aria-controls="formContent">
                <i id="toggleIcon" class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div id="formContent"
             class="overflow-hidden transition-all duration-300 ease-in-out"
             style="height: 0px;">
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700" for="name">Nama Brand<span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400" placeholder="Masukkan Brand name"/>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Gambar Brand</label>
                    <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-gray-500 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                </div>           
                <div class="md:col-span-2">
                    <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- sec 2 --}}
    <div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">List Brand</h2>
            <form action="{{ route('brands.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama brand..."
                       class="w-64 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring focus:ring-blue-400" />
                @if(request('search'))
                    <a href="{{ route('brands.index') }}"
                       class="absolute text-xl text-gray-400 -translate-y-1/2 right-3 top-1/2 hover:text-red-500">&times;</a>
                @endif
            </form>
        </div>
        <div class="overflow-auto border border-gray-200 rounded-lg">
            <table class="min-w-full text-sm bg-white">
                <thead class="sticky top-0 z-10 text-xs text-left text-gray-500 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                  @foreach ($brands as $index => $brand)
                    <tr class="transition hover:bg-gray-50">
                        <td class="px-4 py-4 text-sm text-gray-700">{{ $brands->firstItem() + $index }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center space-x-4">
                                <img class="object-cover w-10 h-10 rounded-full" src="{{ $brand->image_url }}" alt="{{ $brand->name }}">
                                <p class="text-sm font-medium text-gray-900">{{ $brand->name }}</p>
                            </div>
                        </td>
                        <td class="flex px-4 py-4 space-x-2">
                            <button onclick="openModal('{{ $brand->id }}')" class="text-yellow-500 transition hover:text-yellow-700" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="form-delete" data-jenis="Brand">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-yellow-800 transition hover:text-yellow-500" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        {{-- Modal Edit --}}
        @foreach ($brands as $brand)
        <div id="modal-{{ $brand->id }}" role="dialog" aria-modal="true"
               class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 pointer-events-none">
         <div class="relative w-full max-w-md p-6 transition-transform duration-300 transform scale-95 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold">Edit Brand</h2>
            <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
               @csrf @method('PUT')
               <div class="mb-4">
                  <label class="block text-sm font-medium">Nama Brand</label>
                  <input type="text" name="name" value="{{ $brand->name }}" class="block w-full px-3 py-2 mt-1 border rounded" required>
               </div>
               <div class="mb-4">
                  <label class="block text-sm font-medium">Gambar Baru (opsional)</label>
                  <input type="file" name="image" accept="image/*" class="block w-full mt-1">
               </div>
               @if($brand->image)
               <div class="mb-4">
                  <span class="text-sm text-gray-600">Gambar Saat Ini:</span><br>
                  <img src="{{ asset('storage/'.$brand->image) }}" class="h-12 mt-1">
               </div>
               @endif
               <div class="flex justify-end gap-2">
                  <button type="button" onclick="closeModal('{{ $brand->id }}')"class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                  <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Simpan</button>
               </div>
            </form>
         </div>
        </div>
        @endforeach
        {{-- Pagination --}}
        <div class="flex flex-col items-center justify-between mt-6 space-y-4 sm:flex-row sm:space-y-0">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">{{ $brands->firstItem() }}</span> -
                <span class="font-semibold">{{ $brands->lastItem() }}</span> dari
                <span class="font-semibold">{{ $brands->total() }}</span> Brand
            </div>
            <div class="text-sm">
                {{ $brands->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
   function openModal(id) {
      const modal = document.getElementById(`modal-${id}`);
      modal.classList.remove('hidden', 'pointer-events-none');
      setTimeout(() => {
         modal.classList.remove('opacity-0');
         modal.classList.add('opacity-100');
         modal.firstElementChild.classList.remove('scale-95');
         modal.firstElementChild.classList.add('scale-100');
      }, 10);
   }

   function closeModal(id) {
      const modal = document.getElementById(`modal-${id}`);

      modal.classList.remove('opacity-100');
      modal.classList.add('opacity-0');
      modal.firstElementChild.classList.remove('scale-100');
      modal.firstElementChild.classList.add('scale-95');

      setTimeout(() => {
         modal.classList.add('hidden', 'pointer-events-none');
      }, 300);
   }

   document.addEventListener('click', function(e) {
      document.querySelectorAll('[id^="modal-"]').forEach(modal => {
         if (!modal.classList.contains('hidden') && e.target === modal) {
            closeModal(modal.id.replace('modal-', ''));
         }
      });
   });

</script>
@endpush
