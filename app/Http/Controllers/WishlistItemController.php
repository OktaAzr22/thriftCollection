<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistItemController extends Controller
{
    public function index()
    {
        $items = WishlistItem::latest()->get();
        return view('wishlist.index', compact('items'));
    }

    public function create()
    {
        return view('wishlist.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url'
        ]);

        WishlistItem::create($data);
        return redirect()->route('wishlist.index')->with('success', 'Item berhasil ditambahkan!');
    }

    public function edit(WishlistItem $wishlistItem)
    {
        return view('wishlist.edit', compact('wishlistItem'));
    }

    public function update(Request $request, WishlistItem $wishlistItem)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url'
        ]);

        $wishlistItem->update($data);
        return redirect()->route('wishlist.index')->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy(WishlistItem $wishlistItem)
    {
        $wishlistItem->delete();
        return back()->with('success', 'Item dihapus.');
    }
}
