<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventarisController extends Controller
{
    public function index(){
        // hanya untuk testing template
        $breadcrumb = (object) [
            'title' => 'Inventaris',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'inventaris';

        // $barang = BarangModel::all();

        return view('inventaris.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
