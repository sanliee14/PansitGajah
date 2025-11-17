<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('customer.home');
});

// =========================================================
// !! RUTE CUSTOMER YANG HILANG, KITA KEMBALIKAN !!
// =========================================================
Route::get('/cust/home', [CustomerController::class, 'dashboard'])->name('cust.home');
Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');
Route::get('/customer/order', [CustomerController::class, 'order'])->name('customer.order');
Route::get('/customer/fav', [CustomerController::class, 'fav'])->name('customer.fav');
Route::get('/customer/makanan', [CustomerController::class, 'makanan'])->name('customer.makanan');
Route::get('/customer/minuman', [CustomerController::class, 'minuman'])->name('customer.minuman');
Route::get('/customer/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
Route::get('/customer/qris', [CustomerController::class, 'qris'])->name('customer.qris');
Route::POST('/customer/proses', [CustomerController::class, 'proses'])->name('customer.proses');
// =========================================================


// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

// --- Rute Kasir ---

// Rute Login (Publik)
Route::get('/kasir/login', function () {
    return view('kasir.login');
})->name('kasir.loginForm');

Route::post('/kasir/login', [KasirController::class, 'login'])->name('kasir.login');

// Rute Kasir yang Dilindungi (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/kasir', function () {
        return redirect()->route('kasir.accpesanan'); 
    })->name('kasir.dashboard');

    Route::post('/kasir/logout', [KasirController::class, 'logout'])->name('kasir.logout');

    Route::get('/kasir/menu', [KasirController::class, 'menu'])->name('kasir.menu');
    Route::post('/kasir/menu/store', [KasirController::class, 'storeMenu'])->name('kasir.menu.store');
    
    Route::get('/kasir/accpesanan', [KasirController::class, 'accpesanan'])->name('kasir.accpesanan');
    Route::get('/kasir/history', [KasirController::class, 'history'])->name('kasir.history');
    
    // Rute untuk MENAMPILKAN halaman proses
    Route::get('/kasir/proses/{id_cart}', [KasirController::class, 'prosespesanan'])->name('kasir.prosespesanan');
    
    // !! INI ROUTE BARU YANG SAYA TAMBAHKAN (UNTUK TOMBOL FORM) !!
    Route::put('/kasir/selesaikan/{id_cart}', [KasirController::class, 'selesaikanPesanan'])->name('kasir.selesaikan');

    Route::get('/kasir/history/{id_cart}', [KasirController::class, 'detailhistory'])->name('kasir.history.detail');
});


// --- Rute Owner ---
Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
Route::get('/owner/laporan', [OwnerController::class, 'laporan'])->name('owner.laporan');
Route::get('/owner/product', [OwnerController::class, 'product'])->name('owner.product');
Route::get('/owner/tambahproduct', [OwnerController::class, 'tambahproduct'])->name('owner.tambahproduct');
// Route::post('/owner/tambahproduct', [OwnerController::class, 'upproduct'])->name('owner.tambahproduct');
Route::get('/owner/transaksi', [OwnerController::class, 'transaksi'])->name('owner.transaksi');
Route::get('/owner/laporan', [OwnerController::class, 'laporan'])->name('owner.laporan');