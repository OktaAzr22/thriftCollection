@extends('layouts.a')

@section('content')
<div class="container px-4 mx-auto">
    <h1 class="mb-6 text-2xl font-semibold">Dashboard</h1>

    <!-- Summary cards: totals for Brand, Kategori, Item, Toko -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Brands -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Brands</div>
            <div class="mt-1 text-3xl font-bold">{{ $totalBrands }}</div>
        </div>
        <!-- Total Kategori -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Kategori</div>
            <div class="mt-1 text-3xl font-bold">{{ $totalCategories }}</div>
        </div>
        <!-- Total Items -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Items</div>
            <div class="mt-1 text-3xl font-bold">{{ $totalItems }}</div>
        </div>
        <!-- Total Toko -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Toko</div>
            <div class="mt-1 text-3xl font-bold">{{ $totalTokos }}</div>
        </div>
    </div>

    <!-- Financial totals: Harga Items & Ongkir -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
        <!-- Total Harga Items -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Harga Item</div>
            <div class="mt-1 text-3xl font-bold">Rp {{ number_format($totalHargaItems, 0, ',', '.') }}</div>
        </div>
        <!-- Total Ongkir -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Ongkir</div>
            <div class="mt-1 text-3xl font-bold">Rp {{ number_format($totalOngkir, 0, ',', '.') }}</div>
        </div>
    </div>
<!-- Notifikasi entri baru -->
@if($recentBrands->count() || $recentCategories->count() || $recentTokos->count() || $recentItems->count())
    <div class="p-4 mb-6 text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500 rounded" role="alert">
        <p class="font-bold">Notifikasi</p>
        <ul class="list-disc list-inside">
            @foreach($recentBrands as $brand)
                <li>Brand baru: {{ $brand->nama_brand }} ({{ $brand->created_at->diffForHumans() }})</li>
            @endforeach
            @foreach($recentCategories as $kategori)
                <li>Kategori baru: {{ $kategori->nama_kategori }} ({{ $kategori->created_at->diffForHumans() }})</li>
            @endforeach
            @foreach($recentTokos as $toko)
                <li>Toko baru: {{ $toko->nama_toko }} ({{ $toko->created_at->diffForHumans() }})</li>
            @endforeach
            @foreach($recentItems as $item)
                <li>Item baru: {{ $item->nama }} ({{ $item->created_at->diffForHumans() }})</li>
            @endforeach
        </ul>
    </div>
@endif

   <!-- Search dan titik 3 -->
<div class="flex items-center justify-between mb-4">
    <input type="text" id="searchInput" placeholder="Cari item..." class="w-1/3 px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">

    <!-- Dropdown titik 3 -->
    <div class="relative">
        <button onclick="toggleGlobalDropdown()" class="text-gray-600 hover:text-gray-900 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
            </svg>
        </button>
        <div id="globalDropdown" class="absolute right-0 z-10 hidden w-32 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg">
            <button onclick="setActionMode('default')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Default</button>
            <button onclick="setActionMode('edit')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Mode</button>
        </div>
    </div>
</div>

<!-- Items table -->
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-6 py-3">Gambar</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Brand</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody id="itemsTable">
            @forelse($items as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">
                    <img src="{{ asset('assets/img/uploads/gambar_item/' . $item->gambar) }}" alt="{{ $item->nama }}" class="object-cover w-12 h-12 rounded">
                </td>
                <td class="px-6 py-4 font-medium text-gray-900">{{ $item->nama }}</td>
                <td class="px-6 py-4">{{ $item->brand->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                <!-- Action Cell -->
<td class="px-6 py-4">
    <div class="action-cell" data-id="{{ $item->id }}"
         data-nama="{{ $item->nama }}"
         data-brand="{{ $item->brand->name ?? '-' }}"
         data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}"
         data-gambar="{{ asset('assets/img/uploads/gambar_item/' . $item->gambar) }}">
        <button onclick="openDrawer(this)" class="text-blue-500 hover:text-blue-700">
            👁️
        </button>
    </div>
</td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data item.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
<!-- Drawer -->
<div id="drawer" class="fixed top-0 right-0 z-50 h-full overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white shadow-lg w-80">
    <div class="flex items-center justify-between px-4 py-3 border-b">
        <h2 class="text-lg font-semibold">Detail Item</h2>
        <button onclick="closeDrawer()" class="text-xl text-gray-500 hover:text-red-500">×</button>
    </div>
    <div class="p-4 space-y-4">
        <img id="drawerGambar" src="" alt="Gambar" class="object-cover w-full h-48 rounded">
        <div>
            <h3 class="font-bold text-gray-700">Nama:</h3>
            <p id="drawerNama" class="text-gray-600"></p>
        </div>
        <div>
            <h3 class="font-bold text-gray-700">Brand:</h3>
            <p id="drawerBrand" class="text-gray-600"></p>
        </div>
        <div>
            <h3 class="font-bold text-gray-700">Tanggal:</h3>
            <p id="drawerTanggal" class="text-gray-600"></p>
        </div>
    </div>
</div>

    <!-- Pagination -->
    <div class="p-4">
        {{ $items->links() }}
    </div>
</div>

<!-- Script -->
<script>
    function toggleGlobalDropdown() {
        const menu = document.getElementById('globalDropdown');
        menu.classList.toggle('hidden');
    }

    function setActionMode(mode) {
        const cells = document.querySelectorAll('.action-cell');
        cells.forEach(cell => {
            const id = cell.dataset.id;
            if (mode === 'default') {
                cell.innerHTML = `<a href="#" class="text-blue-500 hover:text-blue-700">👁️</a>`;
            } else if (mode === 'edit') {
                cell.innerHTML = `
                    <a href="/items/${id}/edit" class="mr-2 text-green-600 hover:underline">Edit</a>
                    <form action="/items/${id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                `;
            }
        });

        // Sembunyikan dropdown setelah klik
        document.getElementById('globalDropdown').classList.add('hidden');
    }

    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll("#itemsTable tr");
        rows.forEach(row => {
            const nama = row.querySelector("td:nth-child(2)")?.textContent.toLowerCase() || "";
            row.style.display = nama.includes(keyword) ? "" : "none";
        });
    });
</script>

</div>
@endsection
<script>
    function openDrawer(button) {
        const parent = button.closest('.action-cell');

        // Ambil data
        const nama = parent.dataset.nama;
        const brand = parent.dataset.brand;
        const tanggal = parent.dataset.tanggal;
        const gambar = parent.dataset.gambar;

        // Isi drawer
        document.getElementById('drawerNama').textContent = nama;
        document.getElementById('drawerBrand').textContent = brand;
        document.getElementById('drawerTanggal').textContent = tanggal;
        document.getElementById('drawerGambar').src = gambar;

        // Tampilkan drawer
        const drawer = document.getElementById('drawer');
        drawer.classList.remove('translate-x-full');
        drawer.classList.add('translate-x-0');
    }

    function closeDrawer() {
        const drawer = document.getElementById('drawer');
        drawer.classList.remove('translate-x-0');
        drawer.classList.add('translate-x-full');
    }
</script>
