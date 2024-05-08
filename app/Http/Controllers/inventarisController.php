<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\peminjaman_inventaris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class inventarisController extends Controller
{
    public function index()
    {

        // Ambil data inventaris dari database, termasuk data peminjaman
        $inventaris = Inventaris::select('inventaris.*', 'pi.tanggal_peminjaman', 'pi.tanggal_kembali')
            ->leftJoin('peminjaman_inventaris as pi', 'inventaris.id_inventaris', '=', 'pi.id_inventaris')
            ->get();

        $breadcrumb = (object) [
            'title' => 'Daftar Inventaris',
            'list' => [] // Definisikan properti list sebagai array kosong
        ];


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

    public function list(Request $request)
    {
        $inventaris = Inventaris::leftJoin('peminjaman_inventaris', 'inventaris.id_inventaris', '=', 'peminjaman_inventaris.id_inventaris')
            ->select('inventaris.id_inventaris', 'inventaris.nama_barang', 'inventaris.id_gambar', 'peminjaman_inventaris.tanggal_peminjaman')
            ->get();

        return DataTables::of($inventaris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                // Periksa apakah tanggal peminjaman tidak null
                if ($row->tanggal_peminjaman !== null) {
                    $currentDate = now(); // Tanggal saat ini
                    $peminjamanDate = Carbon::parse($row->tanggal_peminjaman); // Tanggal peminjaman
    
                    // Jika tanggal peminjaman masih dalam range tanggal saat ini, maka aksi adalah "Dipinjam", jika tidak, maka "Tersedia"
                    if ($peminjamanDate > $currentDate) {
                        $action = '<button class="btn btn-sm btn-success" style="border-radius: 20px;" disabled>Tersedia</button>';
                    } else {
                        $action = '<button class="btn btn-sm btn-danger" style="border-radius: 20px;" disabled>Dipinjam</button>';
                    }
                } else {
                    // Jika tanggal peminjaman null, maka barang tersedia
                    $action = '<button class="btn btn-sm btn-success" style="border-radius: 20px;" disabled>Tersedia</button>';
                }

                return $action;
            })
            ->rawColumns(['aksi']) // Menggunakan rawColumns agar HTML dapat di-render
            ->make(true);
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
        return view('inventaris_pk.peminjaman',[
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

        return view('inventaris_pk.peminjaman',[
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
