@extends('layout.layoutUser')

@section('contentUser')

    <!-- Page Header Start -->
    <div class="container-fluid mb-5" style="background-color: #ffc40c;">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3 text-white">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a href="/">Home</a></p>
                <p class="m-0 px-2 text-white">-</p>
                <p class="m-0 text-white">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Our Shop</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($data_snack as $d)

            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img width="270" height="270" src="/fotoSnack/{{ $d->gambar }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $d->nama_snack }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>Rp. {{ number_format($d->harga) }}</h6><h6 class="text-muted ml-2">

                            </h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="/detailshop/{{ $d->id }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="/login" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <!-- Products End -->

    <ul class="pagination justify-content-center">
        {!! $data_snack->links() !!}
    </ul>

@endsection
