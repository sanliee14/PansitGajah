<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function order()
    {
    return view('customer.order');
    // Kamu bisa ambil data dari form pakai:
    // $nama = $request->input('nama');
    // $meja = $request->input('meja');

    // lalu kirim ke view order.blade.php
    // return view('order', compact('nama', 'meja'));
    }

    public function fav()
    {
    return view('customer.fav');
    }

    public function makanan()
    {
    return view('customer.makanan');
    }

    public function minuman()
    {
    return view('customer.minuman');
    }

    public function checkout() 
    {
    return view('customer.checkout');
    }

    public function qris() 
    {
    return view('customer.qris');
    }

    public function proses() 
    {
    return view('customer.proses');
    }

    // public function profile()
    // {
    //     return view('customer.profile');
    // }
}
