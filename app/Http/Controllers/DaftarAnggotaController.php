<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarAnggotaController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Keluarga Saya',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'DaftarAnggota';

        return view('DaftarAnggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
