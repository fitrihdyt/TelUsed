<h2>Login</h2>
<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<a href="/register">Belum punya akun? Register</a>
