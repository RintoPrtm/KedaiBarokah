<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark rounded-1">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="{{ url('tampilUser') }}">{{ $warung->first()->nama_warung }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ url('tampilUser') }}">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ url('keranjang') }}">keranjang</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('pesanan') }}">Pesanan Saya</a>
                </li>
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn text-primary">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>