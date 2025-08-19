<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="{{ asset('style/css/panel.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 64px);" >
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                        <div class="card-body">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="text" name="username"  />
                                                    <label for="inputEmail">Username</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <a class="btn btn-outline-primary" href="{{ url('main') }}">Home</a>
                                                    <div class="d-grid"><button type="submit" class="btn btn-primary">
                                                        <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                                        Login
                                                    </button></div>
                                                </div>
                                            </form>
                                            @if ($errors->any())
                                                <div class="alert alert-danger mt-2">
                                                    @foreach ($errors->all() as $error)
                                                        <p>{{ $error }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer text-center py-3">
                                            <div class="small"><a href="{{ url('/register') }}">Tidak Punya Akun? Daftar Sekarang!</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('style/js/panel.js') }}"></script>
    </body>
</html>
