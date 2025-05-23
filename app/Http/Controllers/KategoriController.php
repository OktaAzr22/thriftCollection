<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama', $request->get('sort', 'asc'))->get();

        $kategori = null;
        if ($request->has('kategori')) {
            $kategori = Kategori::find($request->kategori);
        }

        return view('kategori.index', compact('kategoris', 'kategori'))
               ->with('sort', $request->get('sort', 'asc'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'min:1',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('kategoris', 'nama'),
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.min' => 'Nama kategori minimal 1 karakter',
            'nama.max' => 'Nama kategori maksimal 50 karakter',
            'nama.regex' => 'Nama kategori hanya boleh mengandung huruf dan spasi',
            'nama.unique' => 'Nama kategori sudah ada di database',
        ]);

        Kategori::create($request->only('nama'));

        return redirect()->route('kategori.index')->with('success_swal', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => [
                'required',
                'min:1',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('kategoris', 'nama')->ignore($kategori->id),
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.min' => 'Nama kategori minimal 1 karakter',
            'nama.max' => 'Nama kategori maksimal 50 karakter',
            'nama.regex' => 'Nama kategori hanya boleh mengandung huruf dan spasi',
            'nama.unique' => 'Nama kategori sudah ada di database',
        ]);

        $kategori->update($request->only('nama'));

        return redirect()->route('kategori.index')->with('alert', ['type' => 'info', 'message' => 'Kategori berhasil diperbarui!', 'timeout' => 3500,]);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('alert', ['type' => 'info', 'message' => 'Kategori berhasil dihapus!', 'timeout' => 3500,]);
    }
}
