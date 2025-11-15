<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard()
    {
        return view('owner.dashboard');
    }

    public function laporan()
    {
        return view('owner.laporan');
    }
}
