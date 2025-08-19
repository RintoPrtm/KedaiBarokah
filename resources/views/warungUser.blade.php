@extends('user.mainUser')

@section('title', 'Profile - ' . $warung->first()->nama_warung)

@section('content-user')
<header id="home"
        class="position-relative text-white d-flex justify-content-center align-items-center"
        style="
          background: 
            linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
            url('{{ asset('style/image/' . $warung->first()->foto_warung) }}') center/cover no-repeat;
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
          "{{ $warung->first()->deskripsi_warung }}"
        </p>
        <p class="fw-bold text-shadow-lg">
          Ririn Winarsih <span class="text-primary mx-1">/</span> Pendiri {{ $warung->first()->nama_warung }}
        </p>
      </div>
      <!-- Gambar Flayer -->
      <div class="col-12 col-lg-6">
        <div class="ratio ratio-16x9 rounded-3 shadow-sm overflow-hidden">
          <iframe class="w-100 h-100 object-fit-cover"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.5718194725787!2d106.89030616961966!3d-6.225802399610146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f342d1b5a275%3A0x4130dd2f5127cbb4!2sJl.%20Cipinang%20Muara%20Raya%20No.16%2C%20RT.16%2FRW.3%2C%20Cipinang%20Muara%2C%20Kecamatan%20Jatinegara%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013420!5e0!3m2!1sid!2sid!4v1753226582672!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
      </div>
    </div>
  </div>
</header>

<section class="py-5">
  <div class="container px-4">

    <div class="alert alert-info text-center mb-5">
      <h2 class="fw-bold">Street View</h2>
    </div>

    <div class="ratio ratio-16x9 shadow-lg rounded overflow-hidden">
      <iframe
        src="https://www.google.com/maps/embed?pb=!4v1753226210111!6m8!1m7!1sPmFUltY5ZSkeISDb0zRDHg!2m2!1d-6.225725350040537!2d106.890828856993!3f65.10771597438843!4f-16.859594270605157!5f1.526956901674862"
        class="w-100 h-100"
        style="border:0;"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

  </div>
</section>
@endsection