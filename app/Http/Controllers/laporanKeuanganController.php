<?php

namespace App\Http\Controllers;

use App\Models\IuranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Yajra\DataTables\Facades\DataTables;

class laporanKeuanganController extends Controller
{
    public function index()
    {
        // Definisikan variabel $breadcrumb
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan']
        ];

        // Kirimkan variabel $breadcrumb ke tampilan Blade
        return view('laporankeuangan', ['breadcrumb' => $breadcrumb]);
    }

    public function list(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan'],
        ];
        // Query untuk mengambil data laporan keuangan dari tabel iuran
        $laporanKeuangan = DB::table('iurans')
            ->select(
                'jenis_transaksi',
                'jenis_iuran',
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pemasukan" THEN nominal ELSE 0 END) AS pemasukan'),
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pengeluaran" THEN nominal ELSE 0 END) AS pengeluaran'),
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pemasukan" THEN nominal ELSE -nominal END) AS saldo')
            )
            ->groupBy('jenis_transaksi', 'jenis_iuran');

        // Filter data iuran berdasarkan id_iuran (jika perlu)
        if ($request->id_iuran) {
            $laporanKeuangan->where('id_iuran', $request->id_iuran);
        }

        // Lakukan penyesuaian jika diperlukan sesuai dengan struktur relasi antar model

        // Mengembalikan data dalam format DataTables
        return DataTables::of($laporanKeuangan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($laporan) {
                $btn = '<a href="' . url('/iuran/' . $laporan->id_iuran) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/iuran/' . $laporan->id_iuran . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/iuran/' . $laporan->id_iuran) . '">' . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function keuangan()
    {
        // Menginisialisasi variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan'],
        ];

        // Mengirimkan data ke tampilan Blade
        return view('keuanganBendahara', ['breadcrumb' => $breadcrumb]);
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
}

