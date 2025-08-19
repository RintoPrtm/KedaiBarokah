<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Detail;
use App\Models\Warung;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        $warung = Warung::first();
        $pesanan = Pesanan::where('id_users', auth()->id())
            ->where('status', 'keranjang')
            ->with('detail.menu')
            ->first();

        // Jika keranjang kosong, tetapkan default
        if (!$pesanan) {
            $keranjangItems = collect([]);
            $totalHarga = 0;
        } else {
            $keranjangItems = $pesanan->detail ?? collect([]);
            $totalHarga = $pesanan->detail->sum(fn ($item) => $item->menu->effective_price * $item->jumlah);

        }

        return view('keranjang', compact('keranjangItems', 'warung', 'pesanan', 'totalHarga'));
    }

    public function add(Request $request)
    {
        $pesanan = Pesanan::firstOrCreate(
            ['id_users' => auth()->id(), 'status' => 'Keranjang'],
            ['tanggal_pesanan' => now()->toDateString(), 'jam_pesanan' => now()->toTimeString()]
        );

        $menu  = Menu::findOrFail($request->id_menu);
        $harga = $menu->effective_price;


        $detail = Detail::firstOrNew([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_menu'    => $menu->id_menu,
        ]);

        $detail->jumlah = $detail->exists 
        ? $detail->jumlah + 1 : 1;

        $detail->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function kurangi(Request $request)
    {
        $pesanan = Pesanan::where('id_users', auth()->id())->where('status', 'keranjang')->first();

        if (!$pesanan) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }
    
        $detail = Detail::where('id_pesanan', $pesanan->id_pesanan)
            ->where('id_menu', $request->id_menu)
            ->first();
    
        if ($detail && $detail->jumlah > 1) {
            $detail->update(['jumlah' => $detail->jumlah - 1]);
            return redirect()->back();
        }
    
        return redirect()->back();
    }



    public function checkout()
    {
        $pesanan = Pesanan::where('id_users', auth()->id())->where('status', 'keranjang')->first();

        if (!$pesanan) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $pesanan->update(['status' => 'Diproses']);

        return redirect()->route('pesanan.sukses', ['id_pesanan' => $pesanan->id_pesanan])->with('success', 'Pesanan berhasil diproses!');
    }

    public function pesananSukses($id_pesanan)
    {
        $warung = Warung::first();

        $pesananSukses = Pesanan::with('detail.menu')
        ->find($id_pesanan);

        if (!$pesananSukses) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        $totalHarga = $pesananSukses->detail->sum(function($item) {
            return $item->jumlah * $item->menu->effective_price;
        });


        return view('pesananSukses', compact('pesananSukses', 'warung', 'totalHarga'));
    }

    public function remove($id_detail)
    {
        $detail = Detail::findOrFail($id_detail);
        $id_pesanan = $detail->id_pesanan;
        $detail->delete();
        
        // Hapus pesanan jika sudah tidak ada detail lagi
        $remaining = Detail::where('id_pesanan', $id_pesanan)->count();
        if ($remaining == 0) {
            Pesanan::where('id_pesanan', $id_pesanan)->delete();
        }
    
        return redirect()->back();
        }

}
