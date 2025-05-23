<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /** GET /barang */
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('barang.index', compact('barangs'));
    }

    /** POST /barang */
    public function store(Request $request)
    {
        $request->validate(['nama_barang' => 'required|max:255']);
        Barang::create($request->only('nama_barang'));

        // SweetAlert sukses tambah
        return back()->with('success_swal', 'Barang berhasil ditambahkan!');
    }

    /** PUT /barang/{barang} */
    public function update(Request $request, Barang $barang)
    {
        $request->validate(['nama_barang' => 'required|max:255']);
        $barang->update($request->only('nama_barang'));

        // alert kustom sukses edit
        return back()->with('alert', [
            'type'    => 'info',
            'message' => 'Barang diperbarui!',
            'timeout' => 3500
        ]);
    }

    /** DELETE /barang/{barang} */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        // SweetAlert sukses hapus
        
        return back()->with('alert', [
            'type'    => 'success',
            'message' => 'Barang berhasil dihapus!',
            'timeout' => 3500
        ]);
    }
}

