<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lacak extends Model
{
    use HasFactory;

    protected $table = 'lacaks';

    protected $fillable = [
        'transaksi_id',
        'status',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
