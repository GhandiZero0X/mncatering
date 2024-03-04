<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Snack;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BaseController extends Controller
{

// ================= TAMPIL SHOP ================================

    public function index()
    {
        $id_user = Auth::user()->id;

        $data = array(
            'title'      => 'Home Page',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::orderBy('id', 'DESC')->limit(4)->get(),
        );

        return view('pelanggan.homeUser',$data);
    }

    public function shopUser()
    {
        $data = array(
            'title'      => 'Data Shop',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::orderBy('id', 'DESC')->simplePaginate(8),
        );

        return view('pelanggan.shop', $data);
    }

    public function detailshopUser($id)
    {
        $data = array(
            'title'      => 'Data Detail Shop',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::where('id', $id)->get(),
            'like_snack' => Snack::limit(6)->get(),
        );

        return view('pelanggan.detailshop', $data);
    }

// ================= KERANJANG BELANJA ================================

    public function keranjang()
    {
        $data = array(
            'title'      => 'Keranjang Page',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::orderBy('id', 'DESC')->limit(4)->get(),
        );

        return view('pelanggan.keranjang',$data);
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[$request->id_snack] = [
            "id_snack"     => $request->id_snack,
            "id_pelanggan" => $request->id_pelanggan,
            "nama_snack"   => $request->nama_snack,
            // "qty"          => $request->qty,
            "qty"          => 20,
            "harga"        => $request->harga,
            "gambar"       => $request->gambar,
        ];

        session()->put('cart', $cart);
        return redirect('/keranjang')->with('success', 'Data Berhasil Ditambah');
    }

    public function updateCart(Request $request)
    {
        if($request->id_snack && $request->qty){
            $cart = session()->get('cart');
            $cart[$request->id_snack]["qty"] = $request->qty;
            session()->put('cart', $cart);
            return redirect('/keranjang');
            // return redirect('/keranjang')->with('success', 'Data Berhasil Diubah');
        }
    }    

    public function deleteCart($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        }
    }

// ================= CHECKOUT BELANJA ================================

    public function checkout(Request $request)
    {
        // dd($request->json()->all());
        $transaksi = Transaksi::select(DB::raw('RIGHT(tbl_transaksi.no_transaksi,3) as no_transaksi', FALSE))
                               ->orderBy('no_transaksi', 'DESC')
                               ->limit(1)
                               ->get();

        if($transaksi->count() <> 0){
            $data = $transaksi->first();
            $kode = intval($data->no_transaksi) + 1;
        }
        else{
            $kode = 1;
        }

        $date  = date('dmY');
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "NT-".$date."-".$batas;

        $data = array(
            'title'        => 'Checkout Page',
            'data_apps'    => Aplikasi::all(),
            'no_transaksi' => $kodetampil,
        );

        return view('pelanggan.checkout', $data);
    }

    public function store(Request $request)
    {
        $no_transaksi = $request->no_transaksi;
        $cart = session()->get('cart');

        if($cart == null) {
            return redirect()->back()->with('error', 'Belanja Dulu');
        }else
        {
            Transaksi::create([
                'no_transaksi' => $request->no_transaksi,
                'id_pelanggan' => $request->id_pelanggan,
                'tgl_pesan'    => $request->tgl_pesan,
                'tgl_acara'    => $request->tgl_acara,
                'waktu_acara'  => $request->waktu_acara,
                'catatan'      => $request->catatan,
                'total_harga'  => $request->total_harga,
                'status'       => $request->status,
            ]);

            foreach($cart as $items){
                if(Auth::user()->id == $items['id_pelanggan']) {

                    $id_user  = $items['id_pelanggan'];
                    $id_snack = $items['id_snack'];
                    $qty      = $items['qty'];

                    DetailTransaksi::create([
                        'no_transaksi' => $no_transaksi,
                        'id_snack'     => $id_snack,
                        'qty'          => $qty,
                    ]);
                }
            }

            session()->forget('cart');
            session()->flash('status', 'Ada');
            return redirect('/pesanan')->with('success', 'Checkout Berhasil');
        }
    }

    // ================= PESANAN BELANJA ================================

    public function pesanan()
    {
        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
                              ->select('tbl_transaksi.*', 'users.nama_user')
                              ->get();

        $updatetrans = Transaksi::where('status', 'Belum DP')->where('tgl_pesan', '<', Carbon::now()->subDays(1))->get();

        foreach ($updatetrans as $post) {
            $post->update([
                'status' => 'Batal',
            ]);
        }

        $data = array(
            'title'          => 'Pesanan Page',
            'data_apps'      => Aplikasi::all(),
            'data_transaksi' => $transaksi,
        );

        return view('pelanggan.pesanan', $data);
    }
    public function pembayaran()
    {
        $transaksi = Transaksi::join('users', 'users.id', '=', 'tbl_transaksi.id_pelanggan')
                              ->select('tbl_transaksi.*', 'users.nama_user')
                              ->get();

        $updatetrans = Transaksi::where('status', 'Belum DP')->where('tgl_pesan', '<', Carbon::now()->subDays(1))->get();

        foreach ($updatetrans as $post) {
            $post->update([
                'status' => 'Batal',
            ]);
        }

        $data = array(
            'title'          => 'Pesanan Page',
            'data_apps'      => Aplikasi::all(),
            'data_transaksi' => $transaksi,
        );

        return view('pelanggan.pembayaran', $data);
    }


    public function detailpesanan($no_transaksi)
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
            'title'                => 'Detail Pesanan',
            'data_apps'            => Aplikasi::all(),
            'data_transaksi'       => $transaksi,
            'data_detailtransaksi' => $detailtransaksi,
        );

        return view('pelanggan.detailpesanan', $data);
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
            'title'                => 'Detail Pesanan',
            'data_apps'            => Aplikasi::all(),
            'data_transaksi'       => $transaksi,
            'data_detailtransaksi' => $detailtransaksi,
        );

        return view('pelanggan.cetak', $data);
    }

    public function uploaddp(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $imageName = time().'.'.$request->bukti_dp->extension();
        $request->bukti_dp->move(public_path('fotoDP'), $imageName);

        $transaksi->update([
            'tgl_bayar' => date('Y-m-d'),
            'status'    => 'Proses',
            'bukti_dp'  => $imageName,
        ]);

        return redirect('/pesanan')->with('success', 'Upload Bukti Berhasil');
    }

    public function uploadlunas(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $imageName = time().'.'.$request->bukti_lunas->extension();
        $request->bukti_lunas->move(public_path('fotoLunas'), $imageName);

        $transaksi->update([
            'tgl_bayar'   => date('Y-m-d'),
            'status'      => 'Lunas',
            'bukti_lunas' => $imageName,
        ]);

        return redirect('/pesanan')->with('success', 'Upload Bukti Berhasil');
    }

    public function refund(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status'             => 'Refund',
            'norek_pelanggan'    => $request->norek_pelanggan,
            'bank_pelanggan'     => $request->bank_pelanggan,
            'atasnama_pelanggan' => $request->atasnama_pelanggan,
            'total_refund'       => $request->total_refund,
        ]);

        return redirect('/pesanan')->with('success', 'Uang Akan Di Refund');
    }
}
