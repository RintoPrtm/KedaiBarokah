@extends('user.mainUser')


@section('title', 'Home - ' . $warung->first()->nama_warung)

@section('content-user')
<header id="home"
        class="position-relative text-white d-flex justify-content-center align-items-center"
        style="
          background: 
            linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
            url('{{ asset('style/background/background.jpg') }}') center/cover no-repeat;
          min-height: 80vh;
          padding: 64px 0;
        ">
  <div class="container px-4 text-center text-lg-start">
    <div class="row gx-5 justify-content-center align-items-center">
      
      <!-- Teks Kedai -->
      <div class="col-12 col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-5 fw-bolder mb-3"
            style="text-shadow: 2px 2px 6px rgba(0,0,0,0.7);">
          {{ $warung->first()->nama_warung }}
        </h1>
        <p class="lead mb-4 text-white-75"
            style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">
          {{ $warung->first()->alamat_warung }}
        </p>
        <a href="{{ url('warungUser') }}" class="btn btn-primary btn-lg px-4">
          Selengkapnya
        </a>
      </div>
      
      <!-- Gambar Flayer -->
      <div class="col-12 col-lg-6">
        <div class="ratio ratio-16x9 rounded-3 shadow-sm overflow-hidden">
          <img src="{{ asset('style/image/' . $warung->first()->flayer) }}"
                class="w-100 h-100 object-fit-cover"
                alt="Gambar Warung">
        </div>
      </div>
      
    </div>
  </div>
</header>

<section id="kategori" class="py-5">
  <div class="container px-4 my-4">
    <div class="alert alert-primary text-center mb-4">
      <h2 class="text-center">Mau makan apa hari ini?</h2>
    </div>
    @if(isset($menuPromo) && $menuPromo->count())
      <div class="mb-4">
        <div class="alert alert-warning text-center fw-bold">
          PROMO HARI INI!
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
          @foreach($menuPromo as $promo)
            <div class="col">
              <div class="card text-white" style="height: 50vh; overflow: hidden;">
                @php
                  $flayerPath = asset('style/image/'.$warung->first()->flayer);
                @endphp
                <img 
                  src="{{ $promo->foto_menu ? asset('style/image/' .$promo->foto_menu) : $flayerPath }}" 
                  class="card-img object-fit-cover" 
                  alt="{{ $promo->nama_menu }}"
                  style="height: 100%; width: 100%; object-fit: cover; object-position: center;">

                <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: rgba(0, 0, 0, 0.3);">
                  <h5 class="fs-4 fw-bolder card-title" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                    {{ $promo->nama_menu }}
                  </h5>
                  <p class="card-text" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                    {{ $promo->deskripsi_menu }}
                  </p>
                  <p class="fs-5 card-text fw-bold" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                    <span style="text-decoration: line-through; font-size:0.9em; color: #dc3545;">
                      Rp {{ number_format($promo->harga, 0, ',', '.') }}
                    </span>
                    <br>
                    <span class="ms-2">
                      Rp {{ number_format($promo->promo, 0, ',', '.') }}
                    </span>
                    <span class="badge bg-warning text-dark ms-2">Promo!</span>
                  </p>
                  <a href="{{ url('/kategoriUser/'.$promo->id_kategori) }}" class="btn btn-light mt-2">
                      Lihat Menu
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
    <div class="alert alert-primary text-center fw-bold">
      DAFTAR KATEGORI
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach ($kategori as $item)
        <div class="col">
          <div class="card h-100 text-center border-2 shadow">
            <div class="card-body d-flex flex-column justify-content-between">
              
              <h3 class="card-title display-6 fw-bolder mb-4">
                {{ $item->nama_kategori }}
              </h3>
              
              <a href="{{ url('/kategoriUser/'.$item->id_kategori) }}"
                  class="btn btn-outline-primary mt-auto">
                Lihat Menu
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection