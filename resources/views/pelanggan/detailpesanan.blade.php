@extends('layout.layoutUser')

@section('contentUser')

    <!-- Page Header Start -->
    <div class="container-fluid mb-5" style="background-color: #ffc40c;">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3 text-white">Detail Pesanan</h1>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a href="/homeUser">Beranda</a></p>
                <p class="m-0 px-2 text-white">-</p>
                <p class="m-0 text-white">Detail Pesanan</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Detail Pesanan</span></h2>
        </div>
        @foreach ($data_transaksi as $row)

        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5">
                <div class="contact-form">
                    <div class="table-responsive">
                        <table class="table">
                        @php $DP = 60/100; $LUNAS = 40 / 100; @endphp
                            <tr>
                                <td>No Transaksi</td>
                                <td>: {{ $row->no_transaksi }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Pesan</td>
                                <td>: {{ date('d/M/Y', strtotime($row->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td>Pengambilan</td>
                                <td>: {{ date('d/M/Y', strtotime($row->tgl_acara)) }} {{ $row->waktu_acara }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: {{ $row->status }}</td>
                            </tr>
                            <tr>
                                <td>Bukti DP</td>
                                <td>
                                    @if($row->bukti_dp == null)
                                        : <b>Tagihan DP Rp. {{ number_format($DP * $row->total_harga) }}</b>
                                    @else
                                        : <a href="#modalLihatDP{{ $row->id }}" data-toggle="modal">
                                            <img src="/fotoDP/{{ $row->bukti_dp }}" width="50" height="50">
                                          </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Bayar</td>
                                <td>
                                    @if($row->tgl_bayar == null)
                                        : Tgl Bayar Belum Ada
                                    @else
                                        : {{ date('d/M/Y', strtotime($row->tgl_bayar)) }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td>: {{ $row->nama_user }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $row->email }}</td>
                        </tr>
                        <tr>
                            <td>No Handphone</td>
                            <td>: {{ $row->nohp }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $row->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Catatan Pembeli</td>
                            <td>: {{ $row->catatan }}</td>
                        </tr>
                        <tr>
                            <td>Bukti Lunas</td>
                            <td>
                                @if($row->bukti_lunas == null)
                                    : <b>Tagihan Pelunasan Rp. {{ number_format($LUNAS * $row->total_harga) }}</b>
                                @else
                                    : <a href="#modalLihatLunas{{ $row->id }}" data-toggle="modal">
                                        <img src="/fotoLunas/{{ $row->bukti_lunas }}" width="50" height="50">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <tr>
                            <td><b>Silahkan melakukan pembayaran di</b></td>
                            <td><b>BNI 0829726543 / MNC SNACK</b></td>
                            <img src="/fotoApps/qris.jpeg" alt="" style="width: 150px;">
                        </tr>
                </div>
            </div>

            <div class="col-lg-12 table-responsive mb-5">
                <hr/>
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Snack</th>
                                <th>Harga</th>
                                <th>Jumlah pesan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($data_detailtransaksi as $d)
                            <tr>
                                <td class="align-middle">
                                    <img src="/fotoSnack/{{ $d->gambar }}" alt="" style="width: 50px;">
                                    {{ $d->nama_snack }}
                                </td>
                                <td class="align-middle">Rp. {{ number_format($d->harga) }}</td>
                                <td class="align-middle">{{ $d->qty }}</td>
                                <td class="align-middle">Rp. {{ number_format($d->harga * $d->qty) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="align-middle" colspan="3"><b>Total</b></td>
                                <td class="align-middle"><b>Rp. {{ number_format($row->total_harga) }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="modal fade" id="modalLihatDP{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti DP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center><img src="/fotoDP/{{ $row->bukti_dp }}" width="350" height="350"></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLihatLunas{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Lunas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center><img src="/fotoLunas/{{ $row->bukti_lunas }}" width="350" height="350"></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    <!-- Contact End -->


@endsection
