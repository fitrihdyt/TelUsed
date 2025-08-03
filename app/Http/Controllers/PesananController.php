<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'Belum dibayar');
        $pesanan = Pesanan::with('product')->where('status', $status)->get();

        return view('pesanan.index', compact('pesanan', 'status'));
    }

    public function cancel($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        if (in_array($pesanan->status, ['Belum dibayar', 'Sedang diproses'])) {
            $pesanan->status = 'Canceled';
            $pesanan->save();
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function riwayat()
    {
        $pesanan = Pesanan::with('product')->orderBy('created_at', 'desc')->get();
        return view('pesanan.riwayat', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $request->validate([
            'status' => 'required|in:Belum dibayar,Sedang diproses,Dikirim,Received,Done,Canceled',
        ]);

        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    public function konfirmasiDiterima($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        if ($pesanan->status === 'Dikirim') {
            $pesanan->status = 'Received';
            $pesanan->save();
        }

        return redirect()->back()->with('success', 'Pesanan dikonfirmasi diterima.');
    }
}
