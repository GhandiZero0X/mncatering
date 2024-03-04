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
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <br/><br/>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Silahkan Login !</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/cek_login" class="needs-validation">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email ..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password ..." required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                <p>Belum Punya Akun ? </p>
                                <a href="/register" class="btn btn-dark btn-lg btn-block">Daftar</a>
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
