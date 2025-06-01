@extends('layouts.app')

@section('content')
    <div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow">
        <!-- Progress Steps Indicator -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center">
                <!-- Step 1 -->
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-blue-600 rounded-full">
                        1
                    </div>
                    <div class="mt-2 text-sm font-medium text-gray-700">Informasi Dasar</div>
                </div>
                
                <!-- Line between steps -->
                <div class="w-16 h-1 mx-2 bg-gray-300"></div>
                
                <!-- Step 2 -->
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-10 h-10 font-bold text-gray-600 bg-gray-300 rounded-full">
                        2
                    </div>
                    <div class="mt-2 text-sm font-medium text-gray-500">Detail Item</div>
                </div>
                
                <!-- Line between steps -->
                <div class="w-16 h-1 mx-2 bg-gray-300"></div>
                
                <!-- Step 3 -->
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-10 h-10 font-bold text-gray-600 bg-gray-300 rounded-full">
                        3
                    </div>
                    <div class="mt-2 text-sm font-medium text-gray-500">Upload Gambar</div>
                </div>
            </div>
        </div>

        <div class="flex flex-col" style="min-height: calc(100vh - 250px);">
            <!-- Scrollable form content -->
            <div class="flex-1 overflow-y-auto">
                <form id="multiStepForm" action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Step 1 -->
                    <div class="step" id="step1">
                        <h2 class="mb-6 text-xl font-bold text-gray-800">Informasi Dasar</h2>
                        
                        <div class="mb-4">
                            <label for="nama" class="block mb-1 text-sm font-medium text-gray-700">Nama Item*</label>
                            <input type="text" id="nama" name="nama" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Masukkan Nama Item (maks 10 karakter)"
                                   maxlength="10"
                                   value="{{ old('nama') }}">
                            <p id="error-nama" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="block mb-1 text-sm font-medium text-gray-700">Harga*</label>
                            <input type="number" id="harga" name="harga" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Rp."
                                   value="{{ old('harga') }}">
                            <p id="error-harga" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-4">
                            <label for="ongkir" class="block mb-1 text-sm font-medium text-gray-700">Ongkir</label>
                            <input type="number" id="ongkir" name="ongkir" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Rp."
                                   value="{{ old('ongkir', 0) }}">
                            <p id="error-ongkir" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="hidden step" id="step2">
                        <h2 class="mb-6 text-xl font-bold text-gray-800">Detail Item</h2>
                        
                        <div class="mb-4">
                            <label for="brand_id" class="block mb-1 text-sm font-medium text-gray-700">Brand*</label>
                            <select id="brand_id" name="brand_id" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Brand --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="error-brand_id" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>
                        
                        <div class="mb-4">
                            <label for="toko_id" class="block mb-1 text-sm font-medium text-gray-700">Toko*</label>
                            <select id="toko_id" name="toko_id" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Toko --</option>
                                @foreach($tokos as $toko)
                                    <option value="{{ $toko->id }}" {{ old('toko_id') == $toko->id ? 'selected' : '' }}>
                                        {{ $toko->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="error-toko_id" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-4">
                            <label for="kategori_id" class="block mb-1 text-sm font-medium text-gray-700">Kategori*</label>
                            <select id="kategori_id" name="kategori_id" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="error-kategori_id" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi') }}</textarea>
                            <p id="error-deskripsi" class="hidden mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="hidden step" id="step3">
                       <h2 class="mb-6 text-xl font-bold text-gray-800">Upload Gambar</h2>
                       
                       <!-- Container untuk Upload dan Preview Gambar -->
                       <div class="flex items-center gap-4 mb-4">
                          <!-- Area Upload (3/4 width) -->
                          <div class="w-3/4">
                                <label for="gambar" class="block mb-1 text-sm font-medium text-gray-700">Upload Gambar Item (Maks 2MB)</label>
                                <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                   <div class="flex flex-col items-center justify-center px-4 pt-5 pb-6 text-center">
                                      <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                      </svg>
                                      <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload</span><br>
                                            atau drag & drop gambar di sini
                                      </p>
                                      <p class="text-xs text-gray-500">
                                            Format: PNG, JPG, JPEG<br>
                                            Ukuran maks: 2MB
                                      </p>
                                   </div>
                                   <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*" />
                                </label>
                                <p id="error-gambar" class="hidden mt-1 text-sm text-red-600"></p>
                          </div>
                          
                          <!-- Area Preview (1/4 width) -->
                          <div class="flex justify-center w-1/4">
                                <div class="relative">
                                   <img id="preview-image" class="hidden max-w-full rounded max-h-48" src="#" alt="Preview Gambar Item" />
                                   <button type="button" id="remove-image" class="absolute top-0 right-0 hidden p-1 text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full hover:bg-red-600">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                      </svg>
                                   </button>
                                </div>
                          </div>
                       </div>

                       <div class="mb-4">
                           <label for="tanggal" class="block mb-1 text-sm font-medium text-gray-700">Tanggal</label>
                           <input type="date" id="tanggal" name="tanggal" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  value="{{ old('tanggal', date('Y-m-d')) }}">
                           <p id="error-tanggal" class="hidden mt-1 text-sm text-red-600"></p>
                       </div>
                    </div>
                </form>
            </div>
            
            <!-- Fixed navigation buttons -->
            <div class="sticky bottom-0 left-0 right-0 p-4 mt-auto bg-white border-t">
                <div class="flex items-center justify-between">
                    <button type="button" id="backButton" onclick="handleBackButton()" 
                            class="hidden px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Kembali
                    </button>
                    <div id="backButtonSpacer" class="invisible px-4 py-2">Kembali</div>
                    <button type="button" id="nextButton" onclick="handleNextButton()" 
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Selanjutnya
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Variabel untuk melacak step saat ini
        let currentStep = 1;
        const totalSteps = 3;
        let scrolledToError = false;

        // Fungsi untuk update tombol navigasi
        function updateNavigationButtons() {
            const backButton = document.getElementById('backButton');
            const nextButton = document.getElementById('nextButton');
            const backButtonSpacer = document.getElementById('backButtonSpacer');

            // Tampilkan/sembunyikan tombol kembali
            if (currentStep === 1) {
                backButton.classList.add('hidden');
                backButtonSpacer.classList.remove('hidden');
            } else {
                backButton.classList.remove('hidden');
                backButtonSpacer.classList.add('hidden');
            }

            // Update teks tombol selanjutnya/simpan
            if (currentStep === totalSteps) {
                nextButton.textContent = 'Simpan';
            } else {
                nextButton.textContent = 'Selanjutnya';
            }
        }

        // Fungsi untuk handle tombol selanjutnya
        function handleNextButton() {
            scrolledToError = false;
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    document.getElementById(`step${currentStep}`).classList.add('hidden');
                    currentStep++;
                    document.getElementById(`step${currentStep}`).classList.remove('hidden');
                    
                    updateNavigationButtons();
                    updateProgressIndicator();
                } else {
                    // Submit form
                    document.getElementById('multiStepForm').submit();
                }
            }
        }

        // Fungsi untuk handle tombol kembali
        function handleBackButton() {
            if (currentStep > 1) {
                document.getElementById(`step${currentStep}`).classList.add('hidden');
                currentStep--;
                document.getElementById(`step${currentStep}`).classList.remove('hidden');
                
                updateNavigationButtons();
                updateProgressIndicator();
            }
        }

        // Fungsi untuk validasi step
        function validateStep(step) {
            let isValid = true;
            
            // Reset semua error
            document.querySelectorAll('[id^="error-"]').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelectorAll('.border-red-500').forEach(el => {
                el.classList.remove('border-red-500');
                el.classList.add('border-gray-300');
            });

            // Validasi step 1
            if (step === 1) {
                const nama = document.getElementById('nama');
                const harga = document.getElementById('harga');
                
                if (!nama.value) {
                    showError(nama, 'error-nama', 'Nama item wajib diisi');
                    isValid = false;
                } else if (nama.value.length > 10) {
                    showError(nama, 'error-nama', 'Nama item maksimal 10 karakter');
                    isValid = false;
                }
                
                if (!harga.value) {
                    showError(harga, 'error-harga', 'Harga wajib diisi');
                    isValid = false;
                } else if (parseFloat(harga.value) < 0) {
                    showError(harga, 'error-harga', 'Harga tidak boleh negatif');
                    isValid = false;
                }
            }
            
            // Validasi step 2
            if (step === 2) {
                const brandId = document.getElementById('brand_id');
                const tokoId = document.getElementById('toko_id');
                const kategoriId = document.getElementById('kategori_id');
                
                if (!brandId.value) {
                    showError(brandId, 'error-brand_id', 'Brand wajib dipilih');
                    isValid = false;
                }
                
                if (!tokoId.value) {
                    showError(tokoId, 'error-toko_id', 'Toko wajib dipilih');
                    isValid = false;
                }
                
                if (!kategoriId.value) {
                    showError(kategoriId, 'error-kategori_id', 'Kategori wajib dipilih');
                    isValid = false;
                }
            }
            
            // Validasi step 3
            if (step === 3) {
                const gambar = document.getElementById('gambar');
                
                if (gambar.files.length > 0) {
                    if (gambar.files[0].size > 2 * 1024 * 1024) {
                        showError(gambar, 'error-gambar', 'Ukuran file maksimal 2MB');
                        isValid = false;
                    }
                }
            }
            
            return isValid;
        }

        // Fungsi untuk menampilkan error
        function showError(inputElement, errorElementId, message) {
            const errorElement = document.getElementById(errorElementId);
            inputElement.classList.remove('border-gray-300');
            inputElement.classList.add('border-red-500');
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            
            // Scroll ke error pertama
            if (!scrolledToError) {
                inputElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                scrolledToError = true;
            }
        }

        // Fungsi untuk update progress indicator
        function updateProgressIndicator() {
            // Update tampilan progress indicator untuk semua step
            for (let i = 1; i <= totalSteps; i++) {
                const stepEl = document.querySelector(`.flex.justify-center.mb-8 div div:nth-child(${i * 2 - 1}) div:first-child`);
                const labelEl = document.querySelector(`.flex.justify-center.mb-8 div div:nth-child(${i * 2 - 1}) div:last-child`);
                
                if (i < currentStep) {
                    // Step sudah dilewati
                    stepEl.classList.remove('bg-gray-300', 'text-gray-600');
                    stepEl.classList.add('bg-green-500', 'text-white');
                    labelEl.classList.remove('text-gray-500');
                    labelEl.classList.add('text-gray-700');
                } else if (i === currentStep) {
                    // Step aktif
                    stepEl.classList.remove('bg-gray-300', 'text-gray-600', 'bg-green-500');
                    stepEl.classList.add('bg-blue-600', 'text-white');
                    labelEl.classList.remove('text-gray-500');
                    labelEl.classList.add('text-gray-700');
                } else {
                    // Step belum diakses
                    stepEl.classList.remove('bg-blue-600', 'bg-green-500', 'text-white');
                    stepEl.classList.add('bg-gray-300', 'text-gray-600');
                    labelEl.classList.remove('text-gray-700');
                    labelEl.classList.add('text-gray-500');
                }
            }
        }

        // Fungsi untuk menangani upload gambar dan preview
        document.getElementById('gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const removeBtn = document.getElementById('remove-image');
            
            if (file) {
                // Validasi ukuran file (maks 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showError(this, 'error-gambar', 'Ukuran file maksimal 2MB');
                    return;
                }
                
                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    showError(this, 'error-gambar', 'Hanya file JPG, JPEG, atau PNG yang diizinkan');
                    this.value = '';
                    return;
                }
                
                // Reset error jika valid
                document.getElementById('error-gambar').classList.add('hidden');
                this.classList.remove('border-red-500');
                this.classList.add('border-gray-300');
                
                // Tampilkan preview
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewImage.classList.remove('hidden');
                    removeBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Fungsi untuk menghapus gambar
        document.getElementById('remove-image').addEventListener('click', function() {
            const input = document.getElementById('gambar');
            const previewImage = document.getElementById('preview-image');
            const removeBtn = document.getElementById('remove-image');
            
            input.value = '';
            previewImage.src = '#';
            previewImage.classList.add('hidden');
            removeBtn.classList.add('hidden');
            
            // Reset error
            document.getElementById('error-gambar').classList.add('hidden');
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-300');
        });

        // Panggil pertama kali untuk inisialisasi
        updateNavigationButtons();
        updateProgressIndicator();
    </script>
    @endpush
@endsection