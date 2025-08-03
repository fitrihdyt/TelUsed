<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $produk->nama_produk }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .produk-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .produk-image {
            flex: 1;
            min-width: 280px;
        }

        .produk-image img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .produk-info {
            flex: 2;
            display: flex;
            flex-direction: column;
        }

        .produk-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .produk-info .harga {
            font-size: 28px;
            font-weight: bold;
            color: #e53935;
            background: #fcecec;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .produk-info .deskripsi {
            font-size: 16px;
            color: #333;
            margin-bottom: 25px;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .button-group form,
        .button-group a {
            display: inline-block;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-outline-primary {
            border: 1px solid #007bff;
            color: #007bff;
            background: white;
        }

        .btn-outline-dark {
            border: 1px solid #333;
            color: #333;
            background: white;
        }

        .stok {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .footer-actions {
            border-top: 1px solid #ddd;
            margin-top: 30px;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .footer-actions a {
            font-size: 14px;
        }

        input[type="number"] {
            width: 70px;
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="produk-wrapper">
            <div class="produk-image">
                @if($produk->foto)
                    <img src="{{ asset('images/' . $produk->foto) }}" alt="Foto produk">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Foto default">
                @endif
            </div>
            <div class="produk-info">
                <h1>{{ $produk->nama_produk }}</h1>
                <div class="harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                <div class="deskripsi">{{ $produk->deskripsi }}</div>

                <div class="stok">Stok: {{ $produk->qty }}</div>
                <div class="stok">Kategori: {{ $produk->kategori->nama_kategori ?? 'Tidak tersedia' }}</div>

                <div class="button-group" style="margin-top: 20px;">
                    @if ($produk->qty > 0)
                        <form action="{{ route('keranjang.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $produk->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            @if($produk->qty == 1)
                                <input type="hidden" name="quantity" value="1">
                                <p>Jumlah: 1 (stok terbatas)</p>
                            @else
                                <input type="number" name="quantity" value="1" min="1" max="{{ $produk->qty }}" required>
                            @endif
                            <button type="submit" class="btn btn-primary">Masukkan Keranjang</button>
                        </form>

                    @else
                        <p class="text-danger">Stok habis</p>
                    @endif

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </div>
        </div>

        <div class="footer-actions" style="margin-top: 40px;">
            <div>
                <a href="/chat/{{ $produk->id }}" class="btn btn-outline-primary">Chat Sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
