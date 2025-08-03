<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    //
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'user_id',
        'address_id',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'address_id');
    }

    public function itemTransaksis()
    {
        return $this->hasMany(ItemTransaksi::class, 'transaksi_id');
    }
}
