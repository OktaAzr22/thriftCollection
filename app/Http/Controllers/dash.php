<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Kategori;
use App\Models\Item;
use App\Models\Toko;

class DashboardController extends Controller
{
    public function index()
{
    $totalHarga = Item::sum('harga');
    $totalOngkir = Item::sum('ongkir');
    $topOngkir = Item::orderBy('ongkir', 'desc')->take(5)->get();
$topHarga = Item::orderBy('harga', 'desc')->take(5)->get();


    $data = [
        'brandCount' => Brand::count(),
        'kategoriCount' => Kategori::count(),
        'itemCount' => Item::count(),
        'tokoCount' => Toko::count(),
        'totalHarga' => $totalHarga,
        'totalOngkir' => $totalOngkir,
        'totalBiaya' => $totalHarga + $totalOngkir,
        'topOngkir' => $topOngkir,
    'topHarga' => $topHarga,
    ];

    return view('welcome', compact('data'));
}

}

