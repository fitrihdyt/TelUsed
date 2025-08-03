<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Kategori extends Model
{
    //
    use HasFactory;
    
    protected $table = 'categories';
    protected $fillable = ['nama_kategori'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'category_id');
    }
}
