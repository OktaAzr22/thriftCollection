<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'ongkir',
        'toko_id',
        'brand_id',
        'kategori_id',
        'gambar',
        'deskripsi',
        'tanggal',
    ];

    public function toko() {
        return $this->belongsTo(Toko::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
