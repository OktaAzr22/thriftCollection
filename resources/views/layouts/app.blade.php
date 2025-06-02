<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Modern Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    .sidebar {
      width: 16rem;
      transition: all 0.3s ease;
    }
    .sidebar-collapsed .sidebar {
      width: 4rem;
    }
    .sidebar-collapsed .sidebar-text {
      opacity: 0;
      width: 0;
      height: 0;
      overflow: hidden;
      transition: opacity 0.2s ease, width 0.3s ease 0.1s;
    }
    .sidebar-text {
      opacity: 1;
      width: auto;
      height: auto;
      transition: opacity 0.3s ease 0.1s, width 0.3s ease;
    }
    
  </style>
  @stack('styles')
</head>
<body class="h-screen overflow-hidden font-sans bg-gray-100">
  <div class="flex flex-col h-full">
      <header class="flex items-center justify-between w-full px-6 py-3 bg-white shadow">
            <div class="flex items-center gap-3">
               <button onclick="toggleSidebar()" class="text-gray-500 transition-colors hover:text-black md:hidden">
                  <i class="text-lg fas fa-bars"></i>
               </button>
               <h1 class="text-lg font-semibold text-gray-800">Admin Master</h1>
            </div>
            <div class="flex items-center gap-4">
               <!-- Wrapper Notifikasi -->
               <div class="relative inline-block">
                  <!-- Icon Bell -->
                  <button onclick="toggleNotif()" class="relative text-xl text-gray-700 hover:text-black focus:outline-none">
                     <i class="fas fa-bell"></i>
                     @if($totalNotifications > 0)
                        <span class="absolute flex items-center justify-center w-5 h-5 text-xs text-white bg-red-500 rounded-full -top-2 -right-2">
                           {{ $totalNotifications }}
                        </span>
                     @endif
                  </button>
                  <!-- Card Riwayat Notif -->
                  <div id="notifCard" class="absolute right-0 z-50 mt-3 transition-all duration-300 transform scale-95 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 pointer-events-none w-72">
                     <div class="p-4 font-semibold text-gray-700 border-b">Riwayat Notifikasi</div>
                     <!-- Konten scrollable -->
                     <div class="overflow-y-auto max-h-60">
                        <ul class="text-sm divide-y divide-gray-100">
                          @forelse($allNotifications as $notif)
                          <li class="px-4 py-2 hover:bg-gray-50">
                            <div class="flex items-start">
                              <!-- Icon berbeda untuk setiap jenis notifikasi -->
                              @if($notif['type'] === 'Brand')
                              <svg class="w-5 h-5 mt-0.5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                              </svg>
                              @elseif($notif['type'] === 'Kategori')
                              <svg class="w-5 h-5 mt-0.5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                              </svg>
                              @elseif($notif['type'] === 'Toko')
                              <svg class="w-5 h-5 mt-0.5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                              </svg>
                              @elseif($notif['type'] === 'Item')
                              <svg class="w-5 h-5 mt-0.5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                              </svg>
                              @endif
                              <div>
                                  <div class="font-medium">
                                      {{ $notif['message'] }}
                                  </div>
                                  <div class="text-sm text-gray-500">
                                      {{ $notif['time']->diffForHumans() }}
                                  </div>
                              </div>
                            </div>
                          </li>
                          @empty
                          <li class="p-3 text-center text-gray-500">Tidak ada notifikasi baru</li>
                          @endforelse
                        </ul>
                     </div>
                     <div class="p-2 text-center border-t">
                        <button class="text-sm text-blue-600 hover:underline">Done</button>
                     </div>
                  </div>
                  </div>
                  <div class="relative">
                     <button class="flex items-center space-x-2 text-sm">
                     <img  alt="User" class="w-8 h-8 rounded-full" />
                     <span class="hidden md:inline-block">John Doe</span>
                     </button>
                  </div>
               </div>
      </header> 
      <div class="flex flex-1 overflow-hidden">
         @include('partials.sidebar')
         <main class="flex flex-col flex-1 p-6 space-y-4 ">
            @yield('content')
            
         </main>
      </div>    
  </div>
  @include('partials.modals.tambah_kategori')
  @include('partials.modals.view_kategori')



  
  
  <script>
    function toggleSidebar() {
      const body = document.body;
      const icon = document.getElementById("collapseIcon");
      
      body.classList.toggle("sidebar-collapsed");
      
      if (body.classList.contains("sidebar-collapsed")) {
        icon.classList.remove("fa-angle-double-left");
        icon.classList.add("fa-angle-double-right");
      } else {
        icon.classList.remove("fa-angle-double-right");
        icon.classList.add("fa-angle-double-left");
      }
    }

      // Fungsi toggleForm tetap sama
      function toggleForm() {
         const formContent = document.getElementById("formContent");
         const icon = document.getElementById("toggleIcon");

         if (formContent.style.height === "0px") {
            formContent.style.height = formContent.scrollHeight + "px";
            icon.classList.remove("fa-chevron-down");
            icon.classList.add("fa-chevron-up");
            document.getElementById("toggleFormBtn").setAttribute("aria-expanded", "true");
         } else {
            formContent.style.height = "0px";
            icon.classList.remove("fa-chevron-up");
            icon.classList.add("fa-chevron-down");
            document.getElementById("toggleFormBtn").setAttribute("aria-expanded", "false");
         }
      }
      document.addEventListener("DOMContentLoaded", function() {
         // Pastikan form tertutup saat pertama kali dimuat
         const formContent = document.getElementById("formContent");
         formContent.style.height = "0px";
      });
  </script>
  <!-- notif -->
  <script>
    function toggleNotif() {
      const notif = document.getElementById("notifCard");
      if (notif.classList.contains("opacity-0")) {
        notif.classList.remove("opacity-0", "scale-95", "pointer-events-none");
        notif.classList.add("opacity-100", "scale-100");
      } else {
        notif.classList.remove("opacity-100", "scale-100");
        notif.classList.add("opacity-0", "scale-95", "pointer-events-none");
      }
    }

     // Klik di luar untuk menutup
    document.addEventListener('click', function (e) {
      const notif = document.getElementById("notifCard");
      const bell = e.target.closest('button');
      if (!e.target.closest('#notifCard') && !bell) {
        notif.classList.remove("opacity-100", "scale-100");
        notif.classList.add("opacity-0", "scale-95", "pointer-events-none");
      }
    });
  </script>
  
  <script>
   function openModal(id) {
      const modal = document.getElementById(`modal-${id}`);
      modal.classList.remove('hidden', 'pointer-events-none');
      setTimeout(() => {
         modal.classList.remove('opacity-0');
         modal.classList.add('opacity-100');
         modal.firstElementChild.classList.remove('scale-95');
         modal.firstElementChild.classList.add('scale-100');
      }, 10);
   }

   function closeModal(id) {
   const modal = document.getElementById(`modal-${id}`);

   modal.classList.remove('opacity-100');
   modal.classList.add('opacity-0');
   modal.firstElementChild.classList.remove('scale-100');
   modal.firstElementChild.classList.add('scale-95');

   setTimeout(() => {
      modal.classList.add('hidden', 'pointer-events-none');
      
      // 🔁 Reload jika sebelumnya ada error validasi
      if (typeof hasValidationError !== 'undefined' && hasValidationError) {
         location.reload();
      }
   }, 300);
}


   document.addEventListener('click', function(e) {
      document.querySelectorAll('[id^="modal-"]').forEach(modal => {
         if (!modal.classList.contains('hidden') && e.target === modal) {
            closeModal(modal.id.replace('modal-', ''));
         }
      });
   });
  

