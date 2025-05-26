<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalShipping = 56; // Contoh statis, bisa diganti dengan query database
        $totalBrands = Brand::count();
        $totalExpenses = 3210; // Contoh statis, bisa diganti dengan query database
        
        $users = User::paginate(10);
        
        return view('dashboard.index', compact(
            'totalItems',
            'totalShipping',
            'totalBrands',
            'totalExpenses',
            'users'
        ));
    }
}