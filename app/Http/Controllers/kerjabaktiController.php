<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kerjabaktiController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Kerja Bakti',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'kerja_bakti';

        // $barang = BarangModel::all();

        return view('kerjabakti', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
