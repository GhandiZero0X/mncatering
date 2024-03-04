@extends('layout.layout')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Pengaturan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengaturan</a></div>
            <div class="breadcrumb-item"><a href="#">Aplikasi</a></div>
            <div class="breadcrumb-item">Pengaturan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan</h4>
                    </div>
                    @foreach ($data_apps as $row)
                    <form method="POST" action="/aplikasi/update/{{ $row->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Aplikasi</label>
                                    <input type="text" class="form-control" name="nama_apps" placeholder="Nama Apps ..." value="{{ $row->nama_apps }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="number" class="form-control" name="nohp_apps" placeholder="NO HP Apps ..." value="{{ $row->nohp_apps }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email_apps" placeholder="Email Apps ..." value="{{ $row->email_apps }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Alamat </label>
                                    <textarea class="form-control" name="alamat_apps" rows="5" placeholder="Alamat Apps ..." required>{{ $row->alamat_apps }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <img src="/fotoApps/{{ $row->logo }}" width="250" height="100">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h5>BANK ADMIN</h5>
                        <hr/>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Atas Nama</label>
                                    <input type="text" class="form-control" name="atas_nama" placeholder="Atas Nama ..." value="{{ $row->atas_nama }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Bank</label>
                                    <input type="text" class="form-control" name="bank" placeholder="Bank ..." value="{{ $row->bank }}" required>
                                </div>
                                <div class="form-group">
                                    <label>No Rekening</label>
                                    <input type="number" class="form-control" name="no_rek" placeholder="No Rekening ..." value="{{ $row->no_rek }}" required>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <img src="/fotoApps/{{ $row->banner }}" width="250" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
