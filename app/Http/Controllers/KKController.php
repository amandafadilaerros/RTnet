<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kkModel;
use Yajra\DataTables\Facades\DataTables;

class KKController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Kartu Keluarga',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_kk';

        return view('dataKK', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function index1()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Kartu Keluarga',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_kk';

        return view('dataKKSekretaris', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function detail()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Kartu Keluarga',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_kk';

        return view('detailDataKK', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function list(Request $request){
        $kks = kkModel::select('no_kk','nama_kepala_keluarga', 'jumlah_individu', 'alamat', 'dokumen');

        return DataTables::of($kks)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kk) {
            $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $kk->no_kk .'"><i class="fas fa-pen"></i></a>  ';
            $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="'. $kk->no_kk .'"><i class="fas fa-trash"></i></a>  ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
}
