<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function test(Request $request){
        // ini hanya TEST
        // PENENTU ROLE
        $role = $request->family_number;

        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'dashboard';

        // $barang = BarangModel::all();
        switch ($role){
            case 'ketua_rt':
                return view('layouts.template', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
            case 'penduduk':
                return view('layouts.template', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
            case 'sekretaris':
                return view('layouts.template', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
            case 'bendahara':
                return view('layouts.template', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role]);
                break;
        }
    }
}
