   <style>
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .nav-tabs {
        display: flex;
        justify-content: center;
        border-bottom: 1px solid #dee2e6;
    }

    .nav-tabs .nav-item {
        margin-right: 10px;
    }

    .nav-tabs .nav-link {
        padding: 10px 20px;
        border: 1px solid transparent;
        border-radius: 5px;
        background-color: #f8f9fa;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .nav-tabs .nav-link:hover {
        background-color: #e2e6ea;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .card-header {
        font-weight: bold;
        background-color: #f1f1f1;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 15px;
    }

    .card-body p, .card-body ul {
        margin-bottom: 10px;
    }

    .card-body ul {
        padding-left: 20px;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .alert-success {
        padding: 10px;
        margin-bottom: 20px;
        background-color: #d4edda;
        border-left: 5px solid #28a745;
        color: #155724;
        border-radius: 5px;
    }
</style>

   
   <div class="container">
        <h2>Lacak Pengiriman</h2>

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link {{ $status === 'diproses' ? 'active' : '' }}" href="{{ route('lacak.pengiriman', ['status' => 'diproses']) }}">Sedang diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status === 'dikirim' ? 'active' : '' }}" href="{{ route('lacak.pengiriman', ['status' => 'dikirim']) }}">Dikirim</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status === 'selesai' ? 'active' : '' }}" href="{{ route('lacak.pengiriman', ['status' => 'selesai']) }}">Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status === 'dibatalkan' ? 'active' : '' }}" href="{{ route('lacak.pengiriman', ['status' => 'dibatalkan']) }}">Dibatalkan</a>
            </li>
        </ul>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @foreach ($transaksis as $transaksi)
            <div class="card mb-3">
                <div class="card-header">
                    No. Transaksi: {{ $transaksi->id }}
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>

                    <ul>
                        @foreach ($transaksi->itemTransaksis as $item)
                            <li>
                                {{ $item->produk->nama }} - Rp{{ number_format($item->produk->harga) }}
                            </li>
                        @endforeach
                    </ul>

                    <p><strong>Total:</strong> Rp{{ number_format($transaksi->total_harga) }}</p>

                    @if ($transaksi->status === 'diproses')
                        <form action="{{ route('checkout.batal', $transaksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger mt-2">Cancel order</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>