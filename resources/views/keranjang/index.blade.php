<h2>Keranjang Belanja</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($keranjangs->count())
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keranjangs as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Keranjang kamu masih kosong.</p>
@endif
