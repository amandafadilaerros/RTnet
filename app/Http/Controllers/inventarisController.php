<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\kkModel;
use App\Models\peminjaman_inventaris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class inventarisController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Inventaris',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'inventaris';

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

        // Mengambil id inventaris yang sedang dipinjam dan menghitung jumlah barang yang sedang dipinjam
        $barang_dipinjam = peminjaman_inventaris::select('id_inventaris', DB::raw('count(*) as total_dipinjam'))
            ->groupBy('id_inventaris')
            ->get()
            ->keyBy('id_inventaris');

        return DataTables::of($inventaris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) use ($barang_dipinjam) {
                $dipinjam = $barang_dipinjam->get($row->id_inventaris)->total_dipinjam ?? 0;
                $tersedia = $row->jumlah - $dipinjam;
                if ($tersedia > 0) {
                    $action = '<button class="btn btn-sm btn-success" style="border-radius: 20px;" disabled>Tersedia = ' . $tersedia . '</button>';
                } else {
                    $action = '<button class="btn btn-sm btn-danger" style="border-radius: 20px;" disabled>Dipinjam</button>';
                }
                return $action;
            })
            ->addColumn('status', function ($row) use ($barang_dipinjam) {
                $dipinjam = $barang_dipinjam->get($row->id_inventaris)->total_dipinjam ?? 0;
                $tersedia = $row->jumlah - $dipinjam;
                return $tersedia > 0 ? 'Tersedia (' . $tersedia . ')' : 'Dipinjam';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function searchdate(Request $request)
    {
        $searchDate = $request->input('searchDate');

        // Query untuk mengambil inventaris yang tersedia pada tanggal tertentu
        $availableItems = DB::table('inventaris')
            ->leftJoin('peminjaman_inventaris', function ($join) use ($searchDate) {
                $join->on('inventaris.id_inventaris', '=', 'peminjaman_inventaris.id_inventaris')
                    ->whereDate('tanggal_peminjaman', '<=', $searchDate)
                    ->where(function ($query) use ($searchDate) {
                        $query->whereNull('tanggal_kembali')
                            ->orWhereDate('tanggal_kembali', '>', $searchDate);
                    });
            })
            ->select('inventaris.*')
            ->whereNull('peminjaman_inventaris.id_inventaris')
            ->get();

        // Mengembalikan data dalam bentuk respons JSON
        return response()->json($availableItems);
    }



    // public function show(Request $request)
    // {
    //     $peminjamanId = $request->input('peminjaman');

    //     // Mengambil data peminjaman inventaris berdasarkan ID
    //     $peminjaman = DB::table('peminjaman_inventaris')
    //         ->join('kks', 'peminjaman_inventaris.no_kk', '=', 'kks.no_kk')
    //         ->select('kks.nama_kepala_keluarga', 'kks.alamat', 'kks.no_rumah')
    //         ->where('peminjaman_inventaris.id_peminjaman', $peminjamanId)
    //         ->first();

    //     // Mengembalikan data dalam format JSON
    //     return response()->json($peminjaman);
    // }
    public function show(Request $request)
    {
        $no_kk = $request->input('no_kk');

        // Log input value for debugging
        Log::info('no_kk: ' . $no_kk);

        // Check if no_kk is provided
        if (!$no_kk) {
            Log::error('no_kk is not provided in the request');
            return response()->json(['error' => 'no_kk is required'], 400);
        }

        try {
            // Query to join peminjaman_inventaris with kks table
            $peminjam = DB::table('peminjaman_inventaris')
                ->join('kks', 'peminjaman_inventaris.no_kk', '=', 'kks.no_kk')
                ->select('kks.nama_kepala_keluarga', 'kks.alamat', 'kks.no_rumah', 'peminjaman_inventaris.*')
                ->where('peminjaman_inventaris.no_kk', $no_kk)
                ->first();

            // Log the result of the query for debugging
            Log::info('Query result: ' . json_encode($peminjam));

            if ($peminjam) {
                return response()->json([
                    'nama_kepala_keluarga' => $peminjam->nama_kepala_keluarga,
                    'alamat' => $peminjam->alamat,
                    'no_rumah' => $peminjam->no_rumah,
                    'data_peminjaman' => [
                        'id' => $peminjam->id,
                        'tanggal_peminjaman' => $peminjam->tanggal_peminjaman,
                        // Add other columns from the peminjaman_inventaris table as needed
                    ]
                ]);
            } else {
                Log::error('Data not found for no_kk: ' . $no_kk);
                return response()->json(['error' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error in querying data: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function pk_peminjaman()
    {
        $inventaris = inventaris::all();
        $minjams = peminjaman_inventaris::all();
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
        $tanggal_kembali = Carbon::now()->toDateString();

        $peminjaman = peminjaman_inventaris::find($request->id)->update([
            'tanggal_kembali' => $tanggal_kembali
        ]);

        return redirect('penduduk/peminjaman')->with('success', 'Terimakasih Sudah Mengembalikan Barangnya');
    }
}
