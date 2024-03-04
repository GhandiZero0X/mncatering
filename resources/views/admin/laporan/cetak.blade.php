<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CETAK LAPORAN</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body style="background-color: white;" onload="window.print()">

    <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td align="center">
                                @foreach ($data_apps as $z)
                                <span style="line-height: 1.6; font-weight: bold;">
                                    {{ $z->nama_apps }}
                                    <br>{{ $z->alamat_apps }}
                                    <br>{{ $z->nohp_apps }}
                                </span>
                                @endforeach
                                <br>
                                <!-- <b> Tanggal Pengambilan : </b>
                                @foreach ($data_transaksi as $zz)
                                <span style="line-height: 1.6; font-weight: bold;">
                                    {{ date('d/M/Y', strtotime($zz->tgl_mulai)) }}
                                </span>
                                @endforeach -->
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    
                    <p align="center">
                        <b>LAPORAN DATA TRANSAKSI</b><br/>
                        
                    </p>
                   

                    <hr/>
                    <div class="table-responsive">
                        <table class="table table-bordered" >
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Tgl Pesan</th>
                                <th>Pengambilan</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>

                            @php $no = 1;  $DP = 60/100; @endphp
                            @if($data_transaksi)
                            @foreach ($data_transaksi as $row)

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->no_transaksi }}</td>
                                <td>{{ $row->nama_user }}</td>
                                <td>{{ date('d/M/Y', strtotime($row->created_at)) }}</td>
                                <td>{{ date('d/M/Y', strtotime($row->tgl_acara)) }} {{ $row->waktu_acara }}</td>
                                <td>
                                    {{ $row->status }}
                                </td>
                                <td>Rp. {{ number_format($row->total_harga) }}</td>
                            </tr>

                            @endforeach

                            @else

                            <tr>
                                <td colspan="6"><center>Data Tidak Ada</center></td>
                            </tr>

                            @endif

                            <!-- TOTAL SEMUA -->
                            @if($sum_total)

                            <tr>
                                <th colspan="5">Total Keseluruhan</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_total) }}</th>
                            </tr>

                            @else

                            <tr>
                                <th colspan="5">Seluruh Total</th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif

                            <!-- TOTAL LUNAS -->
                            @if($sum_lunas)

                            <tr>
                                <th colspan="5">Transaksi Yang Sudah Lunas (Uang Diterima)</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_lunas) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Lunas</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif
                            
                            <!-- TOTAL BELUM DP -->
                            @if($sum_belumdp)

                            <tr>
                                <th colspan="5">Transaksi Belum DP</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_belumdp) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Belum DP</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif

                            <!-- TOTAL PROSES -->
                            @if($sum_proses)

                            <tr>
                                <th colspan="5">Transaksi Diproses</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_proses) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Diproses</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif

                            <!-- TOTAL BELUM LUNAS -->
                            @if($sum_belumlunas)

                            <tr>
                                <th colspan="5">Transaksi Belum Lunas </th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_belumlunas) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Belum Lunas</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif

                            <!-- TOTAL TOLAK -->
                            @if($sum_tolak)

                            <tr>
                                <th colspan="5">Transaksi Ditolak</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_tolak) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Ditolak</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif

                            <!-- TOTAL REFUND -->
                            @if($sum_refund)

                            <tr>
                                <th colspan="5">Transaksi Proses Refund (Uang Yang Harus Di Refund)</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_refund * $DP) }} </th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Proses Refund (Uang Yang Harus Di Refund)</th>
                                <th></th>
                                <th>Rp 0</th>
                            </tr>

                            @endif

                            <!-- TOTAL SELESAI REFUND -->
                            @if($sum_selesairefund)

                            <tr>
                                <th colspan="5">Transaksi Refund Selesai (Uang Yang Harus Sudah Di Refund)</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_selesairefund * $DP) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Refund Selesai (Uang Yang Harus Sudah Di Refund)</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif

                             <!-- TOTAL SELESAI REFUND -->
                             @if($sum_batal)

                            <tr>
                                <th colspan="5">Transaksi Dibatalkan</th>
                                <th></th>
                                <th>Rp. {{ number_format($sum_batal) }}</th>
                            </tr>

                            @else
                            <tr>
                                <th colspan="5">Transaksi Dibatalkan</th>
                                <th></th>
                                <th>Rp. 0</th>
                            </tr>

                            @endif
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
