<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'id_user',
        'status',
        'tgl_pesan',
        'subtotal',
        'created_at',
        'updated_at'
    ];
}
