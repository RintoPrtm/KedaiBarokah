@extends('user.mainUser')
@section('title', 'Daftar Transaksi')

@section('content-user')
<div class="container px-4 py-5 mt-5">
  <div class="alert alert-primary text-center mb-4">
    <h1>Daftar Transaksi</h1>
  </div>

  @forelse($pesanan as $pesanan)
    @php
      $first = $pesanan->detail->first();
      $rest  = $pesanan->detail->count() - 1;
      $tanggal = Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y');
      $jam     = Carbon\Carbon::parse($pesanan->jam_pesanan)->format('H:i');
    @endphp

    <div class="card mb-3 shadow-sm">
      <div class="row g-0 align-items-center">
        
        {{-- Preview menu pertama --}}
        <div class="col-auto p-3">
          <img src="{{ asset('style/image/'.$first->menu->foto_menu) }}"
              class="rounded" 
              style="width: 80px; height:80px; object-fit:cover;"
              alt="{{ $first->menu->nama_menu }}">
        </div>

        <div class="col px-3">
          <div>
            <h5 class="mb-1">{{ $first->menu->nama_menu }} </h5>
            <p class="mb-1 text-secondary">
              Jumlah: {{ $first->jumlah }}
            </p>
          </div>
          <p class="mb-1 text-secondary">
            @if($rest > 0)
              +{{ $rest }} menu lainnya
            @endif
          </p>
          <p class="mb-0 small text-muted">
            {{ $tanggal }}, {{ $jam }}
            <span class="badge {{ $pesanan->status=='Diproses' ? 'bg-primary' : 
                ($pesanan->status=='Selesai' ? 'bg-success' : ($pesanan->status=='Sudah Siap' ? 'bg-warning' : 'bg-danger')) }}">
              {{ $pesanan->status }}
            </span>
          </p>
        </div>

        <div class="col-auto pe-3">
          <a href="{{ route('pesanan.show', $pesanan) }}"
              class="btn btn-outline-primary btn-sm">
            Detail
          </a>
        </div>

      </div>
    </div>

  @empty
    <div class="alert alert-info">
      Belum ada transaksi.
    </div>
  @endforelse
</div>
@endsection

