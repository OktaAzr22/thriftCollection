<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Item</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        img { width: 40px; height: auto; }
    </style>
</head>
<body>
    <h2>Daftar Item</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Brand</th>
                <th>Asal</th>
                <th>Total (Harga + Ongkir)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>
                        @if ($item->gambar)
                            <img src="{{ public_path('storage/' . $item->gambar) }}" alt="gambar">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->brand->nama_brand ?? '-' }}</td>
                    <td>{{ $item->toko->asal ?? $item->toko->nama_toko ?? '-' }}</td>
                    <td>Rp {{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
