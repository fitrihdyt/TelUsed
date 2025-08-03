<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\ItemTransaksi;
use App\Models\Alamat;
use App\Models\Produk;
use App\Models\Lacak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function selected(Request $request)
    {
        $user = Auth::user();

        $alamats = Alamat::where('user_id', $user->id)->get();
        $keranjangs = Keranjang::with('produk')->where('user_id', $user->id)->get();

        return view('checkout.selected', compact('alamats', 'keranjangs'));
    }

    public function storeSelected(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array',
            'address_id' => 'required|exists:address,id',
        ]);

        DB::beginTransaction();

        try {
            $keranjangs = Keranjang::with('produk')
                ->whereIn('id', $request->cart_ids)
                ->where('user_id', Auth::id())
                ->get();

            $total = 0;
            foreach ($keranjangs as $item) {
                if ($item->produk->qty < $item->quantity) {
                    throw new \Exception("Stok produk '{$item->produk->nama_produk}' tidak mencukupi.");
                }
                $total += $item->produk->harga * $item->quantity;
            }

            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'address_id' => $request->address_id,
                'total_harga' => $total,
                'status' => 'diproses'
            ]);

            foreach ($keranjangs as $item) {
                ItemTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'harga' => $item->produk->harga,
                ]);

                $item->produk->decrement('qty', $item->quantity);
            }

            Keranjang::whereIn('id', $request->cart_ids)->delete();

            Lacak::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'diproses'
            ]);

            DB::commit();
            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }

    public function lacakPengiriman(Request $request)
    {
        $status = $request->get('status', 'diproses');

        $transaksis = Transaksi::with('itemTransaksis.produk')
            ->where('user_id', Auth::id())
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('checkout.lacak', compact('transaksis', 'status'));
    }

    public function batalkan($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($transaksi->status === 'diproses') {
            $transaksi->status = 'dibatalkan';
            $transaksi->save();
        }

        return redirect()->route('lacak.pengiriman', ['status' => 'dibatalkan'])->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
