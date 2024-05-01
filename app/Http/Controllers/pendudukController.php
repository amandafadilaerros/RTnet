<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\IuranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Columns\Action;
use App\Models\LaporanKeuangan;
use App\Models\Inventaris;
use App\Models\level;
use App\Models\Pengumumans;

class pendudukController extends Controller
{
    public function index()
    {
        // $laporan_keuangan = IuranModel::all();
        // // $laporan_keuangan_count = LaporanKeuangan::count();
        // $inventaris = Inventaris::count();
        // $pengumuman = Pengumumans::count();

        // return view('penduduk/dashboard', compact('laporan_keuangan', 'inventaris', 'pengumuman'));


        $breadcrumb = (object) [
            'title' => 'dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'dashboard';

        return view('penduduk.dashboard', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
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
        $iuran = DB::table('iurans')
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
            $iuran->where('id_iuran', $request->id_iuran);
        }

        // Mengembalikan data dalam format DataTables
        return DataTables::of($iuran) // Corrected import statement
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
            'list' => [date('j F Y')],
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

    public function list_pengumuman()
    {
        $pengumumans = Pengumumans::select('id_pengumuman', 'judul', 'kegiatan', 'jadwal_pelaksanaan');

        return DataTables::of($pengumumans)
            ->addIndexColumn() // Add index column
            ->addColumn('aksi', function ($pengumuman) { // Add action column
                $btn = '<a href="' . url('/penduduk/showPengumumanPenduduk/' . $pengumuman->id_pengumuman) . '" class="btn btn-info btn-sm">Detail</a> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Let DataTables know that the action column is HTML
            ->make(true);
    }

    public function show_pengumuman(string $id)
    {
        $pengumumans = Pengumumans::find($id);
        
        $breadcrumb = (object) [
            'title' => 'Pengumuman',
            'list' => [date('j F Y')],
        ];

        $page = (object) [
            'title' => 'Pengumuman'
        ];

        $activeMenu = 'pengumuman';

        return view('showPengumumanPenduduk', ['breadcrumb' => $breadcrumb, 'page' => $page, 'pengumuman' => $pengumumans, 'activeMenu' => $activeMenu]);
    }
    public function akun()
    {   
        $akun = akun::find(4);
        $level = level::all();
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => [date('j F Y')],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun';

        return view('akunPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'akun' => $akun,
            'level' => $level
        ]);
    }

    public function edit_akun()
    {
        $akun = akun::find(4);
        $level = level::all();
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => [date('j F Y')],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun';

        return view('akunPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'akun' => $akun,
            'level' => $level
        ]);
    }

    public function update_akun(Request $request)
    {
        $request->validate([
            'password' => 'required',
          
        ]);

        akun::where('id_akun', 4)->update([
            'password' => $request->password,
            
        ]);

        return redirect('/penduduk/akun')->with('success', 'Akun berhasil diubah');
    }
}
