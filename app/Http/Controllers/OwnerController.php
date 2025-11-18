<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class OwnerController extends Controller
{
    public function dashboard()
    {
        return view('owner.dashboard');
    }

    public function product()
    {
        $products = DB::table('product')->orderByDesc('Id_Product')->get();
        return view('owner.product', compact('products'));
    }

    public function tambahproduct()
    {
        return view('owner.tambahproduct');
    }

    public function upproduct(Request $request)
    {
        
        $request->validate([
            'Nama_Product' => 'required|string|max:100',
            'Harga' => 'required|numeric|min:0',
            'Deskripsi' => 'nullable|string',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload gambar 
        $imagePath = null;
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $namaFile);
            $imagePath = 'uploads/product' . $namaFile;
        }

        // Simpan data ke tabel product
        DB::table('product')->insert([
            'Nama_Product' => $request->Nama_Product,
            'Harga' => $request->Harga,
            'Deskripsi' => $request->Deskripsi,
            'Image' => $imagePath,
        ]);

        // Kembali ke halaman produk
        return redirect()->route('owner.product')->with('success', 'Produk berhasil ditambahkan!');
    }

// Menampilkan form edit produk
public function editProduk($id)
{
    $product = \DB::table('product')->where('Id_Product', $id)->first();

    if (!$product) {
        return redirect()->route('owner.produk')->with('error', 'Produk tidak ditemukan!');
    }

    return view('owner.edit-produk', compact('product'));
}

// Proses update produk
public function updateProduk(Request $request, $id)
{
    $request->validate([
        'Nama_Product' => 'required|string|max:100',
        'Harga' => 'required|numeric|min:0',
        'Deskripsi' => 'nullable|string',
        'Image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    //data lama
    $product = \DB::table('product')->where('Id_Product', $id)->first();

    if (!$product) {
        return redirect()->route('owner.produk')->with('error', 'Produk tidak ditemukan!');
    }

    $imagePath = $product->Image; // default gambar lama

    // gambar baru 
    if ($request->hasFile('Image')) {
        $file = $request->file('Image');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/produk'), $namaFile);
        $imagePath = 'uploads/produk/' . $namaFile;
    }

    // Update data ke DB
    \DB::table('product')->where('Id_Product', $id)->update([
        'Nama_Product' => $request->Nama_Product,
        'Harga' => $request->Harga,
        'Deskripsi' => $request->Deskripsi,
        'Image' => $imagePath,
    ]);

    return redirect()->route('owner.produk')->with('success', 'Produk berhasil diperbarui!');
}

// Hapus produk
public function deleteProduk($id)
{
    // Cari data produk berdasarkan ID
    $product = \DB::table('product')->where('Id_Product', $id)->first();

    if (!$product) {
        return redirect()->route('owner.produk')->with('error', 'Produk tidak ditemukan!');
    }

    // Hapus gambar dari folder jika ada
    if ($product->Image && file_exists(public_path($product->Image))) {
        unlink(public_path($product->Image));
    }

    // Hapus data produk dari database
    \DB::table('product')->where('Id_Product', $id)->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('owner.produk')->with('success', 'Produk berhasil dihapus!');
}



    public function transaksi()
    {
    // Ambil data dari tabel transaksi 
    $transaksi = \DB::table('transaction_log')->orderByDesc('Id_Transaction_Log')->get();

    return view('owner.transaksi', compact('transaksi'));
    }

    public function laporan()
    {
    // Ambil total penjualan per tanggal dari tabel transaction_log
    $laporan = \DB::table('transaction_log')
        ->selectRaw('DATE(Tanggal_Transaksi) as tanggal, COUNT(*) as jumlah_transaksi, SUM(Total) as total_penjualan')
        ->groupBy('tanggal')
        ->orderByDesc('tanggal')
        ->get();

    // Data untuk Chart.js
    $labels = $laporan->pluck('tanggal');
    $totals = $laporan->pluck('total_penjualan');

    return view('owner.laporan', compact('laporan', 'labels', 'totals'));
}



}