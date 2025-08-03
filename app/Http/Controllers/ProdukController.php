<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produk = Produk::with('kategori')->get();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Kategori::all();
        return view('produk.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'nama_produk'   => 'required',
        'deskripsi'     => 'required',
        'harga'         => 'required|numeric',
        'qty'           => 'required|integer',
        'category_id'   => 'required|exists:categories,id',
        'foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('images'), $fotoName);
        }

        Produk::create([
            'nama_produk'  => $request->nama_produk,
            'deskripsi'    => $request->deskripsi,
            'harga'        => $request->harga,
            'qty'          => $request->qty,
            'category_id'  => $request->category_id,
            'foto'         => $fotoName,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
        $categories = Kategori::all();
        return view('produk.edit', compact('produk', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
        $request->validate([
        'nama_produk'   => 'required',
        'deskripsi'     => 'required',
        'harga'         => 'required|numeric',
        'qty'           => 'required|integer',
        'category_id'   => 'required|exists:categories,id',
        'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_produk', 'deskripsi', 'harga', 'qty', 'category_id']);

        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('images'), $fotoName);
            $data['foto'] = $fotoName;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
