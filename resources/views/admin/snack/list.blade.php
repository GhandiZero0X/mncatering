@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Snack</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="#">Snack</a></div>
            <div class="breadcrumb-item">Data Snack</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#modalCreate">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Snack</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($data_snack as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a href="#modalGambar{{ $row->id }}" data-toggle="modal">
                                                <img src="/fotoSnack/{{ $row->gambar }}" width="50" height="50">
                                            </a>
                                        </td>
                                        <td>{{ $row->nama_snack }}</td>
                                        <td>{{ $row->deskripsi }}</td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                        <td>
                                            <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Snack</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/snack/store" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama Snack</label>
                            <input type="text" class="form-control" name="nama_snack" placeholder="Nama Snack ..." required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control" name="harga" placeholder="Harga ..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" name="deskripsi" placeholder="Deskripsi ..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar" accept="image/*" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan </button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data_snack as $d)

<div class="modal fade" tabindex="-1" role="dialog" id="modalEdit{{ $d->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Snack</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/snack/update/{{ $d->id }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama Snack</label>
                            <input type="text" class="form-control" value="{{ $d->nama_snack }}" name="nama_snack" placeholder="Nama Snack ..." required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control" value="{{ $d->harga }}" name="harga" placeholder="Harga ..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" name="deskripsi" placeholder="Deskripsi ..." required>{{ $d->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar" accept="image/*">
                        </div>
                        <div class="form-group">
                            <img src="/fotoSnack/{{ $d->gambar }}" width="100" height="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan </button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@foreach ($data_snack as $b)

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus{{ $b->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data Snack</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" action="/snack/destroy/{{ $b->id }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <h5>Apakah Anda Ingin Menghapus Data Ini ?</h5>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@foreach ($data_snack as $c)

<div class="modal fade" tabindex="-1" role="dialog" id="modalGambar{{ $c->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/fotoSnack/{{ $d->gambar }}" width="300" height="250">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup </button>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
