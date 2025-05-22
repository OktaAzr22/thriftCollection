<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" bg-gray-100 text-gray-900">
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>
    <!-- SweetAlert2 -->
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
