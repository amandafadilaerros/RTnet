<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rumahModel;
use Yajra\DataTables\Facades\DataTables;

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

    public function list(Request $request){
        $rumahs = rumahModel::select('no_rumah', 'status_rumah');

        return DataTables::of($rumahs)
        ->addIndexColumn()
        ->addColumn('aksi', function ($rumah) {
            $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $rumah->no_rumah .'"><i class="fas fa-pen"></i></a>  ';
            $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="'. $rumah->no_rumah .'"><i class="fas fa-trash"></i></a>  ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
}

