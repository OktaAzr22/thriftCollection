<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;


// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('items', ItemController::class)->except(['create', 'show']);
route::resource('brands', BrandController::class)->except(['create','edit', 'show']);


Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
Route::put('/toko/{toko}', [TokoController::class, 'update'])->name('toko.update');
Route::delete('/toko/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy');
Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/brand/{brand}/items', [BrandController::class, 'items'])->name('brand.items');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');



Route::resource('kategori', KategoriController::class);


Route::get('/admin/print-pdf', [AdminDashboardController::class, 'downloadPDF'])->name('admin.print-pdf');





Route::post('/toggle-darkmode', function () {
    session(['dark_mode' => !session('dark_mode')]);
    return back();
})->name('toggle.darkmode');


