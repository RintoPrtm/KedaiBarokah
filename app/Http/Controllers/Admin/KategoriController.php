<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Detail;
use App\Models\Warung;
use App\Models\Pesanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    // Tampilkan daftar kategori
    public function index()
    {
        $menu = Menu::all();
        $pesanan = Pesanan::all();
        $detail = Detail::all();
        $warung = Warung::first();
        $kategori = Kategori::all();
        return view('admin', compact('kategori', 'menu', 'pesanan', 'detail', 'warung'));
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah terpakai.',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->with('editKategoriId', $kategori->id_kategori)
                ->withInput();
        }


        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return back()->with('success', 'Kategori berhasil Diedit');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('success','Kategori dihapus');
    }

}
