@extends('user.mainUser')
@section('title', 'Pesanan Sukses')


@section('content-user')
<div class="container py-5 mt-2">
  {{-- Pesan Berhasil --}}
  <div class="text-center">
    <h1 class="display-4 fw-bolder text-success">BERHASIL!</h1>
    <p class="lead text-black-50">Pesanan Anda Sedang Diproses</p>
  </div>

  {{-- Total Harga --}}
  <div class="text-center mb-3">
    <h2 class="fw-bold text-primary">
      Total Harga Pesanan: 
      <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
    </h2>
  </div>

  {{-- Daftar Item Pesanan --}}
  @foreach($pesananSukses->detail as $item)

    <div class="card mb-3  shadow-sm">
      <div class="row g-0 align-items-center">

        {{-- Gambar Menu --}}
        <div class="col-auto p-3">
          <img src="{{ asset('style/image/'.$item->menu->foto_menu) }}"
                class="rounded"
                style="width:80px; height:80px; object-fit:cover;"
                alt="{{ $item->menu->nama_menu }}">
        </div>

        {{-- Info Menu --}}
        <div class="col px-3 py-2">
          <h5 class="mb-1">{{ $item->menu->nama_menu }}</h5>
          <p class="mb-1 text-secondary">{{ $item->menu->deskripsi_menu }}</p>

          <p class="mb-1 text-secondary">
            Harga:
            @if($item->menu->promo && $item->menu->promo < $item->menu->harga)
              <span style="text-decoration: line-through; color: #dc3545;">
                Rp {{ number_format($item->menu->harga, 0, ',', '.') }}
              </span>
              <br>
              <span style="color: #28a745;">
                Rp {{ number_format($item->menu->promo, 0, ',', '.') }}
              </span>
              <span class="badge bg-warning text-dark ms-2">Promo!</span>
            @else
              <strong>Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</strong>
            @endif
          </p>

          <p class="mb-1 text-secondary">
            Jumlah:
            <strong>{{ $item->jumlah }}</strong>
          </p>
          
        </div>

      </div>
    </div>
  @endforeach

  <div class="mt-4">
    <a href="{{ url('tampilUser') }}" class="btn btn-primary">
      &larr; Kembali
    </a>
  </div>
</div>
@endsection
