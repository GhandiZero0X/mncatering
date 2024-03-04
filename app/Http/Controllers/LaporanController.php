<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Aplikasi;

class LaporanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
                              ->select('tbl_transaksi.*', 'users.nama_user')
                              ->get();

        $data = array(
            'title'          => 'Data Laporan',
            'data_transaksi' => $transaksi,
        );

        return view('admin.laporan.list', $data);
    }

    public function cetak(Request $request)
    {
        $tgl_mulai   = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
                              ->select('tbl_transaksi.*', 'users.nama_user')
                              ->whereBetween('tbl_transaksi.tgl_acara', [$tgl_mulai, $tgl_selesai])
                              ->get();

        $sum_total = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->sum('total_harga');

        $sum_lunas = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Lunas')->sum('total_harga', 'status', 'Lunas');
        $sum_belumlunas = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Belum Lunas')->sum('total_harga', 'status', 'Belum Lunas');
        $sum_belumdp = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Belum DP')->sum('total_harga', 'status', 'Belum DP');
        $sum_proses = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Proses')->sum('total_harga', 'status', 'Proses');
        $sum_tolak = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Tolak')->sum('total_harga', 'status', 'Tolak');
        $sum_refund = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Refund')->sum('total_harga', 'status', 'Refund');
        $sum_selesairefund = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Selesai Refund')->sum('total_harga', 'status', 'Selesai Refund');
        $sum_batal = Transaksi::whereBetween('tgl_acara', [$tgl_mulai, $tgl_selesai])->where('status', 'Batal')->sum('total_harga', 'status', 'Batal');

        $data = array(
            'title'          => 'Cetak Laporan',
            'data_apps'      => Aplikasi::all(),
            'data_transaksi' => $transaksi,
            'sum_total'      => $sum_total,

            'sum_belumdp'      => $sum_belumdp,
            'sum_proses'      => $sum_proses,
            'sum_belumlunas'      => $sum_belumlunas,
            'sum_lunas'      => $sum_lunas,
            'sum_tolak'      => $sum_tolak,
            'sum_refund'      => $sum_refund,
            'sum_selesairefund'      => $sum_selesairefund,
            'sum_batal'      => $sum_batal,
        );

        return view('admin.laporan.cetak', $data);
    }
}
