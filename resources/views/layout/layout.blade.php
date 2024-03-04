<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/font-awesome/css/all.css">


  <link rel="stylesheet" href="/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg nav-link-user">
                                <img alt="image" src="/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->nama_user }}</div>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="#">MNC CATERING</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="#">PJ</a>
                        </div>
                        @if (Auth::user()->role == 'admin')
                        <ul class="sidebar-menu">
                            <li class="menu-header">Dasbor</li>
                            <li>
                                <a class="nav-link" href="/home"><i class="fa fa-home"></i> <span>Dasbor</span></a>
                            </li>

                            <li class="menu-header">Menu</li>
                            <li>
                                <a class="nav-link" href="/aplikasi"><i class="fa fa-cogs"></i> <span>Pengaturan</span></a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link has-dropdown"><i class="fa fa-layer-group"></i><span>Data Master</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="/user">Data Admin</a></li>
                                    <li><a class="nav-link" href="/pelanggan">Data Pelanggan</a></li>
                                    <li><a class="nav-link" href="/snack">Data Snack</a></li>
                                </ul>
                            </li>

                            <li>
                                <a class="nav-link" href="/transaksi"><i class="fa fa-desktop"></i> <span>Data Transaksi</span></a>
                            </li>
                            <li>
                                <a class="nav-link" href="/laporan"><i class="fa fa-file"></i> <span>Data Laporan</span></a>
                            </li>
                            <li>
                                <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
                            </li>
                        </ul>
                        @endif
                    </aside>
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2023 <div class="bullet"></div> Desain oleh <a href="#">MNC SNACK</a>
                    </div>
                    <div class="footer-right">
                        2023
                    </div>
                </footer>
        </div>
    </div>

  <!-- General JS Scripts -->
  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/jquery.nicescroll.min.js"></script>
  <script src="/assets/js/moment.min.js"></script>

  <script src="/assets/js/jquery.dataTables.min.js"></script>
  <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/js/dataTables.select.min.js"></script>

  <script src="/assets/js/sweetalert.min.js"></script>

  <script src="/assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="/assets/js/scripts.js"></script>
  <script src="/assets/js/custom.js"></script>
  <script src="/assets/js/page/modules-datatables.js"></script>
  <script src="/assets/js/page/modules-sweetalert.js"></script>

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

  <script>
    $(document).ready(function() {
        $('#example').DataTable( {
            select: true
        });
    });
  </script>
</body>
</html>
