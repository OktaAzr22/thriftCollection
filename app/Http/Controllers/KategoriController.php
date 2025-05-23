<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index(Kategori $kategori = null)
    {
        $kategoris = Kategori::latest()->get();
        return view('kategori.index', compact('kategoris', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'min:1',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('kategoris', 'nama')
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.min' => 'Nama kategori minimal 1 karakter',
            'nama.max' => 'Nama kategori maksimal 50 karakter',
            'nama.regex' => 'Nama kategori hanya boleh mengandung huruf dan spasi',
            'nama.unique' => 'Nama kategori sudah ada di database'
        ]);

        try {
            Kategori::create($request->all());
            return redirect()->route('kategori.index')
            
                             ->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Gagal menambahkan kategori: '.$e->getMessage()]);
        }
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => [
                'required',
                'min:1',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('kategoris', 'nama')->ignore($kategori->id)
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.min' => 'Nama kategori minimal 1 karakter',
            'nama.max' => 'Nama kategori maksimal 50 karakter',
            'nama.regex' => 'Nama kategori hanya boleh mengandung huruf dan spasi',
            'nama.unique' => 'Nama kategori sudah ada di database'
        ]);

        try {
            $kategori->update($request->all());
            return redirect()->route('kategori.index')
                             ->with('success', 'Kategori berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Gagal memperbarui kategori: '.$e->getMessage()]);
        }
    }

    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            return redirect()->route('kategori.index')
                             ->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withErrors(['error' => 'Gagal menghapus kategori: '.$e->getMessage()]);
        }
    }
}