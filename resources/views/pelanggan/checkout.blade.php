@extends('layout.layoutUser')

@section('contentUser')
    <!-- Page Header Start -->

    <div class="container-fluid mb-5" style="background-color: #ffc40c;">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3 text-white">Periksa Pesanan</h1>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a href="?view=dashboard">Beranda</a></p>
                <p class="m-0 px-2 text-white">-</p>
                <p class="m-0 text-white">Periksa Pesanan</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form method="POST" action="/checkout/store" enctype="multipart/form-data">
        @csrf
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Alamat Tagihan</h4>
                    <div class="row">

                        <input type="hidden" name="id_pelanggan" value="{{ Auth::user()->id }}" readonly>
                        <input type="hidden" name="no_transaksi" value="{{ $no_transaksi }}" readonly>
                        <input type="hidden" name="status" value="Belum DP" readonly>

                        <div class="col-md-4 form-group">
                            <label>Nama Lengkap</label>
                            <input class="form-control" type="text" value="{{ Auth::user()->nama_user }}" readonly>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>No Handphone</label>
                            <input class="form-control" type="text" value="{{ Auth::user()->nohp }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="5" readonly>{{ Auth::user()->alamat }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Catatan Pembeli</label>
                            <textarea class="form-control" rows="5" placeholder="Catatan Pembeli ..." name="catatan"></textarea>
                        </div>
                        <!-- <div class="col-md-4 form-group">
                            <label>Tgl Pesan</label>
                            <input type="date" class="form-control" name="tgl_pesan" required>
                        </div> -->
                        <div class="col-md-4 form-group">
                            <label>Tgl Pengambilan</label>
                            <input type="date" class="form-control" name="tgl_acara" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Waktu Pengambilan </label>
                            <input type="time" class="form-control" name="waktu_acara" required>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-6 form-group">
                            <!-- <label><b>Note</b></label><br>
                            <label>* Harap melakukan pemesanan H-4 acara</label>
                            <label>* Pesanan siap diambil 30 menit sebelum waktu acara</label> -->
                        </div>

                        <div id="form-input">

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Total Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Snack</h5>
                        @php $total = 0; $order = ''; $DP = 60/100; @endphp
                        @if(session('cart'))
                        @foreach(session('cart') as $items)
                        @if(Auth::user()->id == $items['id_pelanggan'])
                        @php $total += $items['harga'] * $items['qty'] @endphp
                        @php $order = '<button type="submit" name="simpan" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"><i class="fas fa-dollar-sign"></i> Pesan Sekarang</button>' @endphp

                        <div class="d-flex justify-content-between">
                            <p>{{ $items['nama_snack'] }} x{{ $items['qty'] }}</p>
                            <p>Rp. {{ number_format($items['harga'] * $items['qty']) }}</p>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">Rp. {{ number_format($total) }}</h5>
                            <input type="hidden" name="total_harga" value="{{ $total }}">
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="directcheck" checked>
                                <label class="custom-control-label" for="directcheck">Transfer Bank BNI</label>
                                <p>(0829726543 / MNC SNACK) </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="directcheck" checked>
                                <h7 class="font-weight-semi-bold m-0">BAYAR DP 60 % =</h7> Rp. {{ number_format($total * $DP) }}
                                <p> <i>DP maksimal 1 x 24 jam</i></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        @if(session('cart') == null)
                            <a href="/shopUser" class="btn btn-block btn-primary my-3 py-3"><i class="fa fa-shopping-cart"></i> Belanja Dulu</a>
                        @else
                            {!! $order !!}
                        @endif
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    <!-- Checkout End -->

@endsection


