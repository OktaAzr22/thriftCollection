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

    {{-- Fixed Sidebar --}}
    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-md z-10">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-blue-600">MyLaravelApp</h1>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ url('/brand') }}" class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->is('brand') ? 'bg-blue-200 font-semibold' : '' }}">
                Brand
            </a>
            <a href="{{ url('/kategori') }}" class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->is('kategori') ? 'bg-blue-200 font-semibold' : '' }}">
                Kategori
            </a>
        </nav>
    </aside>

    {{-- Content --}}
    <div class="pl-64 min-h-screen">
        <main class="p-8">
            {{-- Flash message --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
