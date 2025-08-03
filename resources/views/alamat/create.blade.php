<h2>Tambah Alamat</h2>
<form method="POST" action="{{ route('alamat.store') }}">
    @csrf
    <input type="text" name="first_name" placeholder="Nama Depan" required><br>
    <input type="text" name="last_name" placeholder="Nama Belakang"><br>
    <input type="text" name="phone" placeholder="Nomor HP" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="address_title" placeholder="Judul Alamat (misal: Rumah)" required><br>
    <input type="text" name="address" placeholder="Alamat" required><br>
    <input type="text" name="address2" placeholder="Alamat Tambahan"><br>
    <input type="text" name="city" placeholder="Kota" required><br>
    <input type="text" name="zip_code" placeholder="Kode Pos" required><br>
    <label><input type="checkbox" name="is_personal"> Alamat Pribadi</label><br>
    <button type="submit">Simpan</button>
</form>
