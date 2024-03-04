@extends('layout.layoutUser')

@section('contentUser')

   <!-- Page Header Start -->
   <div class="container-fluid mb-5" style="background-color: #ffc40c;">
       <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
           <h1 class="font-weight-semi-bold text-uppercase mb-3 text-white">Pesanan</h1>
           <div class="d-inline-flex">
               <p class="m-0 text-white"><a href="/homeUser">Home</a></p>
               <p class="m-0 px-2 text-white">-</p>
               <p class="m-0 text-white">Pesanan</p>
           </div>
       </div>
   </div>
   <!-- Page Header End -->

   <!-- Cart Start -->
   <div class="container-fluid pt-5">
       <div class="text-center mb-4">
           <h2 class="section-title px-5"><span class="px-2">Pesanan</span></h2>
       </div>
       <div class="row px-xl-5">
           <div class="col-lg-12 table-responsive mb-5">
               @if (session('status'))
                   <div class="alert alert-danger">Pesanan akan otomatis dibatalakan dalam waktu 1x24 jika pelanggan BELUM DP</div>
               @endif

               <div class="table-responsive">
                   <table class="table table-bordered text-center mb-0">
                       <thead class="bg-secondary text-dark">
                           <tr>
                               <th>No</th>
                               <th>No Transaksi</th>
                               <th>Pelanggan</th>
                               <th>Tgl Pesan</th>
                               <th>Tgl Acara</th>
                               <th>Waktu Acara</th>
                               <th>Catatan</th>
                               <th>Status</th>
                               <th>Total</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody class="align-middle">
                           @php $no = 1 @endphp
                           @foreach ($data_transaksi as $row)
                           @if($row->id_pelanggan == Auth::user()->id)
                           <?php
                               $now       = date('Y-m-d');
                               $tgl_acara = $row->tgl_acara;
                               $selisih   = date('Y-m-d', strtotime('-4 days', strtotime($tgl_acara)));
                           ?>
                           <tr>
                               <td class="align-middle">{{ $no++ }}</td>
                               <td class="align-middle">{{ $row->no_transaksi }}</td>
                               <td class="align-middle">{{ $row->nama_user }}</td>
                               <td class="align-middle">{{ date('d/M/Y', strtotime($row->tgl_pesan)) }}</td>
                               <td class="align-middle">{{ date('d/M/Y', strtotime($row->tgl_acara)) }}</td>
                               <td class="align-middle">{{ $row->waktu_acara }}</td>
                               <td class="align-middle">{{ $row->catatan }}</td>
                               <td class="align-middle">
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
                               <td class="align-middle">Rp. {{ number_format($row->total_harga) }}</td>

                               <td class="align-middle">
                                   @if($row->status == 'Belum DP')
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <!-- <a class="dropdown-item" href="#modalDP{{ $row->id }}" data-toggle="modal"><i class="fa fa-upload"></i> Upload Bukti DP</a> -->
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
                                           </div>
                                       </div>
                                   @elseif($row->status == 'Belum Lunas' AND $now < $selisih)
                                       <a href="/pesanan/detailpesanan/{{ $row->no_transaksi }}" title="Detail" class="btn btn-sm btn-primary">
                                           <i class="fa fa-list"></i>
                                       </a>
                                       <a class="btn btn-sm btn-primary" href="#uploadRefund{{ $row->id }}" data-toggle="modal" title="Refund">
                                           <i class="fa fa-sync-alt"></i>
                                       </a>
                                       <a class="btn btn-sm btn-primary" href="#modalLunas{{ $row->id }}" data-toggle="modal" title="Upload Lunas">
                                           <i class="fa fa-upload"></i>
                                       </a>
                                   @elseif($row->status == 'Belum Lunas' AND $now > $selisih)
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <!-- <a class="dropdown-item" href="#modalLunas{{ $row->id }}" data-toggle="modal"><i class="fa fa-upload"></i> Upload Bukti Lunas</a> -->
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
                                           </div>
                                       </div>
                                   @elseif($row->status == 'Refund')
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="#modalRefund{{ $row->id }}" data-toggle="modal"><i class="fa fa-list"></i> Detail Refund</a>
                                           </div>
                                       </div>
                                   @elseif($row->status == 'Lunas')
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" target="_blank" href="/pesanan/cetak/{{ $row->no_transaksi }}"><i class="fa fa-print"></i> Cetak Data</a>
                                           </div>
                                       </div>
                                   @elseif($row->status == 'Selesai Refund')
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="#modalRefund{{ $row->id }}" data-toggle="modal"><i class="fa fa-sync-alt"></i> Detail Refund</a>
                                           </div>
                                       </div>
                                   @else
                                       <a href="/pesanan/detailpesanan/{{ $row->no_transaksi }}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Detail</a>
                                   @endif
                               </td>
                           </tr>
                           @endif
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>

       </div>
   </div>
   <!-- Cart End -->

