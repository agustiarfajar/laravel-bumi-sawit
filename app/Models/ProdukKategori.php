<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKategori extends Model
{
    use HasFactory;

    protected $table = 'produk_kategori';
    protected $fillable = [
        'nama',
        'foto',
        'created_at',
        'updated_at'
    ];
}
