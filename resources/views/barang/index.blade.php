@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    {{-- alert kustom --}}
    <x-alert />

    <div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Data Barang</h1>

        {{-- Form tambah --}}
        <form action="{{ route('barang.store') }}" method="POST" class="flex gap-3 mb-6">
            @csrf
            <input type="text" name="nama_barang" placeholder="Nama Barang"
                   class="flex-1 border rounded px-3 py-2" required>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
                Tambah
            </button>
        </form>

        {{-- Tabel --}}
        <table class="w-full text-left border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">#</th>
                    <th class="p-3 border">Nama Barang</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($barangs as $no => $barang)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="p-3 border">{{ $no + 1 }}</td>
                    <td class="p-3 border">{{ $barang->nama_barang }}</td>
                    <td class="p-3 border flex gap-2">
                        {{-- button edit --}}
                        <button onclick="openModal({{ $barang->id }}, '{{ addslashes($barang->nama_barang) }}')"
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-400">
                            Edit
                        </button>
                        {{-- button hapus --}}
                        <form id="form-hapus-{{ $barang->id }}" action="{{ route('barang.destroy', $barang) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmHapus({{ $barang->id }})"
                                    class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-500">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- modal edit --}}
    <div id="editModal" class="fixed inset-0 z-50 items-center justify-center bg-black/50 hidden">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold mb-4">Edit Barang</h2>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <input type="text" name="nama_barang" id="editNamaBarang"
                       class="w-full border rounded p-2 mb-4" required>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded">Batal</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SweetAlert sukses tambah / hapus --}}
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
@endsection

@push('scripts')
<script>
    /* ---------- Modal edit ---------- */
    function openModal(id, nama) {
        const M = document.getElementById('editModal');
        document.getElementById('editNamaBarang').value = nama;
        document.getElementById('editForm').action = `/barang/${id}`;
        M.classList.remove('hidden'); M.classList.add('flex');
    }
    function closeModal() {
        const M = document.getElementById('editModal');
        M.classList.add('hidden'); M.classList.remove('flex');
    }
    window.addEventListener('click', e=>{
        const M = document.getElementById('editModal');
        if(e.target===M) closeModal();
    });

    /* ---------- SweetAlert konfirmasi hapus ---------- */
    function confirmHapus(id){
        Swal.fire({
            title: 'Yakin hapus?',
            text: 'Data tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(result=>{
            if(result.isConfirmed){
                document.getElementById('form-hapus-'+id).submit();
            }
        });
    }
</script>
@endpush
