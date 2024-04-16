<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class peminjamanController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Daftar Peminjaman',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'peminjaman';

        // $barang = BarangModel::all();

        return view('peminjaman', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
