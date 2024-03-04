<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title'     => 'Data User',
            'data_user' => User::where('role', 'admin')->get(),
        );

        return view('admin.user.list', $data);
    }

    public function pelanggan()
    {
        $data = array(
            'title'          => 'Data Pelanggan',
            'data_pelanggan' => User::where('role', 'pelanggan')->get(),
        );

        return view('admin.pelanggan.list', $data);
    }
    // public function pelanggan2()
    // {
    //     $data = array(
    //         'title'          => 'Data Pelanggan',
    //         'data_pelanggan' => User::where('role', 'pelanggan')->get(),
    //     );

    //     return view('pelanggan.pelanggan.list', $data);
    // }

    public function store(Request $request)
    {
        User::create([
            'nama_user' => $request->nama_user,
            'nohp'      => $request->nohp,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'admin',
            'alamat'    => $request->alamat,
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Disimpan');
    }
    // public function store2(Request $request)
    // {
    //     User::create([
    //         'nama_user' => $request->nama_user,
    //         'nohp'      => $request->nohp,
    //         'email'     => $request->email,
    //         'password'  => Hash::make($request->password),
    //         'role'      => 'pelanggan',
    //         'alamat'    => $request->alamat,
    //     ]);

    //     return redirect('/pelanggan')->with('success', 'Data Berhasil Disimpan');
    // }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'nama_user' => $request->nama_user,
            'nohp'      => $request->nohp,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'admin',
            'alamat'    => $request->alamat,
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Diubah');
    }
    // public function update2(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     $user->update([
    //         'nama_user' => $request->nama_user,
    //         'nohp'      => $request->nohp,
    //         'email'     => $request->email,
    //         'password'  => Hash::make($request->password),
    //         'role'      => 'pelanggan',
    //         'alamat'    => $request->alamat,
    //     ]);

    //     return redirect('/pelanggan')->with('success', 'Data Berhasil Diubah');
    // }


    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/user')->with('success', 'Data Berhasil Dihapus');
    }
    // public function destroy2($id)
    // {
    //     $user = User::find($id);

    //     $user->delete();

    //     return redirect('/pelanggan')->with('success', 'Data Berhasil Dihapus');
    // }
}
