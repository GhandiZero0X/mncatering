@extends('layout.layoutUser')

@section('contentUser')

    <!-- Page Header Start -->
    <div class="container-fluid mb-5" style="background-color: #ffc40c;">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3 text-white">Detail Snack</h1>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a href="/">Beranda</a></p>
                <p class="m-0 px-2 text-white">-</p>
                <p class="m-0 text-white">Detail Snack</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    @foreach ($data_snack as $d)
    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="/fotoSnack/{{ $d->gambar }}" alt="Image">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $d->nama_snack }}</h3>
                <h3 class="font-weight-semi-bold mb-4">Rp. {{ number_format($d->harga) }}</h3>
                <p class="mb-4">{{ $d->deskripsi }}.</p>

                <form method="POST" action="/keranjang/addToCart">
                    @csrf
                    <input type="hidden" name="id_snack" value="{{ $d->id }}">
                    <input type="hidden" name="id_pelanggan" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="gambar" value="{{ $d->gambar }}">
                    <input type="hidden" name="nama_snack" value="{{ $d->nama_snack }}">
                    <input type="hidden" name="harga" value="{{ $d->harga }}">

                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="qty" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Tambah Keranjang</button>
                </div>

                </form>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->
    @endforeach

    <hr/>

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Snack Lainnya</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($like_snack as $row)

                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img width="270" height="270" src="/fotoSnack/{{ $row->gambar }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $row->nama_snack }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>Rp. {{ number_format($row->harga) }}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="/detailshopUser/{{ $row->id }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                            <form method="POST" action="/keranjang/addToCart">
                                @csrf
                                <input type="hidden" name="id_snack" value="{{ $row->id }}">
                                <input type="hidden" name="id_pelanggan" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="gambar" value="{{ $row->gambar }}">
                                <input type="hidden" name="nama_snack" value="{{ $row->nama_snack }}">
                                <input type="hidden" name="harga" value="{{ $row->harga }}">
                                <input type="hidden" name="qty" value="1">

                                <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Tambah Keranjang</button>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection
