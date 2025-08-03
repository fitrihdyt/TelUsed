<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-admin', [AdminController::class, 'index'])->middleware('admin');

Route::middleware('auth')->group(function () {
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::resource('produk', ProdukController::class);
    Route::resource('keranjang', KeranjangController::class);
    Route::resource('alamat', AlamatController::class);
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::put('/pesanan/{id}/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');
    Route::put('/pesanan/{id}/terima', [PesananController::class, 'konfirmasiDiterima'])->name('pesanan.terima');
    Route::get('/pesanan/riwayat', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user_id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversation_id}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/selected', [CheckoutController::class, 'selected'])->name('checkout.selected');
    Route::post('/checkout/selected', [CheckoutController::class, 'storeSelected'])->name('checkout.selected.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/lacak', [CheckoutController::class, 'lacakPengiriman'])->name('lacak.pengiriman');
    Route::put('/checkout/batal/{id}', [CheckoutController::class, 'batalkan'])->name('checkout.batal');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
