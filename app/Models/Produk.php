<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Produk extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'qty',
        'category_id',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }
}
