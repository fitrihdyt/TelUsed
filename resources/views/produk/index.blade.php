<div class="container">
    <h2>Daftar Produk</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $item)
                <tr>
                    <td>
                        @if ($item->foto)
                            <img src="{{ asset('images/' . $item->foto) }}" width="100" alt="Foto Produk">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('produk.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada produk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>