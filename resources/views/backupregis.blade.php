<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/all.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Register</h3>
                            </div>

                            <form method="POST" action="/register/store">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_user" placeholder="Nama Lengkap ..." required>
                                        </div>
                                        <div class="form-group">
                                            <label>No Handphone</label>
                                            <input type="number" class="form-control" name="nohp" placeholder="No Handphone ..." required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email ..." required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password ..." required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="5" placeholder="Alamat ..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
                            </div>
                            </form>
                            <div class="card-footer">
                                <p>Sudah Punya Akun ? </p>
                                <a href="/" class="btn btn-dark btn-lg btn-block">Masuk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  </div>

<!-- General JS Scripts -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.nicescroll.min.js"></script>
<script src="/assets/js/moment.min.js"></script>

<script src="/assets/js/sweetalert.min.js"></script>

<script src="/assets/js/stisla.js"></script>
<script src="/assets/js/scripts.js"></script>
<script src="/assets/js/custom.js"></script>

    @if (session('success'))
        <script>
            swal("SUCCESS","{{ session('success') }}","success")
        </script>
    @endif

    @if (session('error'))
        <script>
            swal("ERROR","{{ session('error') }}","error")
        </script>
    @endif

</body>
</html>
