<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/assetsUser/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/assetsUser/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assetsUser/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">

        <div class="row align-items-center py-3 px-xl-5" style="background-color: #961b06;">
            <div class="col-lg-4 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h2 class="m-0 display-5 font-weight-semi-bold"><span class="text-white font-weight-bold border px-3 mr-1">MNC</span><font color="white">SNACK</font></h2>
                </a>
            </div>
            <div class="col-lg-5 col-5 text-left">

            </div>
            <div class="col-lg-3 col-6 text-right">
                @if (Auth::user())
                <a href="/keranjang" class="btn border">
                    <i class="fas fa-shopping-cart text-white"></i>
                    <span class="badge">
                        <font color="white">Keranjang</font>
                    </span>
                </a>
                @else
                <a href="/login" class="btn border">
                    <i class="fas fa-shopping-cart text-white"></i>
                    <span class="badge"><font color="white">Keranjang</font></span>
                </a>
                @endif
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">


            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">MNC</span>SNACK</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        @if (Auth::user())

                        <div class="navbar-nav mr-auto py-0">
                            <a href="/homeUser" class="nav-item nav-link"><i class="fas fa-home"></i> Beranda</a>
                            <a href="/shopUser" class="nav-item nav-link"><i class="fas fa-shopping-cart"></i> Belanja</a>
                            <!-- <a href="/pembayaran" class="nav-item nav-link"><i class="fas fa-briefcase"></i> Pesanan</a> -->
                            <a href="/pesanan" class="nav-item nav-link"><i class="fas fa-solid fa-money-bill"></i> Pesanan</a>
                            
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                        <!-- <a href="/pelanggan" class="nav-item nav-link"><i class="fas fa-solid fa-user"></i> Profil</a> -->
                            <a href="/logout" class="nav-item nav-link"><i class="fas fa-lock"></i> Keluar</a>
                        </div>

                        @else

                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link"><i class="fas fa-home"></i> Beranda</a>
                            <a href="/shop" class="nav-item nav-link"><i class="fas fa-shopping-cart"></i> Belanja</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <a href="/login" class="nav-item nav-link"><i class="fas fa-sign-in-alt"></i> Masuk</a>
                        </div>

                        @endif

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('contentUser')


    <!-- Footer Start -->
    @foreach ($data_apps as $c)

    <div class="container-fluid text-dark mt-5 pt-5" style="background-color: #961b06;">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-12 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-white font-weight-bold border border-white px-3 mr-1">MNC</span>
                        <font color="white">SNACK</font></h1>
                </a>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i><font color="white">{{ $c->alamat_apps }}</font></p>
                <p class="mb-2"><i class="fa fa-envelope text-white mr-3"></i><font color="white">{{ $c->email_apps }}</font></p>
                <p class="mb-0"><i class="fa fa-phone-alt text-white mr-3"></i><font color="white">{{ $c->nohp_apps }}</font></p>
            </div>

        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                   <font color="white"> &copy;</font> <a class="text-dark font-weight-semi-bold text-white" href="#"><font color="white">{{ $c->nama_apps }}</font></a>. <font color="white">Desain oleh
                    </font>
                    <a class="text-dark font-weight-semi-bold text-white" href="#"><font color="white">{{ $c->nama_apps }}</font></a><br>
                    <!-- <font color="white">Distributed By</font> <a href="#" class="text-white" target="_blank"><font color="white">{{ $c->nama_apps }}</font></a> -->
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="/assetsUser/img/payments.png" alt="">
            </div>
        </div>
    </div>

    @endforeach
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/assetsUser/lib/easing/easing.min.js"></script>
    <script src="/assetsUser/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/assetsUser/mail/jqBootstrapValidation.min.js"></script>
    <script src="/assetsUser/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/assetsUser/js/main.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>

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
