<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    View::composer('*', function ($view) {
        $since = now()->subDays(5); // Notifikasi 5 hari terakhir
        
        // Notifikasi Brand
        $brandItems = Brand::where('created_at', '>=', $since)->get()->map(function ($item) {
            return [
                'type' => 'Brand',
                'name' => $item->name,
                'time' => $item->created_at,
                'message' => 'Brand baru : ' . $item->name,
                'icon' => 'brand',
                'color' => 'blue'
            ];
        });

        // Notifikasi Kategori
        $kategoriItems = Kategori::where('created_at', '>=', $since)->get()->map(function ($item) {
            return [
                'type' => 'Kategori',
                'name' => $item->nama,
                'time' => $item->created_at,
                'message' => 'Kategori baru ditambahkan: ' . $item->nama_kategori,
                'icon' => 'category',
                'color' => 'green'
            ];
        });

        // Notifikasi Toko
        $tokoItems = Toko::where('created_at', '>=', $since)->get()->map(function ($item) {
            return [
                'type' => 'Toko',
                'name' => $item->nama,
                'time' => $item->created_at,
                'message' => 'Toko baru bergabung: ' . $item->nama,
                'icon' => 'store',
                'color' => 'purple'
            ];
        });

        // Notifikasi Item
        $itemItems = Item::where('created_at', '>=', $since)->get()->map(function ($item) {
            return [
                'type' => 'Item',
                'name' => $item->nama,
                'time' => $item->created_at,
                'message' => 'Item baru tersedia: ' . $item->nama,
                'icon' => 'item',
                'color' => 'orange'
            ];
        });

        // Gabungkan semua notifikasi
        $allNotifications = $brandItems->merge($kategoriItems)
                            ->merge($tokoItems)
                            ->merge($itemItems)
                            ->sortByDesc('time')
                            ->values();

        $view->with('allNotifications', $allNotifications);
        $view->with('totalNotifications', $allNotifications->count());
    });
}
}
