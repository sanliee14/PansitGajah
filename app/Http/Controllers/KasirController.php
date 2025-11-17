<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;             
use Illuminate\Support\Facades\Log; 

class KasirController extends Controller
{
    public function login(Request $request) 
    {
        // ... (Fungsi login) ...
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->role == 'kasir') {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended(route('kasir.accpesanan'));
            } else {
                return back()->withErrors([
                    'username' => 'Akun ini tidak memiliki akses kasir.',
                ])->onlyInput('username');
            }
        }
        return back()->withErrors([
            'username' => 'Username atau Password salah.',
        ])->onlyInput('username');
    }

    /**
     * Method untuk Logout
     */
    public function logout(Request $request)
    {
        // ... (Fungsi logout) ...
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('kasir.loginForm'));
    }

    /**
     * Menampilkan halaman manajemen menu (dari tabel 'product')
     */
    public function menu()
    {
        $menus = DB::table('product')->get(); 
        return view('kasir.menu', ['menus' => $menus]);
    }

    /**
     * Menyimpan menu baru ke tabel 'product'
     */
    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255', 
            'harga' => 'required|numeric|min:0',
        ]);
        
        DB::table('product')->insert([
            'Nama_Product' => $request->nama_menu, 
            'Harga' => $request->harga,
        ]);
        
        return redirect()->route('kasir.menu')->with('success', 'Menu berhasil ditambahkan.');
    }


    /**
     * Menampilkan halaman 'Akses Pesanan'
     */
    public function accpesanan()
    {
        $pesananMasuk = DB::table('cart')
                            ->whereRaw('LOWER(Status) = ?', ['diproses'])
                            ->orderBy('Id_Cart', 'asc')
                            ->get();
        return view('kasir.accpesanan', ['semuaPesanan' => $pesananMasuk]);
    }

    /**
     * Menampilkan halaman DETAIL 'Proses Pesanan'
     */
    public function prosespesanan($id_cart)
    {
        $order = DB::table('cart')->where('Id_Cart', $id_cart)->first();
        if (!$order) {
            return redirect()->route('kasir.accpesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $items = DB::table('detail_cart') 
                ->join('product', 'detail_cart.Id_Product', '=', 'product.Id_Product') 
                ->where('detail_cart.Id_Cart', $id_cart) 
                ->select('product.Nama_Product', 'detail_cart.Quantity as jumlah', 'product.Harga') 
                ->get();

        return view('kasir.prosespesanan', [
            'order' => $order, 
            'items' => $items
        ]);
    }

    /**
     * Memproses dan mengubah status pesanan menjadi 'selesai'.
     */
    public function selesaikanPesanan(Request $request, $id_cart)
    {
        $order = DB::table('cart')->where('Id_Cart', $id_cart)->first();

        if (!$order) {
            return back()->with('error', 'Pesanan tidak ditemukan.');
        }
        DB::table('cart')
            ->where('Id_Cart', $id_cart)
            ->update(['Status' => 'selesai']);

        return redirect()->route('kasir.accpesanan')
                         ->with('success', 'Pesanan #' . $id_cart . ' telah berhasil diselesaikan.');
    }


    /**
     * Menampilkan halaman 'History Pesanan'
     */
    public function history()
    {
        $pesananSelesai = DB::table('cart')
                            ->whereRaw('LOWER(Status) = ?', ['selesai'])
                            ->orderBy('Id_Cart', 'desc')
                            ->get();
        return view('kasir.history', ['orders' => $pesananSelesai]);
    }

    /**
     * Menampilkan halaman DETAIL 'History Pesanan'
     */
    public function detailhistory($id_cart)
    {
        $order = DB::table('cart')->where('Id_Cart', $id_cart)->first();
        if (!$order) {
            return redirect()->route('kasir.history')->with('error', 'History tidak ditemukan.');
        }

        $items = DB::table('detail_cart')
                ->join('product', 'detail_cart.Id_Product', '=', 'product.Id_Product') 
                ->where('detail_cart.Id_Cart', $id_cart) 
                ->select('product.Nama_Product', 'detail_cart.Quantity as jumlah', 'product.Harga')
                ->get();

        return view('kasir.detailhistory', [
            'order' => $order, 
            'items' => $items
        ]);
    }
    public function dashboard()
    {
        return redirect(route('kasir.accpesanan'));
    }

    public function transaksi()
    {
        return view('kasir.transaksi');
    }
}