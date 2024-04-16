<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pengeluaranController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Pengeluaran',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'pengeluaran';

        // $barang = BarangModel::all();

        return view('pengeluaran', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
