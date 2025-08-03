<div class="container">
    <h2>Edit Produk</h2>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Produk</label><br>
            @if($produk->foto)
                <img src="{{ asset('images/' . $produk->foto) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="foto" class="form-control" id="foto">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
        </div>

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="{{ $produk->nama_produk }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" required>{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" id="harga" step="0.01" value="{{ $produk->harga }}" required>
        </div>

        <div class="mb-3">
            <label for="qty" class="form-label">Jumlah (Qty)</label>
            <input type="number" name="qty" class="form-control" id="qty" value="{{ $produk->qty }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $produk->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>