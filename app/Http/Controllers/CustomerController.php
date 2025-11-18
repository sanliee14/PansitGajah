<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.home');
    }

    public function data()
    {
        return view('customer.data');
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_meja' => 'required|numeric|min:1',
        ]);

        Session::put('customer_nama', $request->nama);
        Session::put('customer_meja', $request->no_meja);

        return redirect()->route('customer.makanan');
    }


    public function order()
    {
        $products = DB::table('product')->get();
        return view('customer.order', ['products' => $products]);
    }

    public function fav()
    { 
        $products = DB::table('product')->get();
        return view('customer.fav', ['products' => $products]);
    }

    public function makanan()
    {
        $products = DB::table('product')->get();
        return view('customer.makanan', ['products' => $products]);
    }

    public function minuman()
    {
        $products = DB::table('product')->get();
        return view('customer.minuman', ['products' => $products]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = DB::table('product')->where('Id_Product', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                "nama" => $product->Nama_Product,
                "jumlah" => 1,
                "harga" => $product->Harga,
                "gambar" => null
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Berhasil ditambahkan ke keranjang!');
    }

    // !! FUNGSI UNTUK TOMBOL TAMBAH (+) DI CHECKOUT !!
    public function increaseCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
            Session::put('cart', $cart);
        }
        return redirect()->back();
    }

    // !! FUNGSI UNTUK TOMBOL KURANG (-) DI CHECKOUT !!
    public function decreaseCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['jumlah']--;
            if ($cart[$id]['jumlah'] <= 0) {
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
        }
        return redirect()->back();
    }

    // !! FUNGSI UNTUK TOMBOL HAPUS (X) DI CHECKOUT !!
    public function removeCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->back();
    }


    public function checkout() 
    {
        $cartItems = Session::get('cart', []);
        return view('customer.checkout', ['cartItems' => $cartItems]);
    }

    public function qris() 
    {
        return view('customer.qris');
    }

    public function proses(Request $request) 
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $cartItems = Session::get('cart');
        $namaCustomer = Session::get('customer_nama', 'Customer'); 
        $noMeja = (int) Session::get('customer_meja', 0);       

        if (!$cartItems || count($cartItems) == 0) {
            Log::error('Proses checkout gagal: Keranjang kosong.');
            return redirect()->route('customer.makanan')->with('error', 'Keranjang Anda kosong. Silakan pesan dulu.');
        }

        $subtotal = 0;
        foreach ($cartItems as $id => $details) {
            $subtotal += $details['harga'] * $details['jumlah'];
        }

        $path = $request->file('bukti_pembayaran')->store('public/bukti_pembayaran');
        
        try {
            // Memastikan Id_Kasir bisa NULL di DB 
            $id_cart = DB::table('cart')->insertGetId([
                'Id_Kasir' => null,
                'Nama' => $namaCustomer,
                'No_Meja' => $noMeja,
                'Subtotal' => $subtotal,
                'Status' => 'Diproses', 
            ]);

            $detailData = [];
            foreach ($cartItems as $id_product => $details) {
                $detailData[] = [
                    'Id_Cart' => $id_cart,
                    'Id_Product' => $id_product,
                    'Quantity' => $details['jumlah'],
                ];
            }
            DB::table('detail_cart')->insert($detailData);

            // Kosongkan keranjang setelah berhasil
            Session::forget('cart');
            Session::forget('customer_nama');
            Session::forget('customer_meja');

            // Ambil data untuk ditampilkan di halaman proses
            $order = DB::table('cart')->where('Id_Cart', $id_cart)->first();
            $items = DB::table('detail_cart')
                        ->join('product', 'detail_cart.Id_Product', '=', 'product.Id_Product')
                        ->where('detail_cart.Id_Cart', $id_cart)
                        ->select('product.Nama_Product', 'detail_cart.Quantity as jumlah', 'product.Harga')
                        ->get();

            return view('customer.proses', [
                'order' => $order,
                'items' => $items
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}