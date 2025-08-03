<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address_title',
        'address',
        'address2',
        'city',
        'zip_code',
        'is_personal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
