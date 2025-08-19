<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Detail;
use App\Models\Warung;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananUserController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $detail = Detail::all();
        $warung = Warung::first();
        $pesanan = Auth::user()
            ->pesanan()
            ->with('detail.menu')
            ->orderByDesc('tanggal_pesanan')
            ->get();

        return view('pesanan.index', compact('warung','pesanan'));
    }

    public function show(Pesanan $pesanan)
    {
        $warung = Warung::first();
        if ($pesanan->id_users !== Auth::id()) {
            abort(403);
        }

        $pesanan->load('detail.menu');
        return view('pesanan.show', compact('warung','pesanan'));
    }
}
