<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');

    $brands = Brand::when($search, function ($query, $search) {
        $query->where('name', 'like', '%' . $search . '%');
    })->latest()->paginate(5)->withQueryString();

    return view('brands.index', compact('brands', 'search'));
}


    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('brands.index')->with('success_swal', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, Brand $brand) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $brand->image;
        if ($request->hasFile('image')) {
            if ($imagePath) Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        $brand->update([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('brands.index')->with('alert', [
            'type'    => 'info',
            'message' => 'Brand berhasil diperbarui!',
            'timeout' => 3500
        ]);

    }

    public function destroy(Brand $brand) {
        try {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            $brand->delete();
            return redirect()->route('brands.index')->with('alert', [
            'type'    => 'info',
            'message' => 'Brand dihapus!',
            'timeout' => 3500
        ]);
        } catch (QueryException $e) {
            return redirect()->route('brands.index')->with('alert', [
            'type'    => 'error',
            'message' => 'Brand tidak bisa dihapus karena masih digunakan oleh item.',
            'timeout' => 5000
        ]);
        }

    }     
}


   
        
