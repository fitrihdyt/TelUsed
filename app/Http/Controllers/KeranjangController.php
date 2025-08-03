<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        return view('keranjang.index', compact('keranjang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ],
            ['quantity' => $request->quantity]
        );

        return redirect()->route('keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $item = Keranjang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();
        return redirect()->route('keranjang.index')->with('success', 'Item dihapus dari keranjang.');
    }
}
