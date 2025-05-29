@extends('layouts.app')

@push('styles')
<style>
   @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
   }

   .fade-in {
      animation: fadeIn 0.5s ease forwards;
   }

   .image-preview-container {
      display: none;
      position: relative;
      height: 160px;
   }

   .remove-image-btn {
      position: absolute;
      top: 5px;
      right: 5px;
      background: rgba(0,0,0,0.5);
      color: white;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
   }
</style>
@endpush

@section('content')
<x-alert />
<x-breadcrumb :items="autoBreadcrumb()" />

<h1 class="mb-4 text-2xl font-bold">Brand List</h1>
{{-- Form Tambah Brand --}}
<div class="relative p-6 mb-6 bg-white rounded-lg shadow fade-in" id="form-produk-wrapper">
   <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold">Tambah Brand</h3>
      <button id="toggleFormBtn" type="button" class="text-indigo-600 hover:text-indigo-800 focus:outline-none" aria-label="Toggle form">
         <i class="fas fa-chevron-up" id="toggleIcon"></i>
      </button>
   </div>
   <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" id="formProduk">
      @csrf
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
         <div>
            <div class="mb-4">
               <label class="block mb-2 text-sm font-medium text-gray-700">Nama Brand <span class="text-red-500">*</span></label>
               <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama brand" required>
               @error('name')
               <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
               @enderror
            </div>
            <div class="flex gap-2">
               <button type="button" onclick="toggleForm()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                  Batal
               </button>
               <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                  Simpan Brand
               </button>
            </div>
         </div>
         <div>
            <div class="mb-4">
               <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Brand</label>
               <div class="grid grid-cols-2 gap-4">
                  <div class="image-preview-container" id="imagePreviewContainer">
                     <img id="imagePreview" class="object-contain w-full h-full border border-gray-200 rounded-lg" src="#" alt="Preview Gambar">
                     <div class="remove-image-btn" id="removeImageBtn">
                        <i class="text-xs fas fa-times"></i>
                     </div>
                  </div>
                  <div class="flex items-center justify-center">
                     <label class="flex flex-col w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                        <div class="flex flex-col items-center justify-center pt-7">
                           <i class="text-3xl text-gray-400 fas fa-cloud-upload-alt"></i>
                           <p class="pt-1 text-sm text-gray-500">Upload Brand</p>
                        </div>
                        <input class="opacity-0" type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                     </label>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>

{{-- Form Search --}}
<form action="{{ route('brands.index') }}" method="GET" class="relative w-1/3 mb-4">
   <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama brand..." class="w-full px-3 py-2 pr-10 border rounded">
   @if(request('search'))
   <a href="{{ route('brands.index') }}" class="absolute text-xl font-bold leading-none text-gray-400 transform -translate-y-1/2 right-2 top-1/2 hover:text-red-500">&times;</a>
   @endif
   <button type="submit" class="absolute right-[-90px] top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded">
      Cari
   </button>
</form>

@if(request('search'))
<p class="mb-2 text-sm text-gray-600">Menampilkan hasil untuk: <strong>{{ request('search') }}</strong></p>
@endif

{{-- List Brand --}}
<div id="sliderAuto" class="flex pb-4 space-x-4 overflow-x-auto scroll-smooth hide-scrollbar">
   @forelse ($brands as $brand)
   <div class="w-[200px] h-[260px] bg-white rounded-xl shadow-md p-4 flex-shrink-0 flex flex-col justify-between hover:shadow-xl transition duration-300 text-center">
      <div class="h-[140px] flex items-center justify-center mb-3">
         @if ($brand->image)
         <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="object-contain h-full" />
         @else
         <div class="flex items-center justify-center w-full h-full text-xs text-gray-400 border-2 border-gray-300 border-dashed">
            Tidak ada gambar
         </div>
         @endif
      </div>
      <h3 class="mb-1 text-base font-semibold text-gray-800 truncate">{{ $brand->name }}</h3>
      <div class="flex justify-center gap-1 mt-auto">
         <button class="flex items-center justify-center p-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600" onclick="openModal('{{ $brand->id }}')">
            <i class="fas fa-pen"></i>
         </button>
         <form action="{{ route('brands.destroy', $brand) }}" method="POST" data-jenis="Brand" class="form-delete">
            @csrf @method('DELETE')
            <button type="submit" class="flex items-center justify-center p-2 text-sm text-white bg-red-500 rounded hover:bg-red-600">
               <i class="fas fa-trash"></i>
            </button>
         </form>
      </div>

      {{-- Modal Edit Brand --}}
      <div id="modal-{{ $brand->id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 opacity-0 pointer-events-none" role="dialog" aria-modal="true">
         <div class="relative w-full max-w-md p-6 transition-all duration-300 transform scale-95 bg-white rounded-lg shadow-lg" id="modal-content-{{ $brand->id }}">
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
                  <button type="button" onclick="closeModal('{{ $brand->id }}')" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                  <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Simpan</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   @empty
   <div class="flex items-center justify-center w-full h-48 p-4 py-10 mb-6 text-center text-gray-500 bg-white rounded shadow">
      <p class="text-lg font-semibold">Data tidak ditemukan.</p>
   </div>
   @endforelse
</div>
@endsection

@push('scripts')
<script>
   const toggleBtn = document.getElementById('toggleFormBtn');
   const form = document.getElementById('formProduk');
   const toggleIcon = document.getElementById('toggleIcon');

   toggleBtn.addEventListener('click', toggleForm);

   function toggleForm() {
      if (form.style.display === 'none') {
         form.style.display = 'block';
         toggleIcon.classList.replace('fa-chevron-down', 'fa-chevron-up');
      } else {
         form.style.display = 'none';
         toggleIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
      }
   }

   const imageInput = document.getElementById('image');
   const imagePreview = document.getElementById('imagePreview');
   const imagePreviewContainer = document.getElementById('imagePreviewContainer');
   const removeImageBtn = document.getElementById('removeImageBtn');

   imageInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
         const reader = new FileReader();
         reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreviewContainer.style.display = 'block';
         }
         reader.readAsDataURL(file);
      }
   });

   removeImageBtn.addEventListener('click', function() {
      imagePreview.src = '#';
      imagePreviewContainer.style.display = 'none';
      imageInput.value = '';
   });

   function openModal(id) {
      const modal = document.getElementById(`modal-${id}`);
      const content = document.getElementById(`modal-content-${id}`);
      modal.classList.remove('opacity-0', 'pointer-events-none', 'hidden');
      content.classList.replace('scale-95', 'scale-100');
   }

   function closeModal(id) {
      const modal = document.getElementById(`modal-${id}`);
      const content = document.getElementById(`modal-content-${id}`);
      content.classList.replace('scale-100', 'scale-95');
      modal.classList.add('opacity-0', 'pointer-events-none', 'hidden');
   }

   const sliderAuto = document.getElementById('sliderAuto');
   setInterval(() => {
      if (sliderAuto.scrollWidth > sliderAuto.clientWidth) {
         sliderAuto.scrollBy({ left: 220, behavior: 'smooth' });
         if (sliderAuto.scrollLeft + sliderAuto.clientWidth >= sliderAuto.scrollWidth) {
            sliderAuto.scrollTo({ left: 0, behavior: 'smooth' });
         }
      }
   }, 3000);
</script>
@endpush
