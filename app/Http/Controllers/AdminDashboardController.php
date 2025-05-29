<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBrands = Brand::count();
        $totalCategories = Kategori::count();
        $totalItems = Item::count();
        $totalTokos = Toko::count();
        $totalHargaItems = Item::sum('harga');
        $totalOngkir = Item::sum('ongkir');
        $items = Item::with('brand')->latest()->paginate(10);

        $tanggalBatas = \Carbon\Carbon::now()->subDays(5);

        $recentBrands = Brand::where('created_at', '>=', $tanggalBatas)->get();
        $recentCategories = Kategori::where('created_at', '>=', $tanggalBatas)->get();
        $recentTokos = Toko::where('created_at', '>=', $tanggalBatas)->get();
        $recentItems = Item::where('created_at', '>=', $tanggalBatas)->get();

        $totalRecent = $recentBrands->count() + $recentCategories->count() + $recentTokos->count() + $recentItems->count();

        return view('fiks', compact(
            'totalBrands',
            'totalCategories',
            'totalItems',
            'totalTokos',
            'totalHargaItems',
            'totalOngkir',
            'items',
            'recentBrands',
        'recentCategories',
        'recentTokos',
        'recentItems',
        'totalRecent'
        ));
    }
}