@foreach ($data_transaksi as $d)

<div class="modal fade" id="modalDP{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Upload Bukti DP</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form method="POST" action="/pesanan/uploaddp/{{ $d->id }}" enctype="multipart/form-data">
           @csrf
           <div class="modal-body">
               @foreach ($data_apps as $q)
               <div class="form-group">
                   <label>Bank</label>
                   <input type="text" class="form-control" value="{{ $q->bank }}" readonly required>
               </div>
               <div class="form-group">
                   <label>No Rekening</label>
                   <input type="text" class="form-control" value="{{ $q->no_rek }}" readonly required>
               </div>
               <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" class="form-control" value="{{ $q->atas_nama }}" readonly required>
               </div>
               @endforeach

               <div class="form-group">
                   <label>Upload Bukti DP</label>
                   <input type="file" class="form-control" name="bukti_dp" accept="image/*" required>
               </div>
               <div class="form-group">
                   <label><b>*Pastikan nomor rekening sesuai dengan di atas !</b></label>
               </div>
           </div>
           
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
           </div>
           </form>
       </div>
   </div>
</div>

@endforeach

@foreach ($data_transaksi as $b)

<div class="modal fade" id="modalLunas{{ $b->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Lunas</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form method="POST" action="/pesanan/uploadlunas/{{ $b->id }}" enctype="multipart/form-data">
           @csrf
           <div class="modal-body">
               @foreach ($data_apps as $v)
               <div class="form-group">
                   <label>Bank</label>
                   <input type="text" class="form-control" value="{{ $v->bank }}" readonly required>
               </div>
               <div class="form-group">
                   <label>No Rekening</label>
                   <input type="text" class="form-control" value="{{ $v->no_rek }}" readonly required>
               </div>
               <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" class="form-control" value="{{ $v->atas_nama }}" readonly required>
               </div>
               @endforeach

               <div class="form-group">
                   <label>Upload Bukti Lunas</label>
                   <input type="file" class="form-control" name="bukti_lunas" accept="image/*" required>
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
           </div>
           </form>
       </div>
   </div>
</div>

@endforeach


@foreach ($data_transaksi as $z)

<div class="modal fade" id="uploadRefund{{ $z->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Refund Uang</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form method="POST" action="/pesanan/refund/{{ $z->id }}" enctype="multipart/form-data">
           @csrf
           <div class="modal-body">
               <div class="form-group">
                   <label>Bank Pelanggan</label>
                   <input type="text" class="form-control" name="bank_pelanggan" placeholder="Bank Pelanggan ..." required>
               </div>
               <hr/>
               <div class="form-group">
                   <label>No Rekening Pelanggan</label>
                   <input type="number" class="form-control" name="norek_pelanggan" placeholder="No Rekening Pelanggan ..." required>
               </div>
               <hr/>
               <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" class="form-control" name="atasnama_pelanggan" placeholder="Atas Nama Pelanggan ..." required>
               </div>
               <hr/>
               <div class="form-group">
                   <label>Total Uang Yang Di Refund</label>
                   <input type="number" class="form-control" name="total_refund" placeholder="Total Uang Yang Di Refund ..." required>
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-sync-alt"></i> Refund</button>
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
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
           </div>
       </div>
   </div>
</div>

@endforeach

@endsection
