<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// 1. ROUTE LOGIN (Bisa diakses siapa saja)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

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