</script>

  <!-- drawer -->
 <!-- Script -->
<script>
  function openDrawer() {
    const drawer = document.getElementById("drawer");
    drawer.classList.remove("opacity-0", "pointer-events-none");
    drawer.firstElementChild.classList.remove("translate-x-full");
    drawer.firstElementChild.classList.add("translate-x-0");
  }

  function closeDrawer() {
    const drawer = document.getElementById("drawer");
    drawer.classList.add("opacity-0", "pointer-events-none");
    drawer.firstElementChild.classList.add("translate-x-full");
    drawer.firstElementChild.classList.remove("translate-x-0");
  }

  // Tutup drawer jika klik di luar
  document.addEventListener("click", function (e) {
    const drawer = document.getElementById("drawer");
    if (e.target === drawer) closeDrawer();
  });
  
</script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @push('scripts')

        @if(session('success_swal'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session("success_swal") }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        @endif

    @endpush
    {{-- Config global confirm hapus --}}
    <script>
      document.addEventListener('DOMContentLoaded', function () {
         const forms = document.querySelectorAll('.form-delete');

         forms.forEach(form => {
               form.addEventListener('submit', function (e) {
                  e.preventDefault();

                  const jenis = form.getAttribute('data-jenis') || 'data';

                  Swal.fire({
                     title: `Yakin mau hapus ${jenis}?`,
                     text: `${jenis.charAt(0).toUpperCase() + jenis.slice(1)} akan hilang permanen!`,
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#e3342f',
                     cancelButtonColor: '#6c757d',
                     confirmButtonText: 'Ya, hapus!',
                     cancelButtonText: 'Batal'
                  }).then((result) => {
                     if (result.isConfirmed) {
                           form.submit();
                     }
                  });
               });
         });
      });
      
    </script>
    {{-- Config global confirm hapus  end --}}
    @stack('scripts')
</body>
</html>