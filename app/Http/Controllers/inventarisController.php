<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use App\Models\kkModel;
use App\Models\peminjaman_inventaris;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $inventaris = Inventaris::leftJoin('peminjaman_inventaris', 'inventaris.id_inventaris', '=', 'peminjaman_inventaris.id_inventaris')
            ->select('inventaris.*', 'peminjaman_inventaris.id_peminjam')
            ->distinct()
            ->get();

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
                    return '<button class="btn btn-sm btn-success pinjam-btn" style="border-radius: 20px;" data-id="' . $row->id_inventaris . '" data-nama-barang="' . $row->nama_barang . '" data-toggle="modal" data-target="#konfirmasiModal">Tersedia = ' . $tersedia . '</button>';
                } else {
                    $buttonDetailPeminjam = '';
                    if ($row->id_peminjam) {
                        $buttonDetailPeminjam = '<a href="#" class="btn btn-sm btn-danger" style="border-radius: 20px;" data-toggle="modal" data-target="#viewModalAnggota" data-no-kk="' . $row->id_peminjam . '">Dipinjam</a>';
                    }
                    return $buttonDetailPeminjam;
                }
            })
            ->editColumn('status', function ($row) use ($barang_dipinjam) {
                $dipinjam = $barang_dipinjam->get($row->id_inventaris)->total_dipinjam ?? 0;
                $tersedia = $row->jumlah - $dipinjam;

                if ($tersedia > 0) {
                    return 'Tersedia = ' . $tersedia;
                } else {
                    return 'Dipinjam';
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function pinjam(Request $request)
    {
        $ids = $request->id_inventaris;

        // Lakukan apa pun yang diperlukan dengan ID inventaris
        // Di sini Anda dapat melakukan pencarian atau operasi lainnya
        $inventaris = Inventaris::find($ids);

        // Misalnya, mengembalikan data inventaris dalam format JSON
        return response()->json($inventaris);
    }
    // Controller Method
    public function pinjamBarang(Request $request)
    {
        try {
            // Ambil id_peminjam dari sesi
            $idPeminjam = $request->session()->get('id_akun');

            // Ambil id_inventaris dari request
            $idInventaris = $request->input('id_inventaris');

            // Dapatkan tanggal peminjaman saat ini
            $tanggalPeminjaman = now();
            $jumlahPeminjaman = 1;

            // Cek ketersediaan barang
            $inventaris = Inventaris::find($idInventaris);
            $dipinjam = peminjaman_inventaris::where('id_inventaris', $idInventaris)->count();
            $tersedia = $inventaris->jumlah - $dipinjam;

            // Jika barang tidak tersedia atau hanya tersedia satu, kembalikan dengan pesan error
            if ($tersedia <= 0) {
                return redirect()->back()->with('error', 'Gagal meminjam barang. Semua barang sudah dipinjam atau hanya tersisa satu.');
            }

            // Insert ke dalam tabel peminjaman_inventaris jika barang tersedia
            DB::table('peminjaman_inventaris')->insert([
                'id_inventaris' => $idInventaris,
                'id_peminjam' => $idPeminjam,
                'jumlah_peminjaman' => $jumlahPeminjaman,
                'tanggal_peminjaman' => $tanggalPeminjaman,
                'created_at' => $tanggalPeminjaman,
                'updated_at' => $tanggalPeminjaman
            ]);

            return redirect()->back()->with('success', 'Berhasil meminjam barang.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal meminjam barang. ' . $e->getMessage());
        }
    }







    public function show(Request $request)
    {
        $no_kk = $request->no_kk;

        // Log input value for debugging
        Log::info('no_kk: ' . $no_kk);

        // Check if no_kk is provided
        if (!$no_kk) {
            Log::error('no_kk is not provided in the request');
            return response()->json(['error' => 'no_kk is required'], 400);
        }

        try {
            // Query to join peminjaman_inventaris with ktps table
            $detail = DB::table('peminjaman_inventaris')
                ->leftJoin('kks', 'peminjaman_inventaris.id_peminjam', '=', 'kks.no_kk')
                ->select('kks.*', 'peminjaman_inventaris.id_peminjaman', 'peminjaman_inventaris.tanggal_peminjaman')
                ->where('peminjaman_inventaris.id_peminjam', $no_kk)
                ->first();

            if ($detail) {
                // Data peminjam ditemukan
                $peminjam = kkModel::where('no_kk', $detail->no_kk)->first();

                if ($peminjam) {
                    // Return response with peminjam and peminjaman inventaris data
                    return response()->json([
                        'nama_kepala_keluarga' => $peminjam->nama_kepala_keluarga,
                        'alamat' => $peminjam->alamat,
                        'no_rumah' => $peminjam->no_rumah,
                        'data_peminjaman' => [
                            'id' => $detail->id_peminjaman,
                            'tanggal_peminjaman' => $detail->tanggal_peminjaman,
                            // Add other columns from the peminjaman_inventaris table as needed
                        ]
                    ]);
                } else {
                    Log::error('Data not found for no_kk: ' . $no_kk);
                    return response()->json(['error' => 'Data peminjam not found'], 404);
                }
            } else {
                Log::error('Data not found for no_kk: ' . $no_kk);
                return response()->json(['error' => 'Data peminjaman inventaris not found'], 404);
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

}
