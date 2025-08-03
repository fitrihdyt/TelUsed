<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alamat-box {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .alamat-box input[type="radio"] {
            display: none;
        }

        .alamat-box.selected {
            border-color: #dc3545;
            background-color: #fff3f3;
        }

        .produk-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .produk-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h3 class="mb-4">Checkout</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('checkout.selected.store') }}">
        @csrf

        <h5>Alamat Pengiriman:</h5>
        @if($alamats->count() > 0)
            <div class="mb-3">
                <select name="address_id" class="form-select" required>
                    <option value="">Pilih Alamat</option>
                    @foreach($alamats as $alamat)
                        <option value="{{ $alamat->id }}">
                            {{ $alamat->address_title }} - {{ $alamat->address }}, {{ $alamat->city }}, {{ $alamat->zip_code }}
                        </option>
                    @endforeach
                </select>

                <div class="mt-2 text-end">
                    <a href="{{ route('alamat.create') }}" class="btn btn-outline-secondary btn-sm">+ Tambah Alamat</a>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                Belum ada alamat. <a href="{{ route('alamat.index') }}">Klik di sini</a> untuk menambah.
            </div>
        @endif

        <h5 class="mt-4">Produk yang Dipilih:</h5>
        @if(count($keranjangs) > 0)
            <ul class="list-group mb-4">
                @foreach($keranjangs as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/' . $item->produk->foto) }}" class="produk-img rounded me-3" style="width: 80px; height: 80px; object-fit: cover;" alt="foto produk">
                            <div>
                                <strong>{{ $item->produk->nama_produk }}</strong><br>
                                <span class="text-danger fw-bold">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="btn btn-danger w-100">Proses Checkout</button>
        @else
            <div class="alert alert-info">Tidak ada produk yang dipilih. <a href="{{ route('keranjang.index') }}">Kembali ke Keranjang</a></div>
        @endif
    </form>
</div>
</body>
</html>
