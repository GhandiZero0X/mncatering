<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Snack;
use App\Models\Aplikasi;
use Carbon\Carbon;
use App\Models\Transaksi;

class PagesController extends Controller
{
    public function index()
    {
        $updatetrans = Transaksi::where('status', 'Belum DP')->where('tgl_pesan', '<', Carbon::now()->subDays(1))->get();

        foreach ($updatetrans as $post) {
            $post->update([
                'status' => 'Batal',
            ]);
        }

        $data = array(
            'title'      => 'Home Page',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::orderBy('id', 'DESC')->limit(4)->get(),
        );

        return view('pages.index', $data);
    }

    public function shop()
    {
        $data = array(
            'title'      => 'Data Shop',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::orderBy('id', 'DESC')->simplePaginate(8),
        );

        return view('pages.shop', $data);
    }

    public function detailshop($id)
    {
        $data = array(
            'title'      => 'Data Detail Shop',
            'data_apps'  => Aplikasi::all(),
            'data_snack' => Snack::where('id', $id)->get(),
            'like_snack' => Snack::limit(6)->get(),
        );

        return view('pages.detailshop', $data);
    }
}
