<h2>Daftar Alamat</h2>

<a href="{{ route('alamat.create') }}" class="btn btn-primary mb-3">+ Tambah Alamat</a>

<ul>
@foreach($alamat as $a)
    <li style="margin-bottom: 10px;">
        <strong>{{ $a->address_title }}</strong> - {{ $a->address }} ({{ $a->city }})<br>
        <a href="{{ route('alamat.edit', $a->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

        <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus alamat ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
        </form>
    </li>
@endforeach
</ul>

<a href="{{ route('keranjang.index') }}" class="btn btn-secondary mt-4">← Kembali ke Keranjang</a>
