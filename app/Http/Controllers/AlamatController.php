<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    public function index()
    {
        $alamat = Alamat::where('user_id', Auth::id())->get();
        return view('alamat.index', compact('alamat'));
    }

    public function create()
    {
        return view('alamat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address_title' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        Alamat::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address_title' => $request->address_title,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'is_personal' => $request->has('is_personal'),
        ]);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alamat = Alamat::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('alamat.edit', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        $alamat = Alamat::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'first_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address_title' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        $alamat->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address_title' => $request->address_title,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'is_personal' => $request->has('is_personal'),
        ]);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alamat = Alamat::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $alamat->delete();

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus.');
    }
}
