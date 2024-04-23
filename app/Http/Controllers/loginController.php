<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function test(Request $request)
    {
        // ini hanya TEST
        // PENENTU ROLE
        $role = $request->family_number;
        $request->session()->put('role', $role);


        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'dashboard';

        // $barang = BarangModel::all();
        switch ($role) {
            case 'ketua_rt':
                return view('ketuaRT.dashboardKetuaRt', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
            case 'penduduk':
                return view('penduduk.dashboard', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
            case 'sekretaris':
                return view('sekretaris.dashboardSekretaris', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
            case 'bendahara':
                return view('bendahara.dashboardBendahara', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
        }
    }
}