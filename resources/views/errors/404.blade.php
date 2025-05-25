<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>404 - Tidak Ditemukan</title>
    <style>
        body {
            background-color: #f8fafc;
            color: #2d3748;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
        }
        h1 {
            font-size: 72px;
            margin-bottom: 40px;
        }
        p {
            font-size: 24px;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #3490dc;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>Halaman yang kamu cari tidak ditemukan.</p>
    <a href="{{ url('/') }}">Kembali ke beranda</a>
</body>
</html>
