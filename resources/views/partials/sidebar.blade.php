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