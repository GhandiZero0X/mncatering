@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data</a></div>
            <div class="breadcrumb-item"><a href="#">Admin</a></div>
            <div class="breadcrumb-item">Data Admin</div>
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
                                        <th>Nama </th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($data_user as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama_user }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->nohp }}</td>
                                        <td>{{ $row->alamat }}</td>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/user/store">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_user" placeholder="Nama Lengkap ..." required>
                </div>
                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="number" class="form-control" name="nohp" placeholder="No Handphone ..." required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email ..." required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password ..." required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="5" name="alamat" placeholder="Alamat ..." required></textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan </button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data_user as $d)

<div class="modal fade" tabindex="-1" role="dialog" id="modalEdit{{ $d->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/user/update/{{ $d->id }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $d->nama_user }}" name="nama_user" placeholder="Nama Lengkap ..." required>
                </div>
                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="number" class="form-control" value="{{ $d->nohp }}" name="nohp" placeholder="No Handphone ..." required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ $d->email }}" name="email" placeholder="Email ..." required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password ..." required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="5" name="alamat" placeholder="Alamat ..." required>{{ $d->alamat }}</textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan </button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@foreach ($data_user as $b)

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus{{ $b->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" action="/user/destroy/{{ $b->id }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <h5>Apakah Anda Ingin Menghapus Data Ini ?</h5>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@endsection
