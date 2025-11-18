<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;


Route::get('/', function () {
    return view('customer.home');
});

Route::get('/cust/home', [CustomerController::class, 'dashboard'])->name('cust.home');
Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');

// Route untuk menyimpan Nama & No Meja
Route::post('/customer/data/store', [CustomerController::class, 'storeData'])->name('customer.data.store');

Route::get('/customer/order', [CustomerController::class, 'order'])->name('customer.order');
Route::get('/customer/fav', [CustomerController::class, 'fav'])->name('customer.fav');
Route::get('/customer/makanan', [CustomerController::class, 'makanan'])->name('customer.makanan');
Route::get('/customer/minuman', [CustomerController::class, 'minuman'])->name('customer.minuman');

// Route untuk tombol "Pesan"
Route::post('/customer/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
Route::post('/customer/cart/increase/{id}', [CustomerController::class, 'increaseCart'])->name('customer.cart.increase');
Route::post('/customer/cart/decrease/{id}', [CustomerController::class, 'decreaseCart'])->name('customer.cart.decrease');
Route::post('/customer/cart/remove/{id}', [CustomerController::class, 'removeCart'])->name('customer.cart.remove');


Route::get('/customer/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
Route::get('/customer/qris', [CustomerController::class, 'qris'])->name('customer.qris');

Route::post('/customer/proses', [CustomerController::class, 'proses'])->name('customer.proses');


// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

// --- Route Kasir ---

// Route Login (Publik)
Route::get('/kasir/login', function () {
    return view('kasir.login');
})->name('kasir.loginForm');

Route::post('/kasir/login', [KasirController::class, 'login'])->name('kasir.login');

Route::middleware(['auth'])->group(function () {
    
    // Route untuk Edit Menu
Route::get('/kasir/menu/edit/{id}', [App\Http\Controllers\KasirController::class, 'editMenu'])->name('kasir.editMenu');
Route::put('/kasir/menu/update/{id}', [App\Http\Controllers\KasirController::class, 'updateMenu'])->name('kasir.updateMenu');

// Route untuk Hapus Menu
Route::delete('/kasir/menu/delete/{id}', [App\Http\Controllers\KasirController::class, 'deleteMenu'])->name('kasir.deleteMenu');

    Route::get('/kasir', function () {
        return redirect()->route('kasir.accpesanan'); 
    })->name('kasir.dashboard');

    Route::post('/kasir/logout', [KasirController::class, 'logout'])->name('kasir.logout');

    Route::get('/kasir/menu', [KasirController::class, 'menu'])->name('kasir.menu');
    Route::post('/kasir/menu/store', [KasirController::class, 'storeMenu'])->name('kasir.menu.store');
    
    Route::get('/kasir/accpesanan', [KasirController::class, 'accpesanan'])->name('kasir.accpesanan');
    Route::get('/kasir/history', [KasirController::class, 'history'])->name('kasir.history');
    
    // Route untuk MENAMPILKAN halaman proses
    Route::get('/kasir/proses/{id_cart}', [KasirController::class, 'prosespesanan'])->name('kasir.prosespesanan');
    
    // Route untuk MEMPROSES tombol "Selesaikan Pesanan"
    Route::put('/kasir/selesaikan/{id_cart}', [KasirController::class, 'selesaikanPesanan'])->name('kasir.selesaikan');

    Route::get('/kasir/history/{id_cart}', [KasirController::class, 'detailhistory'])->name('kasir.history.detail');

    Route::get('/kasir/menu/edit/{id}', [App\Http\Controllers\KasirController::class, 'editMenu'])->name('kasir.editMenu');
    Route::put('/kasir/menu/update/{id}', [App\Http\Controllers\KasirController::class, 'updateMenu'])->name('kasir.updateMenu');
    Route::delete('/kasir/menu/delete/{id}', [App\Http\Controllers\KasirController::class, 'deleteMenu'])->name('kasir.deleteMenu');
});


// --- Rute Owner ---
Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
Route::get('/owner/laporan', [OwnerController::class, 'laporan'])->name('owner.laporan');
Route::get('/owner/product', [OwnerController::class, 'product'])->name('owner.product');
Route::get('/owner/tambahproduct', [OwnerController::class, 'tambahproduct'])->name('owner.tambahproduct');
Route::get('/owner/transaksi', [OwnerController::class, 'transaksi'])->name('owner.transaksi');
Route::get('/owner/laporan', [OwnerController::class, 'laporan'])->name('owner.laporan');
Route::get('/owner/edit-produk/{id}', [OwnerController::class, 'editProduk'])->name('owner.edit');
Route::delete('/owner/delete-produk/{id}', [OwnerController::class, 'deleteProduk'])->name('owner.delete');
Route::put('/owner/update-produk/{id}', [OwnerController::class, 'updateProduk'])->name('owner.update');
