<h2>Register</h2>
<form method="POST" action="/register">
    @csrf
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="no_telepon" placeholder="No Telepon"><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br>
    <button type="submit">Register</button>
</form>
<a href="/login">Sudah punya akun? Login</a>
