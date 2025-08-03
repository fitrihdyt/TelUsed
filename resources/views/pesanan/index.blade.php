
<div class="container">
    <h2>Daftar Pesanan - Status: {{ $status }}</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($pesanan->isEmpty())
        <p>Tidak ada pesanan dengan status "{{ $status }}".</p>
    @else
        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>
                            <ul>
                                @foreach ($p->product as $item)
                                    <li>{{ $item->nama_produk }} (x{{ $item->pivot->jumlah }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $p->product->sum('pivot.jumlah') }}</td>
                        <td>{{ $p->status }}</td>
                        <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if (in_array($p->status, ['Belum dibayar', 'Sedang diproses']))
                                <form action="{{ route('pesanan.cancel', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Yakin batalkan pesanan ini?')">Batalkan</button>
                                </form>
                            @endif

                            @if ($p->status === 'Dikirim')
                                <form action="{{ route('pesanan.terima', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Saya Terima</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ route('pesanan.riwayat') }}">Lihat Riwayat Pesanan</a>
</div>
