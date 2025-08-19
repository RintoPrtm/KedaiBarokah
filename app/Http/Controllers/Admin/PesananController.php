<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Detail;
use App\Models\Warung;
use App\Models\Pesanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananController extends Controller
{

    public function pesananAdmin()
    {
        $kategori = Kategori::all();
        $menu = Menu::all();
        $pesanan = Pesanan::all();
        $detail = Detail::all();
        $warung = Warung::first();

        return view('pesananAdmin', compact('kategori', 'menu', 'pesanan', 'detail', 'warung'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $data = $request->validate([
            'status' => 'required|in:Sudah Siap,Selesai',
        ]);


        $pesanan->update($data);
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

}
