<?php

use App\Http\Controllers\BrandController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::resource('brands', BrandController::class)->except(['create','edit', 'show']);





Route::get('/kategori', function () {
    return view('kategori.kategori2');
});


