<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

// 1. ROUTE AUTH (Bisa diakses siapa saja)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Redirect halaman utama ke welcome
Route::get('/', function () {
    return view('welcome');
});

// 3. ROUTE GANTI BAHASA (ID / EN)
Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back()->cookie('locale', $locale, 60 * 24 * 365);
})->name('language');

// 2. ROUTE ADMIN (WAJIB LOGIN / TERPROTEKSI)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
// Routes Pesanan
Route::resource('pesanan', \App\Http\Controllers\Admin\PesananController::class);
    Route::get('/produk', function () { return view('admin.produk.index'); })->name('produk');
    Route::get('/pembayaran', function () { return view('admin.pembayaran.index'); })->name('pembayaran');
    Route::get('/pengiriman', function () { return view('layouts.admin'); })->name('pengiriman');
    Route::get('/stok', function () { return view('layouts.admin'); })->name('stok');
    Route::get('/pelanggan', function () { return view('layouts.admin'); })->name('pelanggan');
    Route::get('/return', function () { return view('layouts.admin'); })->name('return');
});