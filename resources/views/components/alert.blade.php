@props(['type' => 'success', 'message' => null, 'timeout' => 3000])

@if(session('alert'))
    @php
        $type    = session('alert.type',     $type);
        $message = session('alert.message',  $message);
        $timeout = session('alert.timeout',  $timeout);
    @endphp
@endif

@if($message)
@php
    $id = uniqid('alert-');
    $colors = [
        'success' => ['bg'=>'bg-green-600', 'bar'=>'bg-green-500'],
        'error'   => ['bg'=>'bg-red-600',   'bar'=>'bg-red-500'],
        'info'    => ['bg'=>'bg-blue-600',  'bar'=>'bg-blue-500'],
        'warning' => ['bg'=>'bg-yellow-600','bar'=>'bg-yellow-500'],
    ];
    $c = $colors[$type] ?? $colors['info'];
@endphp

<div id="{{ $id }}"
     class="fixed top-4 right-4 w-80 rounded-lg shadow-lg text-white overflow-hidden {{ $c['bg'] }} animate-slide-in z-50"
     role="alert">
    <div class="flex justify-between items-start px-4 py-3">
        <span>{{ $message }}</span>
        <button onclick="document.getElementById('{{ $id }}').remove()"
                class="text-white/70 hover:text-white font-bold">&times;</button>
    </div>

    {{-- Progress bar di bagian bawah alert --}}
    <div id="{{ $id }}-bar" class="h-1 w-full {{ $c['bar'] }}"></div>
</div>

@once
<style>
@keyframes slide-in { 0% {opacity:0;transform:translateX(100%)} 100% {opacity:1;transform:translateX(0)} }
@keyframes slide-out{ 0% {opacity:1;transform:translateX(0)} 100% {opacity:0;transform:translateX(100%)} }
.animate-slide-in { animation: slide-in 0.35s ease-out forwards }
.animate-slide-out { animation: slide-out 0.35s ease-in forwards }
</style>
@endonce

<script>
(() => {
    const box = document.getElementById('{{ $id }}');
    const bar = document.getElementById('{{ $id }}-bar');
    const t   = {{ $timeout }};

    // Shrink bar
    setTimeout(() => {
        bar.style.transition = `width ${t}ms linear`;
        bar.style.width = '0%';
    }, 10);

    // Auto dismiss
    setTimeout(() => {
        box.classList.replace('animate-slide-in','animate-slide-out');
        setTimeout(() => box.remove(), 350);
    }, t);
})();
</script>
@endif
