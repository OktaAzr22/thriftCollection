<div class="p-6 mb-6 bg-white rounded-lg shadow-xl/30 dark:bg-gray-900">
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
                    <label class="block mb-1 text-sm font-medium " for="name">Nama Brand <span class="text-pink-500">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded dark:placeholder-gray-500 " placeholder="Masukkan Brand name"/>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium ">Gambar Brand</label>
                    <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                </div>           
                <div class="md:col-span-2">
                    <button type="submit" class="px-4 py-2 text-white transition-all duration-200 ease-in-out bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-dark-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>