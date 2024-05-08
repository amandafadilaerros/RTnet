<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\IuranModel;
use App\Models\ktp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Columns\Action;
use App\Models\LaporanKeuangan;
use App\Models\Inventaris;
use App\Models\level;
use App\Models\Pengumumans;
use App\Models\peminjaman_inventaris;

class pendudukController extends Controller
{

    public function index()
    {
        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();

        // Ambil data untuk grafik garis dari kolom jenis_penduduk di dalam tabel ktps
        // $data_grafik = [
        //     'penduduk_tetap' => ktp::where('jenis_penduduk', 'Penduduk Tetap')->count(),
        //     'penduduk_kos' => ktp::where('jenis_penduduk', 'Penduduk Kos')->count()
        // ];

        // Inisialisasi variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        return view('penduduk.dashboard', compact('laporan_keuangan', 'inventaris', 'pengumuman', 'breadcrumb'));
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
        // Menghitung total pemasukan dari seluruh data
        $totalPemasukan = DB::table('iurans')
            ->where('jenis_transaksi', 'pemasukan')
            ->sum('nominal');

        // Menghitung total pengeluaran dari seluruh data
        $totalPengeluaran = DB::table('iurans')
            ->where('jenis_transaksi', 'pengeluaran')
            ->sum('nominal');

        // Menghitung saldo dari total pemasukan dan total pengeluaran
        $saldo = 0;

        // Mengambil semua data iuran
        $iuran = DB::table('iurans')->get();

        // Inisialisasi struktur data yang sesuai untuk DataTables
        $data = [];

        // Menambahkan setiap baris data iuran ke dalam struktur data
        foreach ($iuran as $row) {
            if ($row->jenis_transaksi === 'pemasukan') {
                $saldo += $row->nominal;
            } elseif ($row->jenis_transaksi === 'pengeluaran') {
                $saldo -= $row->nominal;
            }

            $data[] = [
                'jenis_transaksi' => $row->jenis_transaksi,
                'jenis_iuran' => $row->jenis_iuran,
                'pemasukan' => $row->jenis_transaksi === 'pemasukan' ? $row->nominal : 0,
                'pengeluaran' => $row->jenis_transaksi === 'pengeluaran' ? $row->nominal : 0,
                'saldo' => $saldo, // Set saldo pada setiap baris data
            ];
        }

        return DataTables::of($data)
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
            ->where(function ($query) use ($searchText) {
                $query->where(DB::raw('LOWER(jenis_transaksi)'), 'LIKE', "%" . strtolower($searchText) . "%")
                    ->orWhere(DB::raw('LOWER(jenis_iuran)'), 'LIKE', "%" . strtolower($searchText) . "%");
            })
            ->groupBy('jenis_transaksi', 'jenis_iuran')
            ->get();

        // Periksa apakah hasil pencarian kosong
        if ($results->isEmpty()) {
            // Jika hasil pencarian kosong, kirim pesan error ke pengguna
            return response()->json(['error' => 'Pencarian tidak mengembalikan hasil yang sesuai.'], 404);
        }

        // Kembalikan hasil pencarian dalam format JSON
        return response()->json(['data' => $results]);
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



    public function getInfoPeminjaman($id_inventaris)
    {
        // Menggunakan Eloquent untuk mengambil informasi peminjaman berdasarkan ID inventaris
        $inventaris = Inventaris::with('peminjaman')->find($id_inventaris);

        // Jika inventaris dengan ID yang diberikan tidak ditemukan, kembalikan respons dengan pesan kesalahan
        if (!$inventaris) {
            return response()->json(['error' => 'Inventaris not found'], 404);
        }

        // Jika inventaris ditemukan, ambil informasi peminjamannya
        $info_peminjaman = [
            'tanggal_peminjaman' => null,
            'tanggal_pengembalian' => null,
            'status_peminjaman' => 'Tersedia' // Status default jika tidak ada peminjaman
        ];

        // Jika ada data peminjaman, atur informasi peminjaman sesuai
        if ($inventaris->peminjaman) {
            $info_peminjaman['tanggal_peminjaman'] = $inventaris->peminjaman->tanggal_peminjaman;
            $info_peminjaman['tanggal_pengembalian'] = $inventaris->peminjaman->tanggal_kembali;

            // Jika tanggal pengembalian belum lewat, ubah status peminjaman menjadi 'Dipinjam'
            if ($inventaris->peminjaman->tanggal_kembali >= now()->toDateString()) {
                $info_peminjaman['status_peminjaman'] = 'Dipinjam';
            }
        }

        // Kembalikan informasi peminjaman sebagai respons JSON
        return response()->json($info_peminjaman);
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
