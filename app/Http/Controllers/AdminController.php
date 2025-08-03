<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return response('Ini halaman khusus admin, middleware berhasil dilalui.');
    }
}
