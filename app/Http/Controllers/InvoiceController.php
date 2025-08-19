<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate($id)
    {
        $pesanan = Pesanan::with('detail.menu')->findOrFail($id);
        $warung  = Warung::first();

        $pdf = Pdf::loadView('invoice', compact('pesanan', 'warung'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('invoice-'.$pesanan->tanggal_pesanan.'.pdf');
    }

}
