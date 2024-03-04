@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Dasbor</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="#">Dasbor</a></div>
            <div class="breadcrumb-item">Dasbor</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            @if($count_refund > 0)
                <audio hidden autoplay>
                    <source src="/assets/audio/notifikasi2.mp3" type="audio/mpeg">
                </audio>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <a href="/transaksi">
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Refund Uang Pelanggan ({{ $count_refund }})</div>
                    </a>
                </div>
            @endif

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_pelanggan }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Snack</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_snack }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_transaksi }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi Lunas</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_lunas }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Belum DP</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_belumdp }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Di Proses</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_proses }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Belum Lunas</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_belumlunas }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Di Tolak</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_tolak }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Selesai Refund</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_selesai }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>

@endsection
