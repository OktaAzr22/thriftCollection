@extends('layouts.app')

@push('styles')
<style>
   .hide-scrollbar {
      scrollbar-width: none;
      -ms-overflow-style: none;
   }

   .hide-scrollbar::-webkit-scrollbar {
      display: none;
   }
</style>
@endpush

@section('content')
    <h1 class="text-2xl font-bold mb-4">Brand List</h1>

    {{-- Form Tambah Brand --}}
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 bg-white p-4 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Brand</label>
            <input type="text" name="name" id="name" value="{{ old('name', $brand->name ?? '') }}" class="mt-1 block w-full border rounded px-3 py-2" required>
            @error('name')
               <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium">Gambar (opsional)</label>
            <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" class="mt-1 block w-full">
        </div>
        <img id="imagePreview" src="#" alt="Preview Gambar" style="display:none; max-width:200px; margin-top:10px;">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Brand</button>
    </form>

    {{-- Form Search --}}
    <form action="{{ route('brands.index') }}" method="GET" class="mb-4 w-1/3 relative">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari nama brand..." 
            class="border rounded px-3 py-2 w-full pr-10"
        >

        @if(request('search'))
            <a href="{{ route('brands.index') }}" 
               class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 text-xl font-bold leading-none">
                &times;
            </a>
        @endif

        <button type="submit" class="absolute right-[-90px] top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded">
            Cari
        </button>
    </form>

    @if(request('search'))
        <p class="mb-2 text-sm text-gray-600">
            Menampilkan hasil untuk: <strong>{{ request('search') }}</strong>
        </p>
    @endif

    {{-- List Brand --}}
    <div id="sliderAuto" class="flex space-x-4 overflow-x-auto scroll-smooth pb-4 hide-scrollbar">
        @forelse ($brands as $brand)
            <div class="w-[200px] h-[260px] bg-white rounded-xl shadow-md p-4 flex-shrink-0 flex flex-col justify-between hover:shadow-xl transition duration-300 text-center">

                {{-- Area Gambar --}}
                <div class="h-[140px] flex items-center justify-center mb-3">
                    @if ($brand->image)
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="h-full object-contain" />
                    @else
                        <div class="w-full h-full border-2 border-dashed border-gray-300 flex items-center justify-center text-xs text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>

                {{-- Nama Brand --}}
                <h3 class="text-base font-semibold text-gray-800 truncate mb-1">{{ $brand->name }}</h3>

                {{-- Tombol Aksi --}}
                <div class="flex justify-center gap-1 mt-auto">
                    <a href=""
                       class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded flex items-center justify-center text-sm"
                       title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('brands.destroy', $brand) }}" method="POST">
                         @csrf @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded flex items-center justify-center text-sm"
                                >
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            {{-- Pesan jika data kosong --}}
            <div class="w-full text-center text-gray-500 py-10 mb-6 bg-white p-4 rounded shadow h-48 flex items-center justify-center">
    <p class="text-lg font-semibold">Data tidak ditemukan.</p>
</div>

        @endforelse
    </div>
  
    

@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }

    const sliderAuto = document.getElementById('sliderAuto');
    setInterval(() => {
        if (sliderAuto.scrollWidth > sliderAuto.clientWidth) {
            sliderAuto.scrollBy({ left: 220, behavior: 'smooth' });
            if (sliderAuto.scrollLeft + sliderAuto.clientWidth >= sliderAuto.scrollWidth) {
                sliderAuto.scrollTo({ left: 0, behavior: 'smooth' });
            }
        }
    }, 3000);
</script>
@endpush
