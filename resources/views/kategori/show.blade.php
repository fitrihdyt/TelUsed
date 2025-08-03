<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk dalam Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-body small {
            color: gray;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .card-body h4 {
            font-size: 16px;
            margin: 0 0 10px 0;
        }

        .card-body .harga {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            background: #555;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background: #333;
        }

        .no-produk {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Produk dalam Kategori: <strong>{{ $kategori->nama_kategori }}</strong></h2>

        @if($produk->isEmpty())
            <div class="no-produk">
                <p>Tidak ada produk dalam kategori ini.</p>
            </div>
        @else
            <div class="produk-grid">
                @foreach($produk as $item)
                    <a href="{{ route('produk.show', $item->id) }}" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            @if($item->foto)
                                <img src="{{ asset('images/' . $item->foto) }}" alt="Foto Produk">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" alt="Tidak ada foto">
                            @endif
                            <div class="card-body">
                                <small>Sepatu</small>
                                <h4>{{ $item->nama_produk }}</h4>
                                <div class="harga">Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="btn">← Kembali</a>
    </div>
</body>
</html>
