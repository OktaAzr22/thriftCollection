<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $items = Item::orderBy('created_at', 'desc')->get();
    $tokos = Toko::all();
    $brands = Brand::all();
    $kategoris =Kategori::all();
        return view('items.index', compact('items', 'kategoris', 'tokos', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create', [
            'tokos' => Toko::all(),
            'brands' => Brand::all(),
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'ongkir' => 'nullable|numeric|min:0',
            'toko_id' => 'required|exists:tokos,id',
            'brand_id' => 'required|exists:brands,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('items', 'public');
        }

        Item::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'ongkir' => $request->ongkir ?? 0,
            'toko_id' => $request->toko_id,
            'brand_id' => $request->brand_id,
            'kategori_id' => $request->kategori_id,
            'gambar' => $gambarPath,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal ?? Carbon::now(),
        ]);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', [
            'item' => $item,
            'tokos' => Toko::all(),
            'brands' => Brand::all(),
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'ongkir' => 'nullable|numeric|min:0',
            'toko_id' => 'required|exists:tokos,id',
            'brand_id' => 'required|exists:brands,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
            $item->gambar = $request->file('gambar')->store('items', 'public');
        }

        $item->update($request->except('gambar') + ['gambar' => $item->gambar]);

        return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Item $item)
    {
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus!');
    }
}
