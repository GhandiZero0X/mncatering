<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CETAK TRANSAKSI</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/font-awesome/css/all.css">


    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/css/select.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
</head>

<body style="background-color: white;" onload="window.print()">

    @foreach ($data_transaksi as $row)
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Transaksi</h2>
                                <div class="invoice-number"> #{{ $row->no_transaksi }}</div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Alamat Tagihan:</strong><br>
                                        {{ $row->nama_user }}<br>
                                        {{ $row->email }}<br>
                                        {{ $row->nohp }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                <address>
                                        <strong>Pengambilan:</strong><br>
                                        {{ date('d/M/Y', strtotime($row->tgl_acara)) }} {{ ($row->waktu_acara) }}<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Pembayaran :</strong><br>
                                        BNI<br>
                                        {{ $row->nama_user }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Tanggal Pesan:</strong><br>
                                        {{ date('d/M/Y', strtotime($row->tgl_pesan)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Ringkasan Pesanan</div>
                            <!-- <p class="section-lead">All items here cannot be deleted.</p> -->
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered table-md">
                                    <tr>
                                        <th data-width="40">No</th>
                                        <th>Snack</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah Pesan</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                    @php $no = 1 @endphp
                                    @foreach ($data_detailtransaksi as $d)
                                    <tr>
                                    <td>{{ $no++ }}</td>
                                        <td>{{ $d->nama_snack }}</td>
                                        <td class="text-center">Rp. {{ number_format($d->harga) }} / pcs</td>
                                        <td class="text-center">{{ $d->qty }} pcs</td>
                                        <td class="text-right">Rp. {{ number_format($d->harga * $d->qty) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                <div class="section-title">Pembayaran</div>
                                    <p class="section-lead">BNI</p>

                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value">Rp. {{ number_format($row->total_harga) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endforeach

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.nicescroll.min.js"></script>
    <script src="/assets/js/moment.min.js"></script>

    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/js/dataTables.select.min.js"></script>

    <script src="/assets/js/sweetalert.min.js"></script>

    <script src="/assets/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/page/modules-datatables.js"></script>
    <script src="/assets/js/page/modules-sweetalert.js"></script>

</body>
</html>
