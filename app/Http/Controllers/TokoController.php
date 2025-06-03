<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Toko::withMax('items', 'ongkir');

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('asal', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $tokos = $query->orderByDesc('items_max_ongkir')->paginate(5)->withQueryString();

        return view('toko.index', compact('tokos', 'search'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
        'nama' => 'required|string|min:3|unique:tokos,nama',
        'asal' => 'required|string|min:3',
        'deskripsi' => 'nullable|string',
    ], [
        'nama.required' => 'Nama toko wajib diisi.',
        'nama.min' => 'Nama toko minimal 3 huruf.',
        'nama.unique' => 'Nama toko sudah terdaftar.',
        'asal.required' => 'Asal toko wajib diisi.',
        'asal.min' => 'Asal toko minimal 3 huruf.',
    ]);

    Toko::create($validated);

        return redirect()->route('toko.index')->with('success_swal', 'Toko berhasil ditambahkan');
    }

    public function update(Request $request, Toko $toko) {
        $validated = $request->validate([
        'nama' => 'required|string|min:3|unique:tokos,nama,' . $toko->id,
        'asal' => 'required|string|min:3',
        'deskripsi' => 'nullable|string',
    ]);

    $toko->update($validated);

        return redirect()->route('toko.index')->with('alert', ['type' => 'info', 'message' => 'Toko berhasil diperbarui!', 'timeout' => 3500,]);
    }


   public function destroy(Toko $toko) {
        try {
            $toko->delete();

            return redirect()->route('toko.index')->with('alert', ['type' => 'info', 'message' => 'Toko berhasil dihapus!', 'timeout' => 3500,]);
        } catch (QueryException $e) {
            return redirect()->route('toko.index')->with('alert', ['type' => 'error', 'message' => 'Toko tidak bisa dihapus karena masih digunakan oleh item.', 'timeout' => 3500,]);
        }
   }
}



        