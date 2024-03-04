<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="stylesheet" type="text/css" href="/assetLogin/login.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-color: #961b06;">
<div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                @foreach ($data_apps as $x)
                    <center><img src="/fotoApps/{{ $x->logo }}"></center>
                @endforeach
                <form method="POST" action="/cek_login" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <h3 class="mb-3 text-center heading">Silahkan Login !</h3>

                        <div class="form-group">
                            <label class="form-control-label text-muted">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label text-muted">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                        </div>

                        <div class="row justify-content-center my-3 px-3">
                            <button type="submit" class="btn-block btn-color">Masuk</button>
                            <a href="/" class="btn-block btn-color text-center">Kembali Ke Menu Awal</a>
                        </div>
                    </div>
                </div>
                </form>
                <div class="bottom text-center mb-3">
                    <p class="sm-text mx-auto mb-2">Belum Punya Akun ?<a href="/register" class="btn btn-white ml-2">Daftar</a></p>
                </div>
            </div>
            <div class="card card2">
                @foreach ($data_apps as $apps)
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white"></h3>
                    <h3 class="text-white">{{ $apps->nama_apps }}</h3>
                    <small class="text-white">{{ $apps->alamat_apps }}.</small>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
</body>
</html>
