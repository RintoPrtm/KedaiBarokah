<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Detail;
use App\Models\Warung;
use App\Models\Pesanan;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarungController extends Controller
{

    public function warungAdmin()
    {
        $kategori = Kategori::all();
        $menu = Menu::all();
        $pesanan = Pesanan::all();
        $detail = Detail::all();
        $warung = Warung::first();

        return view('warungAdmin', compact('kategori', 'menu', 'pesanan', 'detail', 'warung'));
    }
    
    public function update(Request $request, $id)
    {
        $warung = Warung::findOrFail($id);
    
        $validated = $request->validate([
            'nama_warung'      => 'required|string|max:255',
            'alamat_warung'    => 'required|string',
            'deskripsi_warung' => 'required|string',
            'foto_warung'      => 'image|mimes:jpg,jpeg,png|max:2048',
            'flayer'           => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_warung.required'      => 'Nama warung harus diisi.',
            'nama_warung.max'           => 'Nama warung maksimal 255 karakter.',
            'alamat_warung.required'    => 'Alamat warung harus diisi.',
            'deskripsi_warung.required' => 'Deskripsi warung harus diisi.',
            'foto_warung.image'         => 'Foto warung harus berupa gambar.',
            'foto_warung.mimes'         => 'Format foto warung harus jpg, jpeg, atau png.',
            'foto_warung.max'           => 'Ukuran foto warung maksimal 2MB.',
            'flayer.image'              => 'Flayer harus berupa gambar.',
            'flayer.mimes'              => 'Format flayer harus jpg, jpeg, atau png.',
            'flayer.max'                => 'Ukuran flayer maksimal 2MB.',
        ]);
    
        // Siapkan data teks
        $data = [
            'nama_warung'      => $validated['nama_warung'],
            'alamat_warung'    => $validated['alamat_warung'],
            'deskripsi_warung' => $validated['deskripsi_warung'],
        ];
    
        // Hapus & upload foto baru
        if ($request->hasFile('foto_warung')) {
            if ($warung->foto_warung && file_exists(public_path('style/image'.$warung->foto_warung))) {
                unlink(public_path('style/image'.$warung->foto_warung));
            }
            $file     = $request->file('foto_warung');
            $namaFoto = time().'_'.Str::random(8).'.'.$file->extension();
            $file->move(public_path('style/image'), $namaFoto);
            $data['foto_warung'] = $namaFoto;
        }
    
        // Hapus & upload flayer baru
        if ($request->hasFile('flayer')) {
            if ($warung->flayer && file_exists(public_path('style/image'.$warung->flayer))) {
                unlink(public_path('style/image'.$warung->flayer));
            }
            $file       = $request->file('flayer');
            $namaFlayer = time().'_'.Str::random(8).'.'.$file->extension();
            $file->move(public_path('style/image'), $namaFlayer);
            $data['flayer'] = $namaFlayer;
        }
    
        $warung->update($data);
    
        return back()->with('success','Informasi kedai berhasil diperbarui.');
    }
}
