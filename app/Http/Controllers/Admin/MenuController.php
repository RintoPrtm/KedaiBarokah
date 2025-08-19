<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Warung;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $menu     = Menu::with('kategori')->get();
        $warung = Warung::first();
        return view('menuAdmin', compact('menu','kategori', 'warung'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu'   => 'required|unique:menu,nama_menu',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'harga'       => 'required|numeric|min:0',
            'promo'       => 'nullable|numeric|min:0|lte:harga',
            'deskripsi_menu' => 'nullable|string|max:255',
            'foto_menu'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_menu.required'   => 'Nama menu wajib diisi.',
            'nama_menu.unique'     => 'Nama menu sudah digunakan.',
            'id_kategori.required' => 'Pilih satu kategori.',
            'harga.required'       => 'Harga wajib diisi.',
            'promo.lte' => 'Harga promo tidak boleh lebih dari harga menu.',
            'deskripsi_menu.max' => 'Deskripsi maksimal 255 karakter.',
            'foto_menu.image'           => 'File harus berupa gambar.',
            'foto_menu.mimes'           => 'Format gambar harus JPG/JPEG/PNG.',
            'foto_menu.max'             => 'Ukuran maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto_menu')) {
            $file     = $request->file('foto_menu');
            $filename = time()
                        . '_' 
                        . Str::random(8) 
                        . '.' 
                        . $file->extension();
            $file->move(public_path('style/image'), $filename);
            $data['foto_menu'] = $filename;
        }



        Menu::create($data);
        return back()->with('success','Menu berhasil ditambahkan');
    }

    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu'   => [
                'required',
                Rule::unique('menu','nama_menu')
                    ->ignore($menu->id_menu,'id_menu'),
            ],
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'harga'       => 'required|numeric|min:0',
            'promo'       => 'nullable|numeric|min:0|lte:harga',
            'deskripsi_menu' => 'nullable|string|max:255',
            'foto_menu'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_menu.required'   => 'Nama menu wajib diisi.',
            'nama_menu.unique'     => 'Nama menu sudah digunakan.',
            'id_kategori.required' => 'Pilih satu kategori.',
            'id_kategori.exists'   => 'Kategori tidak valid.',
            'harga.required'       => 'Harga wajib diisi.',
            'promo.lte' => 'Harga promo tidak boleh lebih dari harga menu.',
            'deskripsi_menu.max' => 'Deskripsi maksimal 255 karakter.',
            'foto_menu.image'      => 'File harus berupa gambar.',
            'foto_menu.mimes'      => 'Format: JPG, JPEG, PNG.',
            'foto_menu.max'        => 'Ukuran maksimal 2 MB.',
        ]);

        // 2) Cek validasi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->with('editMenuId', $menu->id_menu)
                ->withInput();
        }

        // 3) Ambil data yang lolos validasi
        $data = $validator->validated();

        // 4) Handle upload baru
        if ($request->hasFile('foto_menu')) {
            // hapus file lama
            $old = public_path('style/image/'.$menu->foto_menu);
            if ($menu->foto_menu && file_exists($old)) {
                unlink($old);
            }

            // simpan file baru
            $file     = $request->file('foto_menu');
            $filename = time().'_'.Str::random(8).'.'.$file->extension();
            $file->move(public_path('style/image'), $filename);

            // simpan **nama** file saja
            $data['foto_menu'] = $filename;
        }

        // 5) Update record sekaligus
        $menu->update($data);

        return back()->with('success','Menu berhasil diperbarui');
    }


    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success','Menu berhasil dihapus');
    }

}
