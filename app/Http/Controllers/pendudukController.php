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
        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();

        // Inisialisasi variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        return view('penduduk/dashboard', [
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

    public function laporan(Request $request)
    {
        $iuran = DB::table('iurans')
            ->select(
                'jenis_transaksi',
                'jenis_iuran',
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pemasukan" THEN nominal ELSE 0 END) AS pemasukan'),
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pengeluaran" THEN nominal ELSE 0 END) AS pengeluaran'),
                DB::raw('SUM(nominal) AS saldo') // Jumlahkan semua nominal
            )
            ->groupBy('jenis_transaksi', 'jenis_iuran', 'nominal');


        return DataTables::of($iuran)
            ->addIndexColumn()
            ->make(true);

    }
    public function search(Request $request)
    {
        // Ambil nilai pencarian dari permintaan POST
        $searchText = $request->input('searchText');

        // Query SQL untuk mencari data berdasarkan nilai pencarian
        $results = DB::table('iurans')
            ->select(
                'jenis_transaksi',
                'jenis_iuran',
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pemasukan" THEN nominal ELSE 0 END) AS pemasukan'),
                DB::raw('SUM(CASE WHEN jenis_transaksi = "pengeluaran" THEN nominal ELSE 0 END) AS pengeluaran'),
                DB::raw('SUM(nominal) AS saldo')
            )
            ->groupBy('jenis_transaksi', 'jenis_iuran')
            ->havingRaw('LOWER(jenis_transaksi) LIKE ?', ["%$searchText%"])
            ->orWhereRaw('LOWER(jenis_iuran) LIKE ?', ["%$searchText%"])
            ->orWhereRaw('LOWER(pemasukan) LIKE ?', ["%$searchText%"])
            ->orWhereRaw('LOWER(pengeluaran) LIKE ?', ["%$searchText%"])
            ->orWhereRaw('LOWER(saldo) LIKE ?', ["%$searchText%"])
            ->get();

        // Kembalikan hasil pencarian dalam format JSON
        return response()->json($results);
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

        return view('penduduk/laporanKeuangan', [
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
