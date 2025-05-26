<header class="w-full bg-white shadow flex items-center justify-between px-6 py-3">
  <div class="flex items-center gap-3">
    <button onclick="toggleSidebar()" class="text-gray-500 hover:text-black transition-colors md:hidden">
      <i class="fas fa-bars text-lg"></i>
    </button>
    <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
  </div>
  <div class="flex items-center gap-4">
    <!-- Notifikasi -->
    <div class="relative inline-block">
      <button onclick="toggleNotif()" class="relative text-gray-700 hover:text-black text-xl focus:outline-none">
        <i class="fas fa-bell"></i>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
          {{ auth()->user()->unreadNotifications->count() }}
        </span>
      </button>
      
      <div id="notifCard" class="absolute right-0 mt-3 w-72 bg-white border border-gray-200 rounded-lg shadow-lg z-50 transition-all duration-300 transform opacity-0 scale-95 pointer-events-none">
        <div class="p-4 border-b font-semibold text-gray-700">Riwayat Notifikasi</div>
        <div class="max-h-60 overflow-y-auto">
          <ul class="text-sm divide-y divide-gray-100">
            @forelse(auth()->user()->notifications->take(5) as $notification)
              <li class="px-4 py-2 hover:bg-gray-50">{{ $notification->data['message'] }}</li>
            @empty
              <li class="px-4 py-2 text-gray-500">Tidak ada notifikasi</li>
            @endforelse
          </ul>
        </div>
        <div class="p-2 text-center border-t">
          <a href="{{ route('notifications.index') }}" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
        </div>
      </div>
    </div>
    
    <!-- User Profile -->
    <div class="relative">
      <button class="flex items-center space-x-2 text-sm">
        <img src="{{ auth()->user()->avatar_url }}" alt="User" class="rounded-full w-8 h-8" />
        <span class="hidden md:inline-block">{{ auth()->user()->name }}</span>
      </button>
    </div>
  </div>
</header>