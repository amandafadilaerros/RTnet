<?php

namespace App\Http\Controllers;

use App\Models\IuranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Columns\Action;

class pendudukController extends Controller
{
    public function index()
    {
        // Definisikan variabel $breadcrumb
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan']
        ];

        // Kirimkan variabel $breadcrumb ke tampilan Blade
        return view('laporan_keuangan', ['breadcrumb' => $breadcrumb]);
    }


    public function show(string $id)
    {
        // Ganti model dan relasinya sesuai dengan model iuran dan detail transaksi
        $iuran = IuranModel::find($id);
        $laporan_keuangan = IuranModel::where('iuran_id', $id)->get();

        // Definisikan breadcrumb dan judul halaman
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan', 'Keuangan']
        ];

        $page = (object) [
            'title' => 'Laporan Keuangan'
        ];

        $activeMenu = 'Laporan Keuangan'; // Sesuaikan dengan menu yang sedang aktif

        // Kirimkan data ke tampilan Blade
        return view('iuran.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'laporanKeuangan' => $laporan_keuangan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan'],
        ];
        // Query untuk mengambil data laporan keuangan dari tabel iuran
        $laporan_keuangan = DB::table('iurans')
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
            $laporan_keuangan->where('id_iuran', $request->id_iuran);
        }

        // Lakukan penyesuaian jika diperlukan sesuai dengan struktur relasi antar model

        // Mengembalikan data dalam format DataTables
        return DataTables::of($laporan_keuangan) // Corrected import statement
            ->addIndexColumn()
            ->addColumn('aksi', function ($laporan) {
                // Check if the 'id_iuran' attribute exists in the data $laporan
                if (isset ($laporan->id_iuran)) {
                    $btn = '<a href="' . url('/iuran/' . $laporan->id_iuran) . '" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<a href="' . url('/iuran/' . $laporan->id_iuran . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="' . url('/iuran/' . $laporan->id_iuran) . '">' . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                } else {
                    // If the 'id_iuran' attribute is not available in the data, display "Not available" message
                    $btn = '<span class="text-muted">Tidak tersedia</span>';
                }
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
        $activeMenu = 'keuangan';

        return view('keuanganPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function kegiatan()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Kerja Bakti',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'kerja_bakti';

        return view('kerja_bakti', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function pengumuman()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Daftar Pengumuman',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'pengumuman';

        return view('pengumumanPenduduk', [
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
        $activeMenu = 'akun';

        return view('akunBendahara', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
}
