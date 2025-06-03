<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'asal',
        'deskripsi',
    ];
    public function items()
    {
        return $this->hasMany(Item::class, 'toko_id');
    }
}
