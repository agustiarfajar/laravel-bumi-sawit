<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'nama',
        'id_kategori',
        'slug',
        'stok',
        'harga',
        'detail',
        'spesifikasi',
        'diskon',
        'jenis',
        'foto',
        'id_user',
        'created_at',
        'updated_at'
    ];

    protected $rules = [
        'nama' => 'required', 'string', 'unique:produk',
    ];
}
