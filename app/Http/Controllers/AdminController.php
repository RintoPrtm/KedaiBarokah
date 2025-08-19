<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Detail;
use App\Models\Warung;
use App\Models\Pesanan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        $kategori = Kategori::all();
        $menu = Menu::all();
        $pesanan = Pesanan::all();
        $detail = Detail::all();
        $warung = Warung::first();

        return view('admin', compact('kategori', 'menu', 'pesanan', 'detail', 'warung'));
    }
    

}
