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
               <div class="table-responsive">
                   <table class="table table-bordered text-center mb-0">
                       <thead class="bg-secondary text-dark">
                           <tr>
                               <th>No</th>
                               <th>No Transaksi</th>
                               <th>Pelanggan</th>
                               <th>Tgl Pesan</th>
                               <th>Tgl & Waktu Acara</th>
                               <th>Catatan</th>
                               <th>Status</th>
                               <th>Total</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody class="align-middle">
                           @php $no = 1 ; $DP = 60 / 100; $LUNAS = 40 / 100; @endphp
                           @foreach ($data_transaksi as $row)
                           @if($row->id_pelanggan == Auth::user()->id)
                           <tr>
                               <td class="align-middle">{{ $no++ }}</td>
                               <td class="align-middle">{{ $row->no_transaksi }}</td>
                               <td class="align-middle">{{ $row->nama_user }}</td>
                               <td class="align-middle">{{ date('d/M/Y', strtotime($row->created_at)) }} {{ $row->created_at }}</td>
                               <td class="align-middle">{{ date('d/M/Y', strtotime($row->tgl_pesan)) }} {{ $row->waktu_acara }}</td>
                               <td class="align-middle">{{ $row->catatan }}</td>
                               <td class="align-middle">
                                   @if($row->status == 'Belum DP')
                                       <div class="badge badge-danger badge-sm">Belum DP</div>
                                       <!-- <p>DP = Rp. {{ number_format($DP * $row->total_harga) }}</p>  -->
                                   @elseif($row->status == 'Proses')
                                       <div class="badge badge-primary badge-sm">Proses</div>
                       
                                   @elseif($row->status == 'Belum Lunas')
                                       <div class="badge badge-warning badge-sm">Belum Lunas</div>
                                       <!-- <p>Kurang = Rp. {{ number_format($LUNAS * $row->total_harga) }}</p> -->
                                   @elseif($row->status == 'Lunas')
                                       <div class="badge badge-success badge-sm">Lunas</div>
                                   @else
                                       <div class="badge badge-danger badge-sm">Tolak</div>
                                       <p>Bukti bayar tidak valid</p>
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
                                               <a class="dropdown-item" href="#modalDP{{ $row->id }}" data-toggle="modal"><i class="fa fa-upload"></i> Upload Bukti DP</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
                                           </div>
                                       </div>
                                   @elseif($row->status == 'Belum Lunas')
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <a class="dropdown-item" href="#modalLunas{{ $row->id }}" data-toggle="modal"><i class="fa fa-upload"></i> Upload Bukti Lunas</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
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
                                       @elseif($row->status == 'Tolak')
                                       <div class="btn-group">
                                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               Pilih Aksi
                                           </button>
                                           <div class="dropdown-menu">
                                               <a class="dropdown-item" href="#modalDP{{ $row->id }}" data-toggle="modal"><i class="fa fa-upload"></i> Upload Bukti DP</a>
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item" href="/pesanan/detailpesanan/{{ $row->no_transaksi }}"><i class="fa fa-list"></i> Detail Data</a>
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
                   <br>
                   <label><i>*Pastikan pembayaran sesuai dengan rekening di atas !</i></label>
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
               <label><i>*Pastikan pembayaran sesuai dengan rekening di atas !</i></label>
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
<h5><b><center>Silahkan melakukan pembayaran di rekening BNI 0829726543 / MNC SNACK</center></b></h5>
<center><img src="/fotoApps/qris.jpeg" alt="" style="width: 150px;"></center>


@endsection
