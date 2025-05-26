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
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg overflow-y-auto">
        <div class="p-4 font-bold text-xl border-b">Thrift Collection</div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="block p-2 rounded hover:bg-gray-200">Dashboard</a></li>
                <li><a href="{{ route('brands.index') }}" class="block p-2 rounded hover:bg-gray-200">Brand</a></li>
                <li><a href="{{ route('kategori.index') }}" class="block p-2 rounded hover:bg-gray-200">Kategori</a></li>
                <li><a href="{{ route('toko.index') }}" class="block p-2 rounded hover:bg-gray-200">Toko</a></li>
                <li><a href="{{ route('items.index') }}" class="block p-2 rounded hover:bg-gray-200">Item</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 p-6">
        @yield('content')
    </div>
    <!-- Main Content End-->

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
