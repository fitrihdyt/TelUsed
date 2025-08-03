<div class="container">
    <h2>Produk dalam Kategori: <strong>{{ $kategori->nama_kategori }}</strong></h2>

    @if($produk->isEmpty())
        <p>Tidak ada produk dalam kategori ini.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/produk/' . $item->foto) }}" alt="Foto Produk" width="100">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">← Kembali</a>
</div>
