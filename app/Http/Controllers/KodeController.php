<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KodeController extends Controller
{
    public function index()
    {
        return view('kode.index');
    }

    public function cek(Request $request)
    {
        $kode = $request->input('kode');

        switch ($kode) {
            case '1':
                session(['akses_from' => 'a']);
                return redirect()->route('halaman.a');
            case '2':
                session(['akses_from' => 'b']);
                return redirect()->route('halaman.b');
            default:
                return redirect()->back()->with('error', 'Kode tidak valid');
        }
    }

    public function halamanA()
    {
        return view('halaman.a');
    }

    public function halamanB()
    {
        return view('halaman.b');
    }
}

