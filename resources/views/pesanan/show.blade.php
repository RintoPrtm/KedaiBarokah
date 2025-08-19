@extends('user.mainUser')
@section('title', 'Detail Transaksi ')

@section('content-user')
<div class="container px-4 py-5 mt-5">

  {{-- Judul & Info Transaksi --}}
  <div class="mb-4">
    <h2 class="fw-bold">Detail Transaksi</h2>
    <p class="text-muted mb-1">
      {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y') }},
      {{ \Carbon\Carbon::parse($pesanan->jam_pesanan)->format('H:i') }}
    </p>
    <span class="badge {{ 
        $pesanan->status=='Diproses'   ? 'bg-primary' :
        ($pesanan->status=='Selesai'   ? 'bg-success' :
        ($pesanan->status=='Sudah Siap' ? 'bg-warning' : 'bg-danger'))
      }}">
      {{ $pesanan->status }}
    </span>
    <div class="text-end">
      @if($pesanan->status == 'Selesai')
        <a href="{{ route('invoice.generate', $pesanan->id_pesanan) }}"
           target="_blank"
           class="btn btn-success">
          <i class="bi bi-file-earmark-pdf"></i> Cetak Invoice
        </a>
      @endif
    </div>
  </div>

  @php
    // Hitung total seluruh item dengan harga promo jika ada
    $total = $pesanan->detail->reduce(function($carry, $item) {
        $unitPrice     = $item->menu->harga;
        $promoPrice    = $item->menu->promo;
        $effectivePrice = ($promoPrice && $promoPrice > 0)
                          ? $promoPrice
                          : $unitPrice;
        return $carry + ($effectivePrice * $item->jumlah);
    }, 0);
  @endphp

  {{-- Daftar Detail Menu --}}
  @foreach($pesanan->detail as $item)
    @php
      $unitPrice      = $item->menu->harga;
      $promoPrice     = $item->menu->promo;
      $effectivePrice = ($promoPrice && $promoPrice > 0)
                        ? $promoPrice
                        : $unitPrice;
      $subtotal       = $effectivePrice * $item->jumlah;
    @endphp

    <div class="card mb-3 shadow-sm">
      <div class="row g-0 align-items-center">

        {{-- Gambar Menu --}}
        <div class="col-auto p-3">
          <img src="{{ asset('style/image/' . $item->menu->foto_menu) }}"
               class="rounded"
               style="width: 80px; height: 80px; object-fit: cover;"
               alt="{{ $item->menu->nama_menu }}">
        </div>

        {{-- Info Menu --}}
        <div class="col px-3">
          <h5 class="mb-1">{{ $item->menu->nama_menu }}</h5>

          <p class="mb-1">
            Harga:&nbsp;
            @if($promoPrice && $promoPrice > 0)
              <span class="text-secondary text-decoration-line-through">
                Rp {{ number_format($unitPrice, 0, ',', '.') }}
              </span>
              <span class="ms-2 badge bg-success">
                Rp {{ number_format($promoPrice, 0, ',', '.') }}
              </span>
            @else
              Rp {{ number_format($unitPrice, 0, ',', '.') }}
            @endif
          </p>

          <p class="mb-1 text-secondary">
            Jumlah: {{ $item->jumlah }}
          </p>

          <p class="mb-0 fw-bold">
            Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
          </p>
        </div>
      </div>
    </div>
  @endforeach

  {{-- Total Keseluruhan --}}
  <div class="mb-4">
    <div class="card-body text-end fs-5 fw-bold">
      Total: Rp {{ number_format($total, 0, ',', '.') }}
    </div>
  </div>

  {{-- Tombol Kembali --}}
  <div class="mt-4">
    <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
      &larr; Kembali
    </a>
  </div>
</div>
@endsection