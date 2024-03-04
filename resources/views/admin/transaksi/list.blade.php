@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item">Data Transaksi</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Tgl Pesan</th>
                                        <th>Acara</th>
                                        <th>Catatan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($data_transaksi as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->no_transaksi }}</td>
                                        <td>{{ $row->nama_user }}</td>
                                        <td>{{ date('d/M/Y', strtotime($row->created_at)) }}</td>
                                        <td>{{ date('d/M/Y', strtotime($row->tgl_acara)) }} {{ $row->waktu_acara }}</td>
                                        <td>{{ $row->catatan}}</td>
                                        <td>Rp. {{ number_format($row->total_harga) }}</td>
                                        <td>
                                            @if($row->status == 'Belum DP')
                                                <div class="badge badge-danger badge-sm">Belum DP</div>
                                            @elseif($row->status == 'Proses')
                                                <div class="badge badge-primary badge-sm">Proses</div>
                                            @elseif($row->status == 'Belum Lunas' OR $row->status == 'Refund')
                                                <div class="badge badge-warning badge-sm">{{ $row->status }}</div>
                                            @elseif($row->status == 'Lunas' OR $row->status == 'Selesai Refund')
                                                <div class="badge badge-success badge-sm">{{ $row->status }}</div>
                                            @else
                                                <div class="badge badge-danger badge-sm">{{ $row->status }}</div>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($row->status == 'Proses')
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Pilih Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#modalProses{{ $row->id }}" data-toggle="modal"><i class="fa fa-thumbs-up"></i> Proses</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#modalTolak{{ $row->id }}" data-toggle="modal"><i class="fa fa-thumbs-down"></i> Tolak </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="/transaksi/detail/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data </a>
                                                    </div>
                                                </div>
                                            @elseif($row->status == 'Refund')
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Pilih Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#modalUploadRefund{{ $row->id }}" data-toggle="modal"><i class="fa fa-sync-alt"></i> Upload Bukti Refund</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#modalRefund{{ $row->id }}" data-toggle="modal"><i class="fa fa-list"></i> Detail Refund </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="/transaksi/detail/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data </a>
                                                    </div>
                                                </div>
                                            @elseif($row->status == 'Lunas')
                                                <a href="/transaksi/detail/{{ $row->no_transaksi }}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> </a>
                                                <a href="/transaksi/cetak/{{ $row->no_transaksi }}" target="_blank" class="btn btn-sm btn-dark"><i class="fa fa-print"></i> </a>
                                            @elseif($row->status == 'Selesai Refund')
                                                <a href="/transaksi/detail/{{ $row->no_transaksi }}" title="Detail Data" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> </a>
                                                <a href="#modalRefund{{ $row->id }}" data-toggle="modal" title="Detail Refund" class="btn btn-sm btn-dark"><i class="fa fa-sync"></i> </a>
                                            @else
                                                <a href="/transaksi/detail/{{ $row->no_transaksi }}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Detail</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@foreach ($data_transaksi as $d)

<div class="modal fade" tabindex="-1" role="dialog" id="modalProses{{ $d->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proses Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/transaksi/proses/{{ $d->id }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <h5>Apakah Data Ini Di Proses ?</h5>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Proses</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@foreach ($data_transaksi as $b)

<div class="modal fade" tabindex="-1" role="dialog" id="modalTolak{{ $b->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/transaksi/tolak/{{ $b->id }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <h5>Apakah Data Ini Di Tolak ?</h5>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-thumbs-down"></i> Tolak</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@foreach ($data_transaksi as $q)

<div class="modal fade" tabindex="-1" role="dialog" id="modalUploadRefund{{ $q->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Bukti Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/transaksi/refund/{{ $q->id }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Bank Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $q->bank_pelanggan }}" readonly required>
                </div>
                <div class="form-group">
                    <label>No Rekening Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $q->norek_pelanggan }}" readonly required>
                </div>
                <div class="form-group">
                    <label>Atas Nama</label>
                    <input type="text" class="form-control" value="{{ $q->atasnama_pelanggan }}" readonly required>
                </div>
                <div class="form-group">
                    <label>Total Uang Yang Di Refund</label>
                    <input type="text" class="form-control" value="Rp. {{ number_format($q->total_refund) }}" readonly required>
                </div>
                <div class="form-group">
                    <label>Upload Bukti Refund</label>
                    <input type="file" class="form-control" name="bukti_refund" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@foreach ($data_transaksi as $j)

<div class="modal fade" id="modalRefund{{ $j->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Bank Pelanggan</th>
                            <td>: {{ $j->bank_pelanggan }}</td>
                        </tr>
                        <tr>
                            <th>No Rekening Pelanggan</th>
                            <td>: {{ $j->norek_pelanggan }}</td>
                        </tr>
                        <tr>
                            <th>Atas Nama</th>
                            <td>: {{ $j->atasnama_pelanggan }}</td>
                        </tr>
                        <tr>
                            <th>Total Uang Yang Di Refund</th>
                            <td>: Rp. {{ number_format($j->total_refund) }}</td>
                        </tr>

                    </table>
                </div>
                <hr/>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">Bukti DP</th>
                            <th class="text-center">Bukti Refund</th>
                        </tr>
                        <tr>
                            <td><img src="/fotoDp/{{ $j->bukti_dp }}" class="text-center" width="300" height="300"></td>
                            <td>
                                @if($j->bukti_refund == null)
                                    <div class="text-center"><b>Belum Ada Bukti Refund</b></div>
                                @else
                                    <img src="/fotoRefund/{{ $j->bukti_refund }}" class="text-center" width="300" height="300">
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
