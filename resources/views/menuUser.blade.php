@extends('user.mainUser')

@section('title', 'Pilihan Menu ' . $kategori->nama_kategori)

@section('content-user')
<div class="container py-5 mt-5">
    <div class="alert alert-success text-center">
        <h2 class="text-center fw-bold">Pilihan Menu {{ $kategori->nama_kategori }}</h2>
    </div>
    
    <div class="row">
        @foreach ($menu as $item)
            <div class="mt-5 mb-2 col-lg-6 col-xl-4">
                <div class="card text-white" style="height: 50vh; overflow: hidden;">
                    @php
                        $flayerPath = asset('style/image/'.$warung->flayer);
                    @endphp
                    <img 
                        src="{{ $item->foto_menu ? asset('style/image/' .$item->foto_menu) : $flayerPath }}" 
                        class="card-img object-fit-cover" 
                        alt="{{ $item->nama_menu }}"
                        style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                    
                    <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: rgba(0, 0, 0, 0.3);">
                        <h5 class="fs-4 fw-bolder card-title" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                            {{ $item->nama_menu }}
                        </h5>
                        <p class="card-text" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                            {{ $item->deskripsi_menu }}
                        </p>
                        <p class="fs-5 card-text fw-bold" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                            @if($item->promo && $item->promo < $item->harga)
                                <span style="text-decoration: line-through; font-size:0.9em; color: #dc3545;">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </span>
                                <br>
                                <span class="ms-2">
                                    Rp {{ number_format($item->promo, 0, ',', '.') }}
                                </span>
                                <span class="badge bg-warning text-dark ms-2">Promo!</span>
                            @else
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            @endif
                        </p>
                        <form class="addToCartForm" action="{{ route('keranjang.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_menu" value="{{ $item->id_menu }}">
                            <button type="submit" class="fw-bold btn btn-light w-100" data-menu="{{ $item->nama_menu }}">
                                Pilih Menu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('submit', function(event) {
                if (event.target.classList.contains('addToCartForm')) {
                    event.preventDefault();
                    let formData = new FormData(event.target);
                    let menuName = event.target.querySelector('button').getAttribute('data-menu');

                    fetch(event.target.action, {
                        method: 'POST',
                        body: formData
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: `"${menuName}" ditambahkan ke keranjang!`,
                                timer: 3000,
                                showConfirmButton: false,
                                position: 'top',
                                toast: true
                            });
                        }
                    }).catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

</div>
@endsection