<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'App' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>  @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <header class="bg-white shadow p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-lg font-bold">Brand Management</h1>
                <a href="" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Brand
                </a>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-6 container mx-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
