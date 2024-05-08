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
        // Ambil data inventaris
        $inventaris = inventaris::select('id_inventaris', 'nama_barang', 'jumlah', 'id_gambar')->with('gambar');

        return DataTables::of($inventaris)
            ->addIndexColumn()
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
