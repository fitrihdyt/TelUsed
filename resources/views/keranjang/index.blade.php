<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f3f0;
            padding: 30px;
            color: #212529;
        }

        h2 {
            margin-bottom: 25px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        th, td {
            text-align: left;
            padding: 15px;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 500;
            border-bottom: 1px solid #dee2e6;
        }

        tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        button,
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s ease-in-out;
            text-decoration: none;
        }

        button[type="submit"] {
            background-color: #dc3545;
            color: #fff;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #bb2d3b;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            margin-top: 10px;
            display: inline-block;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .actions-row {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h2>Keranjang Belanja</h2>

<form action="{{ route('checkout.selected') }}" method="GET">
    @csrf
    <table>
        <thead>
            <tr>
                <th>Pilih</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($keranjang as $item)
                <tr>
                    <td>
                        <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}">
                    </td>
                    <td>
                        @if($item->produk->foto)
                            <img src="{{ asset('images/' . $item->produk->foto) }}" alt="Foto Produk">
                        @endif
                        {{ $item->produk->nama_produk }}
                    </td>
                    <td>Rp{{ number_format($item->produk->harga) }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp{{ number_format($item->produk->harga * $item->jumlah) }}</td>
                    <td>
                        <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="6">Keranjang kamu kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($keranjang->count())
        <div class="actions-row">
            <button type="submit">Checkout Produk Terpilih</button>
            <a href="{{ route('alamat.index') }}" class="btn btn-secondary">Lihat Alamat</a>
        </div>
    @endif
</form>


</body>
</html>
