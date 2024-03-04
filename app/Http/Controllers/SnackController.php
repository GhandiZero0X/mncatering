<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Snack;

class SnackController extends Controller
{
    public function index()
    {
        $data = array(
            'title'      => 'Data Snack',
            'data_snack' => Snack::all(),
        );

        return view('admin.snack.list', $data);
    }

    public function store(Request $request)
    {
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('fotoSnack'), $imageName);

        Snack::create([
            'nama_snack' => $request->nama_snack,
            'harga'      => $request->harga,
            'deskripsi'  => $request->deskripsi,
            'gambar'     => $imageName,
        ]);

        return redirect('/snack')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $snack = Snack::findOrFail($id);

        if($request->file('gambar') == "") {

            $snack->update([
                'nama_snack' => $request->nama_snack,
                'harga'      => $request->harga,
                'deskripsi'  => $request->deskripsi,
            ]);

        } else {

            unlink("fotoSnack/".$snack->gambar);

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('fotoSnack'), $imageName);

            $snack->update([
                'nama_snack' => $request->nama_snack,
                'harga'      => $request->harga,
                'deskripsi'  => $request->deskripsi,
                'gambar'     => $imageName,
            ]);
        }

        return redirect('/snack')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $snack = Snack::findOrFail($id);
        unlink("fotoSnack/".$snack->gambar);
        $snack->delete();

        return redirect('/snack')->with('success', 'Data Berhasil Dihapus');
    }
}