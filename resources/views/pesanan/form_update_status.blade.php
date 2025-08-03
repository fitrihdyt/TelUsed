<h2>Update Status Pesanan</h2>

<form method="POST" action="{{ route('pesanan.updateStatus', $pesanan->id) }}">
    @csrf
    @method('PUT')

    <label for="status">Status:</label>
    <select name="status" id="status">
        @foreach(['Belum dibayar', 'Sedang diproses', 'Dikirim', 'Received', 'Done', 'Canceled'] as $s)
            <option value="{{ $s }}" {{ $pesanan->status == $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>
