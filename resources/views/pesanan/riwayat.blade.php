
<div class="container">
    <h2>Riwayat Pesanan</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($pesanan->isEmpty())
        <p>Tidak ada riwayat pesanan.</p>
    @else
        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <ul>
                                @foreach ($p->product as $item)
                                    <li>{{ $item->nama_produk }} (x{{ $item->pivot->jumlah }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $p->status }}</td>
                        <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ route('pesanan.index') }}">Kembali ke Daftar Pesanan</a>
</div>
