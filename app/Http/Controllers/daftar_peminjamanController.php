<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class daftar_peminjamanController extends Controller
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

        $activeMenu = 'daftar_peminjaman';

        // $barang = BarangModel::all();

        return view('daftar_peminjaman', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
