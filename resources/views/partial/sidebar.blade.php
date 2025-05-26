<div class="sidebar bg-white h-full shadow-md flex flex-col px-2 py-4">
  <div class="flex justify-between items-center px-3 mb-6">
    <h2 class="text-lg font-bold sidebar-text whitespace-nowrap">{{ config('app.name', 'Laravel') }}</h2>
    <button onclick="toggleSidebar()" class="text-gray-500 hover:text-black transition-colors">
      <i id="collapseIcon" class="fas fa-angle-double-left"></i>
    </button>
  </div>
  
  <nav class="space-y-2 flex-1">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
      <i class="fas fa-home w-5 text-center"></i>
      <span class="sidebar-text whitespace-nowrap">Dashboard</span>
    </a>
    
    <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100 {{ request()->routeIs('products.*') ? 'bg-gray-100' : '' }}">
      <i class="fas fa-box w-5 text-center"></i>
      <span class="sidebar-text whitespace-nowrap">Products</span>
    </a>
    
    <a onclick="openModal()" class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
      <i class="fas fa-plus w-5 text-center"></i>
      <span class="sidebar-text whitespace-nowrap">Modal</span>
    </a>
    
    <a onclick="openDrawer()" class="flex items-center gap-3 px-3 py-2 rounded nav-item hover:bg-gray-100">
      <i class="fas fa-bars w-5 text-center"></i>
      <span class="sidebar-text whitespace-nowrap">Drawer</span>
    </a>
  </nav>
  
  <div class="px-3 py-2 border-t">
    <div class="flex items-center gap-3">
      <img src="{{ auth()->user()->avatar_url }}" alt="User" class="rounded-full w-8 h-8">
      <div class="sidebar-text">
        <p class="text-sm font-medium whitespace-nowrap">{{ auth()->user()->name }}</p>
        <p class="text-xs text-gray-500 whitespace-nowrap">{{ ucfirst(auth()->user()->role) }}</p>
      </div>
    </div>
  </div>
</div>