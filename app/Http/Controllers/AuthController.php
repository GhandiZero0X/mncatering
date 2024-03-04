<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Aplikasi;
use App\Models\Transaksi;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            return redirect()->intended('/home');
        }

        $updatetrans = Transaksi::where('status', 'Belum DP')->where('tgl_pesan', '<', Carbon::now()->subDays(1))->get();

        foreach ($updatetrans as $post) {
            $post->update([
                'status' => 'Batal',
            ]);
        }

        $data = array(
            'title'      => 'Login Page',
            'data_apps'  => Aplikasi::all(),
        );

        return view('index', $data);
    }

    public function cek_login(Request $request)
    {
        $password = $request->input('password');
        $email    = $request->input('email');

        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            if(Auth::user()->role == 'pelanggan') {
                return redirect()->intended('/homeUser')->with('success', 'Masuk Berhasil');

            }elseif(Auth::user()->role == 'admin') {
                return redirect()->intended('/home')->with('success', 'Masuk Berhasil');

            }else{
                return redirect()->intended('/login')->with('error', 'Email Atau Password Salah');
            }
        }
        else
        {
            return redirect()->intended('/login')->with('error', 'Email atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Keluar Berhasil');
    }

// ========================= REGISTER ==========================

    public function register()
    {
        if(Auth::user())
        {
            return redirect()->intended('/home');
        }

        $data = array(
            'title'      => 'Register Page',
            'data_apps'  => Aplikasi::all(),
        );

        return view('register', $data);
    }

    public function store(Request $request)
    {
        User::create([
            'nama_user' => $request->nama_user,
            'nohp'      => $request->nohp,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'pelanggan',
            'alamat'    => $request->alamat,
        ]);

        return redirect('/login')->with('success', 'Daftar Berhasil');
    }
}