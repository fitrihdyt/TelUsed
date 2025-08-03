<div class="container py-4">
    <h2>Detail Produk</h2>

    <div class="card mb-4" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-4">
                @if($produk->foto)
                    <img src="{{ asset('images/' . $produk->foto) }}" class="img-fluid rounded-start" alt="Foto produk">
                @else
                    <img src="{{ asset('images/default.png') }}" class="img-fluid rounded-start" alt="Foto default">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                    <p class="card-text"><strong>Deskripsi:</strong><br>{{ $produk->deskripsi }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Stok:</strong> {{ $produk->qty }}</p>
                    <p class="card-text"><strong>Kategori:</strong> {{ $produk->kategori->nama_kategori ?? 'Tidak tersedia' }}</p>

                    <!-- Tombol aksi -->
                    <div class="d-flex gap-2 my-3">
                        <form action="{{ route('keranjang.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <input type="hidden" name="user_id" value="1"> {{-- Ganti manual untuk sekarang --}}
                            <input type="number" name="jumlah" value="1" min="1" class="form-control mb-2" style="width:100px;" required>
                            <button type="submit" class="btn btn-primary">Masukkan Keranjang</button>
                        </form>

                        <form action="/transaksi/beli" method="POST">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <input type="hidden" name="user_id" value="1"> {{-- Ganti manual --}}
                            <button type="submit" class="btn btn-success">Beli Sekarang</button>
                        </form>
                    </div>

                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Penjual -->
    <div class="border rounded p-3 d-flex justify-content-between align-items-center">
        <div>
            <a href="/chat/{{ $produk->id }}" class="btn btn-outline-primary me-2">Chat Sekarang</a>
            <a href="/toko/{{ $produk->id }}" class="btn btn-outline-dark">Kunjungi Toko</a>
        </div>
    </div>
</div>
