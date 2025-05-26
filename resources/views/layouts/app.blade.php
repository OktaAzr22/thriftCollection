<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
  <!-- Custom CSS -->
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  
  @stack('styles')
</head>
<body class="h-screen overflow-hidden bg-gray-100 font-sans">
  <div class="flex h-full flex-col">
    @include('dashboard.partials.header')
    
    <div class="flex flex-1 overflow-hidden">
      @include('dashboard.partials.sidebar')
      
      <main class="flex-1 p-6 overflow-hidden flex flex-col space-y-4">
        @yield('content')
      </main>
    </div>
  </div>
  
  <!-- Modals -->
  @stack('modals')
  
  <!-- JavaScript -->
  <script src="{{ asset('js/dashboard.js') }}"></script>
  @stack('scripts')
</body>
</html>