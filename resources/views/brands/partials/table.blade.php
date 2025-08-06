<div class="overflow-auto border border-gray-200 rounded-lg scroll-hidden dark:border-gray-950">
        <table class="min-w-full text-sm bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
            <thead class="sticky top-0 z-10 text-xs text-left uppercase bg-gray-100 dark:bg-purple-600 ">
                <tr>
                    <th class="px-6 py-3 font-medium">Logo</th>
                    <th class="px-6 py-3 font-medium">Brand Name</th>
                    <th class="px-6 py-3 font-medium">Item</th>
                    <th class="px-6 py-3 font-medium text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($brands as $brand)
                <tr class="transition-colors hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                    <!-- Logo Column -->
                    <td>
  <div class="flex justify-center">
    <img 
      class="object-contain h-10 max-w-[64px]" 
      src="{{ $brand->image_url }}" 
      alt="{{ $brand->name }}">
  </div>
</td>

                    
                    <!-- Brand Name Column -->
                    <td class="px-6 py-4">
                        <div>
                            <div class="font-medium">{{ $brand->name }}</div>
                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Since {{ $brand->created_at->format('d M Y') }}</div>
                        </div>
                    </td>
                    
                    <!-- Items Count Column -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 text-purple-500 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-green-200">
                                {{ $brand->items_count }} products
                            </span>
                        </div>
                    </td>
                    
                    <!-- Actions Column -->
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-2">
                            <!-- View Button -->
                            <a href="{{ route('brand.items', $brand->id) }}" 
                               class="p-1.5  transition-colors rounded-full hover:text-blue-600 hover:bg-blue-50 dark:hover:text-blue-400 dark:hover:bg-gray-700"
                               title="View Products">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            
                            <!-- Edit Button -->
                            <button onclick="openModal('{{ $brand->id }}')"
                                class="p-1.5  transition-colors rounded-full hover:text-yellow-600 hover:bg-yellow-50 dark:hover:text-yellow-400 dark:hover:bg-gray-700" 
                                title="Edit Brand">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="form-delete" data-jenis="Brand">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="p-1.5  transition-colors rounded-full hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-gray-700" 
                                        title="Delete Brand">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                
                <!-- Edit Modal for each brand -->
                <div id="modal-{{ $brand->id }}" role="dialog" aria-modal="true" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 opacity-0 pointer-events-none backdrop-blur-sm bg-white/10">
                    <div class="relative w-full max-w-md p-6 transition-transform duration-300 transform scale-95 bg-white rounded-lg shadow-lg dark:bg-gray-800 sm:p-8">
                        <button onclick="closeModal('{{ $brand->id }}')" 
                                class="absolute text-gray-400 top-4 right-4 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <h2 class="mb-4 text-xl font-bold text-gray-800 dark:text-white">Edit Brand</h2>
                        <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama Brand</label>
                                <input type="text" name="name" value="{{ $brand->name }}" 
                                       class="block w-full px-3 py-2 mt-1 text-gray-700 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                       required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Baru (opsional)</label>
                                <input type="file" name="image" accept="image/*" 
                                       class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                            </div>
                            @if($brand->image)
                            <div class="mb-4">
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Saat Ini:</span>
                                <img src="{{ asset('storage/'.$brand->image) }}" class="h-16 mt-2 border border-gray-200 rounded dark:border-gray-600">
                            </div>
                            @endif
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button" onclick="closeModal('{{ $brand->id }}')"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    Batal
                                </button>
                                <button type="submit" 
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada brand yang ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($brands->hasPages())
    <div class="flex flex-col items-center justify-between mt-6 space-y-4 sm:flex-row sm:space-y-0">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Menampilkan <span class="font-semibold">{{ $brands->firstItem() }}</span> -
            <span class="font-semibold">{{ $brands->lastItem() }}</span> dari
            <span class="font-semibold">{{ $brands->total() }}</span> Brand
        </div>
        <div class="text-sm">
            {{ $brands->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </div>
    @endif