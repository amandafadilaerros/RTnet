<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pemasukanController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Pemasukan',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'pemasukan';

        // $barang = BarangModel::all();

        return view('pemasukan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
