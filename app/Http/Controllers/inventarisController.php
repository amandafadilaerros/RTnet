<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventarisController extends Controller
{
    public function index()
    {
        // Hanya untuk testing template
        $breadcrumb = (object) [
            'title' => 'Inventaris',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'inventaris';

        // $barang = BarangModel::all();

        return view('inventaris.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        // Ambil data inventaris
        $inventaris = inventaris::select('id_inventaris', 'nama_barang', 'jumlah', 'id_gambar')->with('gambar');

        // ->get();

        return DataTables::of($inventaris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($inventaris) {
                $status = $inventaris->status;
                if ($status == 'Dipinjam') {
                    $btn = '<button class="btn btn-warning btn-sm" disabled>Dipinjam</button>';
                } elseif ($status == 'Tersedia') {
                    $btn = '<button class="btn btn-success btn-sm" disabled>Tersedia</button>';
                }
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pk_peminjaman()
    {
        // Hanya untuk testing template
        $breadcrumb = (object) [
            'title' => 'Daftar Peminjaman',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'peminjaman';

        // $barang = BarangModel::all();

        return view('inventaris_pk.peminjaman', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
