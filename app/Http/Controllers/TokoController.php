<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class TokoController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;
    $tokos = Toko::when($request->search, function ($query) use ($request) {
    $query->where('nama', 'like', '%' . $request->search . '%');
})->paginate(5); // pagination 5 per halaman

$totalToko = Toko::count();

return view('toko.index', compact('tokos', 'totalToko'));

}

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|min:1|max:50',
        'asal' => 'required|min:2|max:50',
        'deskripsi' => 'nullable|max:255',
    ]);

    Toko::create($request->all());

    return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
}

    public function update(Request $request, Toko $toko)
{
    $request->validate([
        'nama' => 'required|min:1|max:50',
        'asal' => 'required|min:2|max:50',
        'deskripsi' => 'nullable|max:255',
    ]);

    $toko->update($request->all());

    return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
}

   public function destroy(Toko $toko)
{
    $toko->delete();

    return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
}
}