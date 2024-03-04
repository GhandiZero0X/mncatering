<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Snack;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Home Page',

            'count_pelanggan' => User::where('role', 'pelanggan')->count(),
            'count_snack'     => Snack::count(),
            'count_transaksi' => Transaksi::count(),

            'count_belumdp'    => Transaksi::where('status', 'Belum DP')->count(),
            'count_proses'     => Transaksi::where('status', 'Proses')->count(),
            'count_belumlunas' => Transaksi::where('status', 'Belum Lunas')->count(),
            'count_lunas'      => Transaksi::where('status', 'Lunas')->count(),
            'count_tolak'      => Transaksi::where('status', 'Tolak')->count(),

            'count_refund'     => Transaksi::where('status', 'Refund')->count(),
            'count_selesai'    => Transaksi::where('status', 'Selesai Refund')->count(),
        );

        return view('home',$data);
    }
}
