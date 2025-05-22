@extends('layouts.app')
@section('title', 'Halaman Brand')
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

<div class="flex flex-col flex-1 overflow-hidden">
       
         <div class="flex-1 overflow-auto p-6">
            <div class="bg-white rounded-lg shadow fade-in  p-6 mb-6 relative" id="form-produk-wrapper">
               <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg font-semibold">Informasi Produk</h3>
                  <button id="toggleFormBtn" type="button" class="text-indigo-600 hover:text-indigo-800 focus:outline-none" aria-label="Toggle form">
                     <i class="fas fa-chevron-up" id="toggleIcon"></i>
                  </button>
               </div>
               <form id="formProduk">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                     <div>
                        <div class="mb-4">
                           <label class="block text-gray-700 text-sm font-medium mb-2" for="nama-produk">
                              Nama Produk <span class="text-red-500">*</span>
                           </label>
                           <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"  id="nama-produk" type="text" placeholder="Masukkan nama produk" required>
                        </div> <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Batal
                     </button>
                     <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Simpan Produk
                     </button>
                     </div>
                     <div>
                        <div class="mb-4">
                           <label class="block text-gray-700 text-sm font-medium mb-2" for="gambar">
                              Gambar Produk
                           </label>
                           <div class="grid grid-cols-2 gap-4">
                              <!-- Kolom Preview Gambar -->
                              <div class="image-preview-container" id="imagePreviewContainer">
                                 <img id="imagePreview" class="w-full h-full object-contain rounded-lg border border-gray-200" src="#" alt="Preview Gambar">
                                 <div class="remove-image-btn" id="removeImageBtn">
                                    <i class="fas fa-times text-xs"></i>
                                 </div>
                              </div>
                              
                              <!-- Kolom Upload Area -->
                              <div class="flex items-center justify-center">
                                 <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer" id="uploadLabel">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                       <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
                                       <p class="pt-1 text-sm text-gray-500">Upload gambar</p>
                                    </div>
                                    <input type="file" class="opacity-0" id="gambar" accept="image/*">
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               
               </form>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden fade-in" style="animation-delay: 0.2s;">
               <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                  <h3 class="text-lg font-semibold">Daftar Produk</h3>
                  <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                           <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                              type="text" placeholder="Cari produk...">
                  </div>
               </div>
               <div class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                     <thead class="bg-gray-50">
                        <tr>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                     </thead>
                     <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                 <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                 </div>
                                 <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Tas Laptop</div>
                                    <div class="text-sm text-gray-500">PRD-003</div>
                                 </div>
                              </div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 299.000</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Hampir Habis</span>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                           </td>
                        </tr><tr>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                 <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                 </div>
                                 <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Tas Laptop</div>
                                    <div class="text-sm text-gray-500">PRD-003</div>
                                 </div>
                              </div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 299.000</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Hampir Habis</span>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                           </td>
                        </tr><tr>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                 <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                 </div>
                                 <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Tas Laptop</div>
                                    <div class="text-sm text-gray-500">PRD-003</div>
                                 </div>
                              </div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 299.000</td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                           <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Hampir Habis</span>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                  <p class="text-sm text-gray-500">Menampilkan 1 sampai 3 dari 10 produk</p>
                  <div class="flex space-x-2">
                     <button class="px-3 py-1 border rounded-lg text-sm">Sebelumnya</button>
                     <button class="px-3 py-1 border rounded-lg bg-indigo-600 text-white text-sm">1</button>
                     <button class="px-3 py-1 border rounded-lg text-sm">2</button>
                     <button class="px-3 py-1 border rounded-lg text-sm">3</button>
                     <button class="px-3 py-1 border rounded-lg text-sm">Selanjutnya</button>
                  </div>
               </div>
                </div>
            </div>
      </div>

      
@endsection
@push('scripts')
 <script>
    const toggleBtn = document.getElementById('toggleFormBtn');
    const form = document.getElementById('formProduk');
    const toggleIcon = document.getElementById('toggleIcon');

    toggleBtn.addEventListener('click', () => {
        if (form.style.display === 'none') {
            form.style.display = 'block';
            toggleIcon.classList.remove('fa-chevron-down');
            toggleIcon.classList.add('fa-chevron-up');
        } else {
            form.style.display = 'none';
            toggleIcon.classList.remove('fa-chevron-up');
            toggleIcon.classList.add('fa-chevron-down');
        }
    });

    // Image preview functionality
    const gambarInput = document.getElementById('gambar');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const uploadLabel = document.getElementById('uploadLabel');
    const removeImageBtn = document.getElementById('removeImageBtn');

    gambarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                imagePreview.src = this.result;
                imagePreviewContainer.style.display = 'block';
            });
            
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function() {
        imagePreview.src = '#';
        imagePreviewContainer.style.display = 'none';
        gambarInput.value = '';
    });
</script>
@endpush