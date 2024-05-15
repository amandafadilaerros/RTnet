<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\peminjaman_inventaris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class inventarisController extends Controller
{
    public function index()
    {


        // Hanya untuk testing template
        $breadcrumb = (object) [
            'title' => 'Daftar Inventaris',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'inventaris';

        // $barang = BarangModel::all();

        return view('penduduk.daftar_inventaris', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function list()
    {
        // Mengambil semua inventaris
        $inventaris = Inventaris::all();

        // Mengambil id inventaris yang sedang dipinjam
        $barang_dipinjam = peminjaman_inventaris::pluck('id_inventaris')->toArray();

        // Menghitung jumlah barang yang tersedia
        $jumlah_tersedia = 0;

        foreach ($inventaris as $barang) {
            // Jumlah barang yang tersedia adalah jumlah total dikurangi jumlah yang dipinjam
            $jumlah_tersedia += $barang->jumlah;
        }

        // Jumlah barang yang dipinjam
        $jumlah_dipinjam = count($barang_dipinjam);

        // Menentukan status berdasarkan jumlah barang tersedia dan dipinjam
        if ($jumlah_tersedia > 0) {
            $status = 'Tersedia (' . $jumlah_tersedia . ')';
        } else {
            $status = 'Dipinjam (' . $jumlah_dipinjam . ')';
        }

        return DataTables::of($inventaris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) use ($barang_dipinjam) {
                // Periksa apakah barang sedang dipinjam
                if (in_array($row->id_inventaris, $barang_dipinjam)) {
                    $action = '<button class="btn btn-sm btn-danger" style="border-radius: 20px;" disabled>Dipinjam</button>';
                } else {
                    $action = '<button class="btn btn-sm btn-success" style="border-radius: 20px;" disabled>Tersedia</button>';
                }
                return $action;
            })
            ->addColumn('status', function ($row) {
                // Tampilkan status berdasarkan jumlah barang tersedia
                if ($row->jumlah > 0) {
                    return 'Tersedia (' . $row->jumlah . ')';
                } else {
                    return 'Dipinjam';
                }
            })
            ->rawColumns(['aksi']) // Menggunakan rawColumns agar HTML dapat di-render
            ->make(true);
    }


    public function searchdate(Request $request)
    {
        // Terima parameter tanggal pencarian dari permintaan HTTP
        $searchDate = $request->input('searchDate');

        // Mengambil data barang yang tersedia pada tanggal tertentu
        $inventaris = Inventaris::whereNotExists(function ($query) use ($searchDate) {
            $query->select('id_inventaris')
                ->from('peminjaman_inventaris')
                ->whereColumn('peminjaman_inventaris.id_inventaris', 'inventaris.id_inventaris')
                ->whereDate('tanggal_peminjaman', '=', $searchDate);
        })->get();

        // Format data untuk DataTables
        $dataTable = DataTables::of($inventaris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                // Logika untuk menentukan aksi (Tersedia/Dipinjam)
                return $row->jumlah > 0 ? '<button class="btn btn-sm btn-success" style="border-radius: 20px;" disabled>Tersedia</button>' : '<button class="btn btn-sm btn-danger" style="border-radius: 20px;" disabled>Dipinjam</button>';
            })
            ->addColumn('status', function ($row) {
                // Tampilkan status berdasarkan jumlah barang tersedia
                return $row->jumlah > 0 ? 'Tersedia (' . $row->jumlah . ')' : 'Dipinjam';
            })
            ->rawColumns(['aksi']); // Menggunakan rawColumns agar HTML dapat di-render

        return $dataTable->make(true);
    }


    public function show($id)
    {
        // Eksekusi query untuk mendapatkan data peminjam
        $peminjam = DB::table('peminjaman_inventaris')
            ->join('ktps', 'peminjaman_inventaris.NIK', '=', 'ktps.NIK')
            ->select('ktps.nama', 'ktps.jenis_kelamin')
            ->where('peminjaman_inventaris.NIK', $id) // Filter berdasarkan $id
            ->first(); // Menggunakan first() karena Anda hanya ingin satu baris data

        // Mengembalikan data dalam bentuk JSON
        return response()->json($peminjam);
    }



    public function pk_peminjaman()
    {
        // $minjams = peminjaman_inventaris::select('tanggal_peminjaman','tanggal_kembali')->with('inventaris')->get();
        $inventaris = inventaris::all();
        $minjams = peminjaman_inventaris::all();
        // Hanya untuk testing template
        $breadcrumb = (object) [
            'title' => 'Daftar Peminjaman',
            'list' => [date('j F Y')],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'peminjaman';

        // $barang = BarangModel::all();
        // dd($minjams);
        return view('inventaris_pk.peminjaman', [
            'minjams' => $minjams,
            'inventaris' => $inventaris,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function store_peminjaman(string $id)
    {
        $minjams = peminjaman_inventaris::find($id);

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
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function update_peminjaman(Request $request)
    {

        // Untuk pengolahan waktu yang lebih baik

        // Mendapatkan tanggal hari ini
        $tanggal_kembali = Carbon::now()->toDateString();

        // Melakukan update dengan menggunakan tanggal hari ini
        $peminjaman = peminjaman_inventaris::find($request->id)->update([
            'tanggal_kembali' => $tanggal_kembali
        ]);


        return redirect('penduduk/peminjaman')->with('success', 'Terimakasih Sudah Mengembalikan Barangnya');
    }
}
