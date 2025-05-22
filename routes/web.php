<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::resource('brands', BrandController::class)->except(['create','edit', 'show']);

Route::get('/brand', function () {
    return view('brand.index');
});

Route::get('/kategori', function () {
    return view('kategori.kategori2');
});


Route::get('/brand-slider', [TestingController::class, 'slider']);