<!-- Sidebar -->
         <div class="flex flex-col h-full px-2 py-4 bg-white shadow-md sidebar">
            <div class="flex items-center justify-between px-3 mb-6">
            <h2 class="text-lg font-bold sidebar-text whitespace-nowrap">MyApp</h2>
            <button onclick="toggleSidebar()" class="text-gray-500 transition-colors hover:text-black">
               <i id="collapseIcon" class="fas fa-angle-double-left"></i>
            </button>
            </div>
            <nav class="flex-1 space-y-2">
            <a
               href="{{ url('/') }}"
               class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
               <i class="w-5 text-center fas fa-home"></i>
               <span class="sidebar-text whitespace-nowrap">Dashboard</span>
            </a>
            <a
               href="{{ route('brands.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
               <i class="w-5 text-center fas fa-box"></i>
               <span class="sidebar-text whitespace-nowrap">Brands</span>
            </a>
            <a href="{{ route('kategori.index') }}"class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
               <i class="w-5 text-center fas fa-box"></i>
               <span class="sidebar-text whitespace-nowrap">Kategori</span>
            </a>
            <a href="{{ route('toko.index') }}"class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
               <i class="w-5 text-center fas fa-box"></i>
               <span class="sidebar-text whitespace-nowrap">Toko</span>
            </a>
            <a href="{{ route('items.index') }}"class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
               <i class="w-5 text-center fas fa-box"></i>
               <span class="sidebar-text whitespace-nowrap">Item</span>
            </a>
            <ul>
        <li class="mb-2">
            <details class="group">
                <summary class="font-medium text-blue-700 cursor-pointer">
                    Kategori
                </summary>
                <ul class="mt-2 ml-4 space-y-1">
                    <li>
   <button
      onclick="openModal('TambahKategori')"
      class="text-sm text-green-600 hover:underline"
   >
      Tambah Kategori
   </button>
</li>
<li>
  <button onclick="openModal('DataKategori')" class="px-4 py-2 text-white bg-blue-600 rounded">
      Lihat Data Kategori
   </button>

</li>
                </ul>
            </details>
        </li>
    </ul>
            
             
            </nav>
            <div class="px-3 py-2 border-t">
               <div class="flex items-center gap-3">
                  <img  alt="User" class="w-8 h-8 rounded-full">
                  <div class="sidebar-text">
                     <p class="text-sm font-medium whitespace-nowrap">Admin Master</p>
                     <p class="text-xs text-gray-500 whitespace-nowrap">Admin</p>
                  </div>
               </div>
            </div>
         </div>