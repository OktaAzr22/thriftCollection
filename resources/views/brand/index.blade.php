@extends('layouts.app')

@section('title', 'Halaman Brand')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Daftar Brand</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @for ($i = 1; $i <= 6; $i++)
            <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
                <h3 class="text-lg font-semibold">Brand {{ $i }}</h3>
                <p class="text-gray-600">Deskripsi singkat untuk brand {{ $i }}.</p>
            </div>
        @endfor
    </div>
@endsection
