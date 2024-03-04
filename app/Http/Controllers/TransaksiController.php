<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    // ================= TAMPIL DATA ====================

    public function index()
    {
        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
            ->select('tbl_transaksi.*', 'users.nama_user')
            ->get();

        $data = array(
            'title' => 'Pesanan Page',
            'data_transaksi' => $transaksi,
        );

        return view('admin.transaksi.list', $data);
    }

    public function detail($no_transaksi)
    {
        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
            ->select('tbl_transaksi.*', 'users.nama_user', 'users.nohp', 'users.email', 'users.alamat')
            ->where('tbl_transaksi.no_transaksi', $no_transaksi)
            ->get();

        $detailtransaksi = Transaksi::join('tbl_detail_transaksi', 'tbl_transaksi.no_transaksi', '=', 'tbl_detail_transaksi.no_transaksi')
            ->join('tbl_snack', 'tbl_snack.id', '=', 'tbl_detail_transaksi.id_snack')
            ->select('tbl_transaksi.no_transaksi', 'tbl_detail_transaksi.qty', 'tbl_snack.nama_snack', 'tbl_snack.harga', 'tbl_snack.gambar')
            ->where('tbl_transaksi.no_transaksi', $no_transaksi)
            ->get();
        $data = array(
            'title' => 'Detail Transaksi',
            'data_transaksi' => $transaksi,
            'data_detailtransaksi' => $detailtransaksi,
        );

        return view('admin.transaksi.detail', $data);
    }

    public function cetak($no_transaksi)
    {
        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
            ->select('tbl_transaksi.*', 'users.nama_user', 'users.nohp', 'users.email', 'users.alamat')
            ->where('tbl_transaksi.no_transaksi', $no_transaksi)
            ->get();

        $detailtransaksi = Transaksi::join('tbl_detail_transaksi', 'tbl_transaksi.no_transaksi', '=', 'tbl_detail_transaksi.no_transaksi')
            ->join('tbl_snack', 'tbl_snack.id', '=', 'tbl_detail_transaksi.id_snack')
            ->select('tbl_transaksi.no_transaksi', 'tbl_detail_transaksi.qty', 'tbl_snack.nama_snack', 'tbl_snack.harga', 'tbl_snack.gambar')
            ->where('tbl_transaksi.no_transaksi', $no_transaksi)
            ->get();
        $data = array(
            'title' => 'Detail Transaksi',
            'data_transaksi' => $transaksi,
            'data_detailtransaksi' => $detailtransaksi,
        );

        return view('admin.transaksi.cetak', $data);
    }

    // ================= ACTION PROSES & TOLAK ====================

    public function proses(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => 'Belum Lunas',
        ]);

        return redirect('/transaksi')->with('success', 'Data Diproses Berhasil');
    }

    public function tolak(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => 'Tolak',
        ]);

        return redirect('/transaksi')->with('success', 'Data Ditolak Berhasil');
    }

    public function refund(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $imageName = time() . '.' . $request->bukti_refund->extension();
        $request->bukti_refund->move(public_path('fotoRefund'), $imageName);

        $transaksi->update([
            'status' => 'Selesai Refund',
            'bukti_refund' => $imageName,
        ]);

        return redirect('/transaksi')->with('success', 'Refund Uang Berhasil');
    }
}