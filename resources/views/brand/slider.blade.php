@extends('layouts.testing')
@push('styles')
<style>
   .hide-scrollbar {
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE 10+ */
}

.hide-scrollbar::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}

</style>
@endpush
@section('content')
<h2 class="text-xl font-semibold mb-4">Daftar Brand - Slider Auto</h2>

{{-- Container slider tanpa no-scrollbar supaya scroll bar muncul --}}
<div id="sliderAuto" class="flex space-x-4 overflow-x-auto scroll-smooth pb-4 hide-scrollbar">


    @foreach ($brands as $brand)
        <div class="w-[200px] h-[260px] bg-white rounded-xl shadow-md p-4 flex-shrink-0 flex flex-col justify-between hover:shadow-xl transition duration-300 text-center">

            {{-- Area Gambar --}}
            <div class="h-[140px] flex items-center justify-center mb-3">
                @if ($brand->image)
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                        class="h-full object-contain" />
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
                <form action="" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus brand ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded flex items-center justify-center text-sm"
                            title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>

        </div>
    @endforeach

</div>

<script>
  const sliderAuto = document.getElementById('sliderAuto');

  setInterval(() => {
    sliderAuto.scrollBy({ left: 220, behavior: 'smooth' });
    if (sliderAuto.scrollLeft + sliderAuto.clientWidth >= sliderAuto.scrollWidth) {
      sliderAuto.scrollTo({ left: 0, behavior: 'smooth' });
    }
  }, 3000);
</script>

@endsection
