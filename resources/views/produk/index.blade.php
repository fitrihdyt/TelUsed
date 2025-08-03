<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
            transition: background 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0069d9;
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th,
        .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .alert-success {
            background-color: #d4edda;
            border-left: 6px solid #28a745;
            padding: 10px;
            margin-bottom: 15px;
            color: #155724;
            border-radius: 5px;
        }

        img {
            border-radius: 5px;
            max-width: 100px;
            height: auto;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-center {
            text-align: center;
        }

        .d-inline {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Produk</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
        <table class="table table-bordered table-striped">
            <thead>
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
                                <img src="{{ asset('images/' . $item->foto) }}" alt="Foto Produk">
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
</body>
</html>
