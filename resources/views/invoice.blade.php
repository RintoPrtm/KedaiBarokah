<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $pesanan->id_pesanan }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; background: #f9f9f9; }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 32px 28px 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        h1 { text-align: center; margin-bottom: 0; font-size: 2rem; letter-spacing: 2px; }
        h2 { text-align: center; margin-top: 8px; margin-bottom: 24px; font-size: 1.2rem; color: #555; }
        .info {
            margin-bottom: 18px;
        }
        .info-table {
            border-collapse: collapse;
            display: inline-table;
            width: auto;
        }
        .info-table td {
            border: none;
            background: none;
            padding: 2px 4px;
            vertical-align: top;
            white-space: nowrap;
        }
        .info-table td:nth-child(2) {
            padding: 2px 2px;
            text-align: center;
            width: 1%;
        }

        table { width: 100%; border-collapse: collapse; margin: 18px 0 10px; }
        th, td { border: 1px solid #ccc; padding: 8px 10px; text-align: left; }
        th { background-color: #f0f0f0; }
        .total-row td { font-weight: bold; background: #f8f8f8; }
        .footer { margin-top: 36px; text-align: center; font-size: 13px; color: #888; }
        .text-decoration-line-through { text-decoration: line-through; }
        .badge-promo {
            display: inline-block;
            background: #28a745;
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>INVOICE</h1>
        <h2>{{ $warung->nama_warung }}</h2>

        <div class="info">
            <table class="info-table">
                <colgroup>
                    <col style="width: 130px;">
                    <col style="width:  10px;">
                    <col>
                </colgroup>
                <tr>
                    <td><strong>Nama Pelanggan</strong></td>
                    <td>:</td>
                    <td>{{ $pesanan->users->username }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Jam</strong></td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->jam_pesanan)->format('H:i') }}</td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td>:</td>
                    <td>{{ $pesanan->status }}</td>
                </tr>
            </table>
        </div>

        @php $total = 0; @endphp
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Harga Promo</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan->detail as $item)
                    @php
                        $unitPrice      = $item->menu->harga;
                        $promoPrice     = $item->menu->promo;
                        $effectivePrice = ($promoPrice && $promoPrice > 0) ? $promoPrice : $unitPrice;
                        $subtotal       = $effectivePrice * $item->jumlah;
                        $total         += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->menu->nama_menu }}</td>
                        <td>
                            @if($promoPrice && $promoPrice > 0)
                                <span class="text-secondary text-decoration-line-through">
                                    Rp {{ number_format($unitPrice, 0, ',', '.') }}
                                </span><br>
                            @else
                                Rp {{ number_format($unitPrice, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>
                            @if($promoPrice && $promoPrice > 0)
                                Rp {{ number_format($promoPrice, 0, ',', '.') }}
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">Total</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Terima kasih atas pesanan Anda.<br>
            <strong>{{ $warung->nama_warung }}</strong> — {{ $warung->alamat_warung }}
        </div>
    </div>
</body>
</html>