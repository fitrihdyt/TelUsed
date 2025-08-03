<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemTransaksi extends Model
{
    //
     use HasFactory;

    protected $table = 'item_transaksis';

    protected $fillable = [
        'transaksi_id',
        'product_id',
        'quantity',
        'harga',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
