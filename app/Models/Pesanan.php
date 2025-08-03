<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'orders'; 
    protected $fillable = [
        'product_id',
        'size',
        'price',
        'status',
        'shipment_info',
        'shipment_estimate',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
