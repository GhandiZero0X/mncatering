@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Laporan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="#">Laporan</a></div>
            <div class="breadcrumb-item">Data Laporan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#modalCetak">
                            <i class="fa fa-print"></i>
                            Cetak Data
                        </button>
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
                                        <th>Pengambilan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($data_transaksi as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->no_transaksi }}</td>
                                        <td>{{ $row->nama_user }}</td>
                                        <td>{{ date('d/M/Y', strtotime($row->tgl_pesan)) }}</td>
                                        <td>{{ date('d/M/Y', strtotime($row->tgl_acara)) }} {{ $row->waktu_acara }}</td>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalCetak">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/laporan/cetak" target="_blank">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Tgl Pengambilan Mulai</label>
                    <input type="date" class="form-control" name="tgl_mulai" required>
                </div>
                <div class="form-group">
                    <label>Tgl Pengambilan Selesai</label>
                    <input type="date" class="form-control" name="tgl_selesai" required>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
