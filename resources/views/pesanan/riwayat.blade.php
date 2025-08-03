<h2>Riwayat Pesanan</h2>

@foreach ($pesanan as $item)
    <div style="border:1px solid #aaa; padding:10px; margin-bottom:10px;">
        @if($item->product && $item->product->foto)
            <img src="{{ asset('storage/' . $item->product->foto) }}" width="100">
        @endif
        <p><strong>{{ $item->product->nama_produk ?? 'Produk tidak ditemukan' }}</strong></p>
        <p>Status: {{ $item->status }}</p>
        <p>Total: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
        <p>Ukuran: {{ $item->size }}</p>
        <p>Dibuat pada: {{ $item->created_at->format('d M Y H:i') }}</p>
    </div>
@endforeach
