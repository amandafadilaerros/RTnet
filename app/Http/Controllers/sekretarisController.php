<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun;

class sekretarisController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'dashboard';

        return view('sekretaris.dashboardSekretaris', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function dataPenduduk()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Penduduk',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_penduduk';

        return view('dataPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function akun()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun';

        return view('akunSekretaris', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function update_password(Request $request){
        $akun = akun::find(session()->get('id_akun'));
        
        // Validasi apakah password lama sesuai dengan yang tersimpan di database
        if ($request->old_password !== $akun->password) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.'])->withInput();
        }
        $akun->password = $request->password;
        $akun->save();

        return redirect('/sekretaris/akun')->with('success', 'Password berhasil diubah.');
    }
}
