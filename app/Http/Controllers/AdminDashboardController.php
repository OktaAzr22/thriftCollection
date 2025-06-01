<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\Item;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['brand', 'kategori', 'toko'])->latest();

        // Filter pencarian berdasarkan nama item
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $items = $query->paginate(5)->withQueryString();

        // Data lainnya...
        $totalBrands = Brand::count();
        $totalCategories = Kategori::count();
        $totalItems = Item::count();
        $totalTokos = Toko::count();
        $totalHargaItems = Item::sum('harga');
        $totalOngkir = Item::sum('ongkir');

        $tanggalBatas = Carbon::now()->subDays(5);

        $recentBrands = Brand::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentCategories = Kategori::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentTokos = Toko::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentItems = Item::where('created_at', '>=', $tanggalBatas)->latest()->get();

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

    public function downloadPDF(Request $request)
{
    $query = Item::with(['brand', 'kategori', 'toko'])->latest();

    if ($request->has('search') && $request->search != '') {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $items = $query->get(); // tidak pakai paginate untuk PDF

    $pdf = PDF::loadView('pdf.items', compact('items'));
    return $pdf->download('data-items.pdf');
}
}
