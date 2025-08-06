<!-- Sidebar -->
<div class="flex flex-col h-full px-2 py-4 shadow-md rounded-r-xl bg-slate-200 sidebar dark:bg-gray-950 dark:text-slate-100 ">
   <div class="flex items-center justify-between px-3 mb-6">
      <h2 class="text-lg font-bold sidebar-text whitespace-nowrap">MyApp</h2>
      <button onclick="toggleSidebar()" class="text-gray-500 transition-colors hover:text-black dark:text-slate-300 dark:hover:text-white">
         <i id="collapseIcon" class="fas fa-angle-double-left"></i>
      </button>
   </div>
   <nav class="flex-1 space-y-2">
   <!-- Dashboard -->
   <a href="{{ url('/') }}"
      class="flex items-center gap-3 px-3 py-2 rounded nav-item border-l-4 transition-all
         {{ request()->is('/') 
            ? 'bg-purple-100 border-indigo-500 text-black dark:bg-slate-700 dark:text-white' 
            : 'border-transparent text-gray-700 hover:bg-gray-100 hover:border-indigo-500 dark:text-slate-100 dark:hover:bg-slate-700' }}">
      <i class="w-5 text-center fas fa-home"></i>
      <span class="sidebar-text whitespace-nowrap">Dashboard</span>
   </a>

   <!-- Brands -->
   <a href="{{ route('brands.index') }}"
      class="flex items-center gap-3 px-3 py-2 rounded nav-item border-l-4 transition-all
         {{ request()->routeIs('brands.index') 
            ? 'bg-purple-100 border-indigo-500 text-black dark:bg-slate-700 dark:text-white' 
            : 'border-transparent text-gray-700 hover:bg-gray-100 hover:border-indigo-500 dark:text-slate-100 dark:hover:bg-slate-700' }}">
      <i class="w-5 text-center fas fa-box"></i>
      <span class="sidebar-text whitespace-nowrap">Brands</span>
   </a>

   <!-- Kategori -->
   <a href="{{ route('kategori.index') }}"
      class="flex items-center gap-3 px-3 py-2 rounded nav-item border-l-4 transition-all
         {{ request()->routeIs('kategori.index') 
            ? 'bg-purple-100 border-indigo-500 text-black dark:bg-slate-700 dark:text-white' 
            : 'border-transparent text-gray-700 hover:bg-gray-100 hover:border-indigo-500 dark:text-slate-100 dark:hover:bg-slate-700' }}">
      <i class="w-5 text-center fas fa-box"></i>
      <span class="sidebar-text whitespace-nowrap">Kategori</span>
   </a>

   <!-- Toko -->
   <a href="{{ route('toko.index') }}"
      class="flex items-center gap-3 px-3 py-2 rounded nav-item border-l-4 transition-all
         {{ request()->routeIs('toko.index') 
            ? 'bg-purple-100 border-indigo-500 text-black dark:bg-slate-700 dark:text-white' 
            : 'border-transparent text-gray-700 hover:bg-gray-100 hover:border-indigo-500 dark:text-slate-100 dark:hover:bg-slate-700' }}">
      <i class="w-5 text-center fas fa-box"></i>
      <span class="sidebar-text whitespace-nowrap">Toko</span>
   </a>

   <!-- Item -->
   <a href="{{ route('items.index') }}"
      class="flex items-center gap-3 px-3 py-2 rounded nav-item border-l-4 transition-all
         {{ request()->routeIs('items.index') 
            ? 'bg-purple-100 border-indigo-500 text-black dark:bg-slate-700 dark:text-white' 
            : 'border-transparent text-gray-700 hover:bg-gray-100 hover:border-indigo-500 dark:text-slate-100 dark:hover:bg-slate-700' }}">
      <i class="w-5 text-center fas fa-box"></i>
      <span class="sidebar-text whitespace-nowrap">Item</span>
   </a>
</nav>

   <div class="px-3 py-2 border-t border-gray-200 dark:border-slate-600">
      <div class="flex items-center gap-3">
         <img alt="User" class="w-8 h-8 rounded-full">
         <div class="sidebar-text">
            <p class="text-sm font-medium whitespace-nowrap">Admin Master</p>
            <p class="text-xs text-gray-500 dark:text-slate-400 whitespace-nowrap">Admin</p>
         </div>
      </div>
   </div>
</div>