<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::resource('brands', BrandController::class)->except(['create','edit', 'show']);
Route::get('/kategori/{kategori?}', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
Route::put('/toko/{toko}', [TokoController::class, 'update'])->name('toko.update');
Route::delete('/toko/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy');