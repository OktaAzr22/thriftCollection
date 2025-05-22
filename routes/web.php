<?php

use App\Http\Controllers\BrandController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::resource('brands', BrandController::class)->except(['create','edit', 'show']);




