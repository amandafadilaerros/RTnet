<?php

namespace App\Http\Controllers;

use App\Models\peminjaman_inventaris;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class daftar_peminjamanController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Daftar Peminjaman',
            'list' => ['Ketua RT', 'Peminjaman'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'daftar_peminjaman';

        // $barang = BarangModel::all();

        return view('ketuaRT.daftar_peminjaman', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request){
        $peminjamans = peminjaman_inventaris::select('id_inventaris', 'id_peminjam', 'jumlah_peminjaman', 'tanggal_peminjaman', 'tanggal_kembali')->with('inventaris');

        // if ($request->kategori_id){
        //     $barangs->where('kategori_id', $request->kategori_id);
        // }

        return DataTables::of($peminjamans)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($inventaris) {
        //     $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $inventaris->id_inventaris .'"><i class="fas fa-pen"></i></a>';
        //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal data-id="'. $inventaris->id_inventaris .'"><i class="fas fa-trash"></i></a>';
        //     return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }
}
