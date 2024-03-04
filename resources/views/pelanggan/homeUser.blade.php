@extends('layout.layoutUser')

@section('contentUser')

    <!-- Page Header Start -->
    @foreach ($data_apps as $q)
    <div class="container-fluid bg-secondary mb-5" style="background-image: url('fotoApps/{{ $q->banner }}');">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 227px;">
        </div>
    </div>
    @endforeach
    <!-- Page Header End -->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Kualitas Terjamin</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-solid fa-thumbs-up text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sesuai Selera</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-solid fa-certificate text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Halalan Toyyiban</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24 jam</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Katalog Snack</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($data_snack as $z)

            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img width="270" height="270" src="/fotoSnack/{{ $z->gambar }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $z->nama_snack }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>Rp. {{ number_format($z->harga) }}</h6><h6 class="text-muted ml-2">

                            </h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="/detailshopUser/{{ $z->id }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                        <form method="POST" action="/keranjang/addToCart">
                            @csrf
                            <input type="hidden" name="id_snack" value="{{ $z->id }}">
                            <input type="hidden" name="id_pelanggan" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="gambar" value="{{ $z->gambar }}">
                            <input type="hidden" name="nama_snack" value="{{ $z->nama_snack }}">
                            <input type="hidden" name="harga" value="{{ $z->harga }}">
                            <input type="hidden" name="qty" value="1">

                            <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Tambah Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <!-- Products End -->

@endsection
