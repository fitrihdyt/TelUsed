<h2>Lacak Pengiriman</h2>

<nav>
    @foreach(['Belum dibayar', 'Sedang diproses', 'Dikirim', 'Received', 'Done'] as $s)
        <a href="{{ route('pesanan.index', ['status' => $s]) }}"
           style="{{ $status == $s ? 'font-weight:bold;' : '' }}">{{ $s }}</a> |
    @endforeach
</nav>

<br>
@foreach ($pesanan as $item)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        @if($item->product && $item->product->foto)
            <img src="{{ asset('storage/' . $item->product->foto) }}" width="100" alt="gambar produk">
        @endif
        <p><strong>{{ $item->product->nama_produk ?? 'Produk tidak tersedia' }}</strong></p>
        <p>Ukuran: {{ $item->size }}</p>
        <p>Harga: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
        @if ($item->shipment_info)
            <p>Status Pengiriman: {{ $item->shipment_info }}</p>
        @endif
        @if ($item->shipment_estimate)
            <p>Estimasi Pengiriman: {{ $item->shipment_estimate }}</p>
        @endif
        <p><strong>Total: Rp{{ number_format($item->price, 0, ',', '.') }}</strong></p>

        @if (in_array($item->status, ['Belum dibayar', 'Sedang diproses']))
            <form method="POST" action="{{ route('pesanan.cancel', $item->id) }}">
                @csrf
                <button type="submit">Cancel Order</button>
            </form>
        @endif

        @if ($item->status === 'Dikirim')
            <form method="POST" action="{{ route('pesanan.konfirmasi', $item->id) }}">
                @csrf
                <button type="submit">Barang Diterima</button>
            </form>
        @endif
    </div>
@endforeach
