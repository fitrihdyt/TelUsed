<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjangs = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        return view('keranjang.index', compact('keranjangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'produk_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::firstOrNew([
            'user_id' => Auth::id(),
            'produk_id' => $request->produk_id
        ]);

        $keranjang->jumlah += $request->jumlah;
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        //
        $item = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $item->delete();

        return redirect()->route('keranjang.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
