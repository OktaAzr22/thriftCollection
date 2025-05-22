@extends('layouts.app')

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

    @if(request('search') && $brands->isEmpty())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Data tidak ditemukan',
            text: 'Tidak ada brand yang cocok dengan pencarian "{{ request("search") }}".',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

    {{-- Tabel Brand --}}
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">#</th>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Gambar</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
            <tr class="border-t">
                <td class="p-2">{{ $brands->firstItem() + $loop->index }}</td>
                <td class="p-2">{{ $brand->name }}</td>
                <td class="p-2">
                    @if($brand->image)
                        <img src="{{ asset('storage/'.$brand->image) }}" alt="Brand Image" class="h-10">
                    @else
                        -
                    @endif
                </td>
                <td class="p-2 flex gap-2">
                    {{-- Tombol Edit --}}
                    <button onclick="document.getElementById('modal-{{ $brand->id }}').classList.remove('hidden')" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="form-delete">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>

            {{-- Modal Edit --}}
            <div id="modal-{{ $brand->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                    <h2 class="text-xl font-bold mb-4">Edit Brand</h2>
                    <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Nama Brand</label>
                            <input type="text" name="name" value="{{ $brand->name }}" class="mt-1 block w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Gambar Baru (opsional)</label>
                            <input type="file" name="image" class="mt-1 block w-full">
                        </div>
                        @if($brand->image)
                            <div class="mb-4">
                                <span class="text-sm text-gray-600">Gambar Saat Ini:</span><br>
                                <img src="{{ asset('storage/'.$brand->image) }}" class="h-12 mt-1">
                            </div>
                        @endif
                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="document.getElementById('modal-{{ $brand->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $brands->appends(['search' => request('search')])->links() }}
    </div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
@endpush
