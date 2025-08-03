<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alamat extends Model
{
    //
    use HasFactory;

    protected $table = 'adress';

    protected $fillable = [
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
}
