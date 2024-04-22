<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class data_rumahController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Rumah',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'data_rumah';

        // $barang = BarangModel::all();

        return view('data_rumah', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
