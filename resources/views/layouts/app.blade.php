<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800">
   <!-- Sidebar fixed -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg overflow-y-auto">
        <div class="p-4 font-bold text-xl border-b">My Sidebar</div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="block p-2 rounded hover:bg-gray-200">Dashboard</a></li>
                <li><a href="{{ route('brands.index') }}" class="block p-2 rounded hover:bg-gray-200">Brand</a></li>
                <li><a href="" class="block p-2 rounded hover:bg-gray-200">Kategori</a></li>
                <li><a href="#" class="block p-2 rounded hover:bg-gray-200">Menu 3</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 p-6">
       
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <script>
      Swal.fire({
         icon: 'success',
         title: 'Berhasil!',
         text: '{{ session("success") }}',
         timer: 2000,
         showConfirmButton: false
      });
    </script>
    @endif
    @if (session('error'))
    <script>
      Swal.fire({
         icon: 'error',
         title: 'Gagal!',
         text: '{{ session("error") }}',
         timer: 2000,
         showConfirmButton: false
      });
    </script>
    @endif
    <script>
      // Konfirmasi hapus pakai SweetAlert
      document.addEventListener('DOMContentLoaded', function () {
         const forms = document.querySelectorAll('.form-delete');

         forms.forEach(form => {
               form.addEventListener('submit', function (e) {
                  e.preventDefault();

                  Swal.fire({
                     title: 'Yakin mau hapus?',
                     text: "Data akan hilang permanen!",
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
    @stack('scripts')
</body>
</html>
