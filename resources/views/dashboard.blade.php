<!DOCTYPE html>
<html>
<head>
    <title>Beranda - TelUsed</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #ccc;
        }

        .logo {
            font-weight: bold;
        }

        .search-bar {
            flex: 1;
            margin: 0 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .nav-icons form {
            display: inline;
        }

        .nav-icons button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
        }

        .banner {
            padding: 20px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .banner-text {
            max-width: 60%;
        }

        .categories {
            padding: 20px;
        }

        .categories h3 {
            margin-bottom: 10px;
        }

        .category-list {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .category-item {
            text-align: center;
            width: 100px;
        }

        .category-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #ccc;
        }

        .floating-btn {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background-color: #ccc;
            font-size: 30px;
            line-height: 50px;
            text-align: center;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Tel <span style="font-style: italic;">Used</span></div>
    <div class="search-bar">
        <input type="text" placeholder="Search our catalog..">
    </div>
    <div class="nav-icons">
        <a href="{{ route('keranjang.index') }}" title="Keranjang">🛒</a>
        <a href="{{ route('chat.index') }}" title="Pesan">💬</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" title="Logout">🚪</button>
        </form>
    </div>
</header>

<section class="banner">
    <div class="banner-text">
        <p>lagi nyari apa nih?</p>
        <h2>Laptop, Kamera, Alat Praktikum – Semua Ada!</h2>
        <p>Harga Miring, Barang Kece!</p>
    </div>
    <div class="banner-img">
        <img src="https://via.placeholder.com/150" alt="Laptop Image" width="150">
    </div>
</section>

<a href="{{ route('produk.create') }}" class="btn btn-secondary">Tambah Produk</a>

<section class="categories">
    <h3>Berbelanja dari <span style="font-weight: bold;">Kategori Terpopuler</span> ✨</h3>
    <div class="category-list">
        @isset($categories)
            @foreach($categories as $category)
                <div class="category-item">
                    <a href="{{ route('kategori.show', $category->id) }}">
                        <img src="https://via.placeholder.com/80" alt="{{ $category->nama_kategori }}">
                        <p>{{ $category->nama_kategori }}</p>
                    </a>
                </div>
            @endforeach
        @else
            <p>Belum ada kategori tersedia.</p>
        @endisset
    </div>
</section>

@auth
    @if(auth()->user()->level === 'admin')
        <a href="{{ route('produk.create') }}" class="floating-btn" title="Tambah Produk">+</a>
    @endif
@endauth

</body>
</html>
