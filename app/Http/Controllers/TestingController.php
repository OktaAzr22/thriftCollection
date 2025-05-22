<?php

namespace App\Http\Controllers;

use App\Models\Brand;

class TestingController extends Controller {
public function slider() {
  $brands = Brand::latest()->get();

   return view('brand.slider', compact('brands'));
}
}
