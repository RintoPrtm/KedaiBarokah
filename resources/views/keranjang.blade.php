@extends('user.mainUser')
@section('title', 'Keranjang Belanja')

@section('content-user')
<div class="container px-4 py-5 mt-5">
  {{-- Judul & Total Harga --}}
  <div class="alert alert-primary text-center">
      <h1>Keranjang Belanja</h1>
  </div>

  @if(count($keranjangItems))
    @foreach ($keranjangItems as $item)
      <div class="card mb-3 shadow-sm">
        <div class="row g-0 align-items-center">

          {{-- Gambar Menu --}}
          <div class="col-auto p-3">
            <img src="{{ asset('style/image/'.$item->menu->foto_menu) }}"
                  class="rounded"
                  style="width:80px; height:80px; object-fit:cover;"
                  alt="{{ $item->menu->nama_menu }}">
          </div>

          {{-- Info Menu --}}
          <div class="col px-3">
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
            <p class="mb-0 text-secondary">
              Jumlah: <strong>{{ $item->jumlah }}</strong>
            </p>
          </div>

          {{-- Kontrol (+ / – / Hapus) --}}
          <div class="col-auto pe-3 text-end">
            <form action="{{ route('keranjang.kurangi') }}" method="POST" class="d-inline">
              @csrf
              <input type="hidden" name="id_menu" value="{{ $item->menu->id_menu }}">
              <button type="submit" class="btn btn-outline-primary btn-sm me-1">–</button>
            </form>

            <form action="{{ route('keranjang.add') }}" method="POST" class="d-inline">
              @csrf
              <input type="hidden" name="id_menu" value="{{ $item->menu->id_menu }}">
              <button type="submit" class="btn btn-outline-primary btn-sm me-2">+</button>
            </form>

            <form action="{{ route('keranjang.remove', ['id_detail' => $item->id_detail]) }}"
                  method="POST"
                  class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger btn-sm">×</button>
            </form>
          </div>

        </div>
      </div>
    @endforeach

    <div class="mb-2">
      <div class="card-body text-end fs-5 fw-bold">
        Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}
      </div>
    </div>

    {{-- Button Checkout --}}
    <form action="{{ route('keranjang.checkout') }}" method="POST">
      @csrf
      <div class="text-center">
        <button type="submit" class="btn btn-success w-50 my-4">
          Check Out
        </button>
      </div>
    </form>

  @else
    <div class="alert alert-danger text-center mt-5">
      Oopps... Keranjang Anda masih kosong.
    </div>
  @endif
</div>
@endsection
