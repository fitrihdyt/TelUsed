<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $alamat = Alamat::all();
        return view('alamat.index', compact('alamat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('alamat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email|max:255',
            'address_title'  => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'address2'       => 'nullable|string|max:255',
            'city'           => 'required|string|max:100',
            'zip_code'       => 'required|string|max:20',
            'is_personal'    => 'nullable|boolean',
        ]);

        $validated['is_personal'] = $request->has('is_personal');

        Alamat::create($validated);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alamat $alamat)
    {
        //
        return view('alamat.show', compact('alamat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alamat $alamat)
    {
        //
        return view('alamat.edit', compact('alamat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alamat $alamat)
    {
        //
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email|max:255',
            'address_title'  => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'address2'       => 'nullable|string|max:255',
            'city'           => 'required|string|max:100',
            'zip_code'       => 'required|string|max:20',
            'is_personal'    => 'nullable|boolean',
        ]);

        $validated['is_personal'] = $request->has('is_personal');

        $alamat->update($validated);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alamat $alamat)
    {
        //
        $alamat->delete();
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus!');
    }
}
