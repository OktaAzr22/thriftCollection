@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

    <div class="p-6">
        <h1 class="mb-4 text-2xl font-bold">Daftar Wishlist</h1>

        <a href="{{ route('wishlist.create') }}" class="px-4 py-2 text-white bg-blue-600 rounded">+ Tambah Wishlist</a>

        @if (session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-2 md:grid-cols-3 animate-pulse">
            @forelse ($items as $item)
                <div class="p-4 bg-white rounded shadow-md">
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="object-contain w-full h-32 mb-2">
                    @endif
                    
                      <h2 class="text-lg font-semibold">{{ str::mask($item->title, "*", index: "-3") }}</h2>

                    <p class="text-sm text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    <p class="mt-1 text-sm">{{ $item->description }}</p>

                    <div class="flex justify-between mt-3">
                        <a href="{{ route('wishlist.edit', $item) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('wishlist.destroy', $item) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Belum ada wishlist.</p>
            @endforelse
        </div>
    </div>
@endsection