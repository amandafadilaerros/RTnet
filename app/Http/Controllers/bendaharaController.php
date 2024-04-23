<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use Yajra\DataTables\Facades\DataTables;


class bendaharaController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'dashboard';

        return view('dashboardBendahara', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function keuangan()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'laporan_keuangan';

        return view('keuanganBendahara', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function akun()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun_saya';

        return view('akunBendahara', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function list(Request $request)
    {
        $bendaharas = iuranModel::select('nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk')->with('kk');

        //Filter data barang berdasarkan level_id
        if ($request->no_kk) {
            $bendaharas->where('no_kk', $request->no_kk);
        }
        return DataTables::of($bendaharas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($bendahara) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/bendahara/' . $bendahara->id_iuran) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/bendahara/' . $bendahara->id_iuran . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/bendahara/' . $bendahara->id_iuran) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}
