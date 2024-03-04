<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;

class AplikasiController extends Controller
{
    public function index()
    {
        $data = array(
            'title'     => 'Setting Apps',
            'data_apps' => Aplikasi::all(),
        );

        return view('admin.aplikasi.list', $data);
    }

    public function update(Request $request, $id)
    {
        $apps = Aplikasi::findOrFail($id);

        if($request->file('logo') == "" AND $request->file('banner') == "") {

            $apps->update([
                'nama_apps'   => $request->nama_apps,
                'nohp_apps'   => $request->nohp_apps,
                'email_apps'  => $request->email_apps,
                'alamat_apps' => $request->alamat_apps,
                'atas_nama'   => $request->atas_nama,
                'bank'        => $request->bank,
                'no_rek'      => $request->no_rek,
            ]);

        }elseif($request->file('logo') == "") {

            unlink("fotoApps/".$apps->banner);

            $imgBanner = $request->banner->getClientOriginalName();
            $request->banner->move(public_path('fotoApps'), $imgBanner);

            $apps->update([
                'nama_apps'   => $request->nama_apps,
                'nohp_apps'   => $request->nohp_apps,
                'email_apps'  => $request->email_apps,
                'alamat_apps' => $request->alamat_apps,
                'banner'      => $imgBanner,
                'atas_nama'   => $request->atas_nama,
                'bank'        => $request->bank,
                'no_rek'      => $request->no_rek,
            ]);

        }elseif($request->file('banner') == "") {

            unlink("fotoApps/".$apps->logo);

            $imgLogo = $request->logo->getClientOriginalName();
            $request->logo->move(public_path('fotoApps'), $imgLogo);

            $apps->update([
                'nama_apps'   => $request->nama_apps,
                'nohp_apps'   => $request->nohp_apps,
                'email_apps'  => $request->email_apps,
                'alamat_apps' => $request->alamat_apps,
                'logo'      => $imgLogo,
                'atas_nama'   => $request->atas_nama,
                'bank'        => $request->bank,
                'no_rek'      => $request->no_rek,
            ]);

        } else {

            unlink("fotoApps/".$apps->logo);
            unlink("fotoApps/".$apps->banner);

            $imageLogo = $request->logo->getClientOriginalName();
            $request->logo->move(public_path('fotoApps'), $imageLogo);

            $imageBanner = $request->banner->getClientOriginalName();
            $request->banner->move(public_path('fotoApps'), $imageBanner);

            $apps->update([
                'nama_apps'   => $request->nama_apps,
                'nohp_apps'   => $request->nohp_apps,
                'email_apps'  => $request->email_apps,
                'alamat_apps' => $request->alamat_apps,
                'logo'        => $imageLogo,
                'banner'      => $imageBanner,
                'atas_nama'   => $request->atas_nama,
                'bank'        => $request->bank,
                'no_rek'      => $request->no_rek,
            ]);
        }

        return redirect('/aplikasi')->with('success', 'Data Berhasil Di Ubah');
    }
}
