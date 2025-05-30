<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $brand->nama_brand }} - {{ $items->count() > 0 ? 'Infinite Marquee' : 'No Products Yet' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-50">
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">

        @if($items->count() > 0)
        <!-- HEADER -->
        <div class="flex flex-col items-start justify-between gap-4 mb-8 md:flex-row md:items-end">
            <div>
                <div class="flex items-center mb-2">
                    <a href="{{ url()->previous() }}" class="mr-4 text-gray-500 transition-colors hover:text-blue-600">
                        <i class="text-xl fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $brand->nama_brand }}</h1>
                </div>
                <p class="ml-10 text-gray-500">Discover our premium collection</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-500">{{ $items->count() }} products available</span>
            </div>
        </div>

        <!-- PRODUK -->
        <div class="pb-4 overflow-x-auto">
            <div class="flex gap-6">
                @foreach($items as $item)
                <div class="overflow-hidden bg-white border border-gray-100 shadow-md rounded-xl min-w-[300px]">
                    <div class="relative">
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
     alt="{{ $item->nama }}"
     class="object-contain w-full h-48 bg-white">

                        <div class="absolute px-3 py-1 text-sm font-bold text-white rounded-full top-3 right-3 price-tag">
                            Rp{{ number_format($item->harga) }}
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item->nama }}</h3>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                {{ $item->kategori->nama ?? 'General' }}
                            </span>
                        </div>
                        <div class="flex items-center mb-1 text-sm text-gray-500">
                            <i class="mr-1 text-gray-400 fas fa-store"></i>
                            <span>{{ $item->toko->nama ?? 'Unknown Store' }}</span>
                        </div>
                        <div class="flex items-center mb-3 text-sm text-gray-400">
                            <i class="mr-1 fas fa-calendar-alt"></i>
                            <span>Masuk: {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                        </div>
                        <p class="mb-4 text-sm text-gray-600 line-clamp-2">
                            {{ $item->deskripsi ?: 'No description available.' }}
                        </p>
                        <button class="flex items-center justify-center w-full py-2 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                            <i class="mr-2 fas fa-shopping-cart"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- BRAND INFO -->
        <div class="p-8 mt-16 bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="flex flex-col items-center gap-8 md:flex-row">
                <div class="flex items-center justify-center flex-shrink-0 w-24 h-24 bg-gray-100 rounded-full">
                    @if($brand->image_url)
                    <img src="{{ $brand->image_url }}" alt="{{ $brand->nama_brand }}" class="object-cover w-full h-full rounded-full">
                    @else
                    <i class="text-3xl text-yellow-500 fas fa-crown"></i>
                    @endif
                </div>
                <div>
                    <h2 class="mb-2 text-2xl font-bold text-gray-900">About {{ $brand->nama_brand }}</h2>
                    <p class="text-gray-600">Explore our premium collection of {{ $items->count() }} high-quality products. Each item is carefully curated to bring you the best in style and functionality.</p>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="px-3 py-1 text-sm text-blue-600 rounded-full bg-blue-50">Premium Quality</span>
                        <span class="px-3 py-1 text-sm text-green-600 rounded-full bg-green-50">Free Shipping</span>
                        <span class="px-3 py-1 text-sm text-purple-600 rounded-full bg-purple-50">1-Year Warranty</span>
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- EMPTY STATE -->
    <x-empty-message 
    title="Oops, Data Tidak Ditemukan!" 
    message="Maaf, produk untuk brand ini belum tersedia." 
    button-text="Kembali ke Daftar Brand" 
    button-url="{{ route('brands.index') }}" 
/>

        @endif

    </div>
</body>
</html>
