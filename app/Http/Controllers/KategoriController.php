<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;



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

         return redirect()->back()->with('success_swal', 'Kategori berhasil ditambahkan');
    }

 



public function update(Request $request, Kategori $kategori)
{
    $rules = [
        'nama' => [
            'required',
            'string',
            'min:1',
            'max:50',
            'regex:/^[a-zA-Z\s]+$/',
            Rule::unique('kategoris', 'nama')->ignore($kategori->id),
        ],
    ];

    $messages = [
        'nama.required' => 'Nama kategori wajib diisi.',
        'nama.regex' => 'Nama kategori hanya boleh mengandung huruf dan spasi.',
        'nama.unique' => 'Nama kategori sudah ada di database.',
        'nama.min' => 'Nama kategori minimal 1 karakter.',
        'nama.max' => 'Nama kategori maksimal 50 karakter.',
    ];

    // Validasi manual supaya bisa tangkap error
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        // Gabungkan semua error jadi 1 string (bisa sesuaikan formatnya)
        $errorMessages = $validator->errors()->all();
        $errorText = implode('<br>', $errorMessages);

        return redirect()->back()
            ->withInput()
            ->with('alert', [
                'type' => 'error',
                'message' => $errorText,
                'timeout' => 5000,
            ])
            ->with('openKategoriModal', true);  // supaya modal otomatis terbuka
    }

    // Jika validasi berhasil
    $kategori->update([
        'nama' => $request->nama,
    ]);

    return redirect()->back()->with('alert', [
        'type' => 'success',
        'message' => 'Kategori berhasil diperbarui!',
        'timeout' => 3500,
    ]);
}




    public function destroy(Kategori $kategori)
{
    try {
        $kategori->delete();

         return redirect()->back()->with('alert', [
            'type'    => 'info',
            'message' => 'Kategori berhasil dihapus!',
            'timeout' => 3500,
        ]);
    } catch (QueryException $e) {
         return redirect()->back()->with('alert', [
            'type'    => 'error',
            'message' => 'Kategori tidak bisa dihapus karena masih digunakan oleh item.',
            'timeout' => 5000,
        ]);
    }
}
}
