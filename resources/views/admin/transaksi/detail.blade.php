@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Data Transasksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Detail Data</a></div>
            <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item">Detail Data Transaksi</div>
        </div>
    </div>

    @foreach ($data_transaksi as $row)

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-sm btn-round" href="/transaksi">
                            <i class="fa fa-undo"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>No Transaksi</td>
                                            <td>: {{ $row->no_transaksi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Pesan</td>
                                            <td>: {{ date('d/M/Y', strtotime($row->tgl_pesan)) }}</td>
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
                                                    : Bukti DP Belum Ada
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
                            <div class="col-6">
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
                                                    : Bukti Lunas Belum Ada
                                                @else
                                                    : <a href="#modalLihatLunas{{ $row->id }}" data-toggle="modal">
                                                        <img src="/fotoLunas/{{ $row->bukti_lunas }}" width="50" height="50">
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Snack</th>
                                        <th>Harga</th>
                                        <th>Jumlah Pesan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach ($data_detailtransaksi as $d)
                                    <tr>
                                        <td class="text-center">
                                            <img src="/fotoSnack/{{ $d->gambar }}" alt="" width="100">
                                        </td>
                                        <td class="text-center">
                                            {{ $d->nama_snack }}
                                        </td>
                                        <td class="text-center">Rp. {{ number_format($d->harga) }}</td>
                                        <td class="text-center">{{ $d->qty }}</td>
                                        <td class="text-center">Rp. {{ number_format($d->harga * $d->qty) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center" colspan="4"><b>Total</b></td>
                                        <td class="text-center"><b>Rp. {{ number_format($row->total_harga) }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="modalLihatDP{{ $row->id }}">
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
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalLihatLunas{{ $row->id }}">
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
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
