<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Detail;
use App\Models\Warung;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $menu = Menu::all();
        $pesanan = Pesanan::all();
        $detail = Detail::all();
        $warung = Warung::first();

        $menuPromo = \App\Models\Menu::whereNotNull('promo')
        ->whereColumn('promo', '<', 'harga')
        ->get();

        return view('main', compact('kategori', 'menu', 'pesanan', 'detail', 'warung', 'menuPromo'));
    }

    public function tampilUser()
    {
        $kategori = Kategori::all();
        $menu = Menu::all();
        $pesanan = Pesanan::all();
        $detail = Detail::all();
        $warung = Warung::first();

        $menuPromo = \App\Models\Menu::whereNotNull('promo')
        ->whereColumn('promo', '<', 'harga')
        ->get();


        return view('tampilUser', compact('kategori', 'menu', 'pesanan', 'detail', 'warung', 'menuPromo'));
    }

    public function warung()
    {
        $warung = Warung::first();

        return view('warung', compact('warung'));
    }

    public function warungUser()
    {
        $warung = Warung::first();

        return view('warungUser', compact('warung'));
    }

    public function menu($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $menu = Menu::where('id_kategori', $id_kategori)->get();
        $warung = Warung::first();

        return view('menu', compact('kategori', 'menu', 'warung'));
    }

        public function menuUser($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $menu = Menu::where('id_kategori', $id_kategori)->get();
        $warung = Warung::first();

        return view('menuUser', compact('kategori', 'menu', 'warung'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(main $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(main $main)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, main $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(main $main)
    {
        //
    }
}
