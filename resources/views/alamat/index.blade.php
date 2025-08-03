<h2>Daftar Alamat</h2>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

<a href="{{ route('alamat.create') }}">Tambah Alamat Baru</a>

<ul>
    @foreach($alamat as $a)
        <li>
            <strong>{{ $a->first_name }} {{ $a->last_name }}</strong> - {{ $a->city }} ({{ $a->address_title }})
            <a href="{{ route('alamat.edit', $a->id) }}">Edit</a> |
            <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>
