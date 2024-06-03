<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\iuranModel;
use App\Models\ktp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Columns\Action;
use App\Models\LaporanKeuangan;
use App\Models\inventaris;
use App\Models\level;
use App\Models\pengumumans;
use App\Models\peminjaman_inventaris;
use Illuminate\Support\Facades\Auth;

class pendudukController extends Controller
{



    public function index()
    {
        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();

        // Ambil data untuk grafik garis dari kolom jenis_penduduk di dalam tabel ktps
        $data_grafik = [
            'pendudukTetapCount' => ktp::where('jenis_penduduk', 'Penduduk Tetap')->count(),
            'pendudukKosCount' => ktp::where('jenis_penduduk', 'Penduduk Kos')->count()
        ];

        // Ambil jumlah penduduk berdasarkan bulan
        $pendudukData = Ktp::select(
            DB::raw('MONTH(tgl_masuk) as bulan'),
            DB::raw('count(*) as total_penduduk')
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Mengubah data menjadi format yang lebih mudah digunakan di JavaScript
        $data_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_bulan[$i] = 0; // Inisialisasi setiap bulan dengan nilai 0
        }
        foreach ($pendudukData as $item) {
            $data_bulan[$item->bulan] = $item->total_penduduk;
        }

        // Inisialisasi variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        return view('penduduk.dashboard', compact('laporan_keuangan', 'inventaris', 'pengumuman', 'data_grafik', 'data_bulan', 'breadcrumb'));
    }



    public function getData()
    {
        // Mengambil jumlah penduduk tetap
        $pendudukTetapCount = ktp::where('jenis_penduduk', 'Penduduk Tetap')->count();

        // Mengambil jumlah penduduk kos
        $pendudukKosCount = ktp::where('jenis_penduduk', 'Penduduk Kos')->count();

        // Mengambil jumlah total penduduk
        $totalPendudukCount = ktp::count();

        // Mengirimkan data dalam format JSON
        return response()->json([
            'penduduk_tetap' => $pendudukTetapCount,
            'penduduk_kos' => $pendudukKosCount,
            'total_penduduk' => $totalPendudukCount
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
        // Menghitung total pemasukan dari seluruh data
        $totalPemasukan = DB::table('iurans')
            ->where('jenis_transaksi', 'pemasukan')
            ->sum('nominal');

        // Menghitung total pengeluaran dari seluruh data
        $totalPengeluaran = DB::table('iurans')
            ->where('jenis_transaksi', 'pengeluaran')
            ->sum('nominal');

        // Inisialisasi saldo awal
        $saldo = 0;

        // Mengambil semua data iuran
        $iurans = DB::table('iurans')->get();

        // Inisialisasi array untuk menyimpan data yang akan dikirim ke DataTables
        $data = [];

        // Looping untuk menyiapkan data sesuai format DataTables
        foreach ($iurans as $index => $row) {
            // Menghitung saldo berdasarkan jenis transaksi
            if ($row->jenis_transaksi === 'pemasukan') {
                $saldo += $row->nominal;
            } elseif ($row->jenis_transaksi === 'pengeluaran') {
                $saldo -= $row->nominal;
            }

            // Mengambil keterangan dari tabel inventaris jika jenis_iuran ada
            $keterangan = ''; // Inisialisasi keterangan

            // Cek apakah jenis_iuran ada, lalu ambil nilainya
            if (!empty($row->keterangan)) {
                // Misalnya, jika jenis_iuran adalah nama kolom di tabel iurans
                $keterangan = $row->keterangan;
            }

            // Menyiapkan baris data untuk DataTables
            $data[] = [
                'DT_RowIndex' => $index + 1, // Nomor urut
                'jenis_iuran' => $row->jenis_iuran,
                'pemasukan' => $row->jenis_transaksi === 'pemasukan' ? $row->nominal : 0,
                'pengeluaran' => $row->jenis_transaksi === 'pengeluaran' ? $row->nominal : 0,
                'saldo' => $saldo,
                'keterangan' => $keterangan, // Kolom keterangan
            ];
        }


        // Mengirimkan data menggunakan DataTables
        return DataTables::of($data)
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


    public function searching(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        // dd($search);
        // dd($search);

        $inventaris = inventaris::all();
        // Search in the title and body columns from the posts table
        $minjams = peminjaman_inventaris::with('inventaris')
                    ->whereHas('inventaris', function($query) use ($search) {
        $query->where('nama_barang', 'LIKE', "%{$search}%");
    })
    ->get();

        // dd($minjams);
    
        // Return the search view with the resluts compacted
        $breadcrumb = (object) [
            'title' => 'Daftar Peminjaman',
            'list' => [date('j F Y')],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'peminjaman';

        return view('inventaris_pk.peminjaman', [
            'minjams' => $minjams,
            'inventaris' => $inventaris,
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
        $inventaris = Inventaris::find($id_inventaris);

        // Jika inventaris dengan ID yang diberikan tidak ditemukan, kembalikan respons dengan pesan kesalahan
        if (!$inventaris) {
            return response()->json(['error' => 'Inventaris not found'], 404);
        }

        // Ambil informasi peminjaman terbaru untuk inventaris ini
        $latest_peminjaman = $inventaris->peminjaman()->latest()->first();

        // Jika tidak ada data peminjaman, statusnya 'Tersedia'
        $info_peminjaman = [
            'tanggal_peminjaman' => null,
            'tanggal_pengembalian' => null,
            'status_peminjaman' => 'Tersedia'
        ];

        // Jika ada data peminjaman, atur informasi peminjaman sesuai
        if ($latest_peminjaman) {
            $info_peminjaman['tanggal_peminjaman'] = $latest_peminjaman->tanggal_peminjaman;
            $info_peminjaman['tanggal_pengembalian'] = $latest_peminjaman->tanggal_kembali;

            // Jika tanggal pengembalian belum lewat, ubah status peminjaman menjadi 'Dipinjam'
            if ($latest_peminjaman->tanggal_kembali >= now()->toDateString()) {
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

    public function list_pengumuman(Request $request)
    {
        $pengumumans = Pengumumans::select('id_pengumuman', 'judul', 'kegiatan', 'jadwal_pelaksanaan');

        if ($request->has('customSearch') && !empty($request->customSearch)) {
            $search = $request->customSearch;
            $pengumumans->where(function($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%");
            });
        }
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
        // Assuming you want to fetch the authenticated user's account
        $akun = Auth::user();

        // Fetch all levels from the database
        $levels = level::all();

        // Breadcrumb and page information
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => [date('j F Y')],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun';

        // Pass the data to the view
        return view('akunPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'akun' => $akun,
            'levels' => $levels,
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

        return view('penduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'akun' => $akun,
            'level' => $level
        ]);
    }

    public function update_password(Request $request)
    {
        $akun = akun::find(session()->get('id_akun'));

        // Validasi apakah password lama sesuai dengan yang tersimpan di database
        if ($request->old_password !== $akun->password) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.'])->withInput();
        }
        $akun->password = $request->password;
        $akun->save();

        return redirect('/penduduk/akun')->with('success', 'Password berhasil diubah.');
    }



}
