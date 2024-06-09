<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use App\Models\ktp;
use App\Models\peminjaman_inventaris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class daftar_peminjamanController extends Controller
{
    public function index(){
        $inventaris = inventaris::all();
        $kos = ktp::all()->where('jenis_penduduk', 'kos');
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Daftar Peminjaman',
            'list' => ['Ketua RT', 'Peminjaman'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'daftar_peminjaman';

        // $barang = BarangModel::all();

        return view('ketuaRT.daftar_peminjaman', ['inventaris' => $inventaris, 'kos' => $kos, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request){
        $yesterday = Carbon::yesterday();
        $xDaysAgo = $yesterday->copy()->subDays(5);
        
        $peminjamans = peminjaman_inventaris::select('id_peminjaman', 'id_inventaris', 'id_peminjam', 'jumlah_peminjaman', 'tanggal_peminjaman', 'tanggal_kembali')->with(['inventaris', 'kks'])
        ->where(function ($query) use ($xDaysAgo) {
            $query->whereNull('tanggal_kembali')
                  ->orWhere('tanggal_kembali', '>', $xDaysAgo);
        });

        // if ($request->kategori_id){
        //     $barangs->where('kategori_id', $request->kategori_id);
        // }
        if ($request->has('customSearch') && !empty($request->customSearch)) {
            $search = $request->customSearch;
            $peminjamans->where(function($query) use ($search) {
                $query->where('id_peminjam', 'like', "%{$search}%");
            });
        }
        $peminjamans = $peminjamans->get();

        return DataTables::of($peminjamans)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($inventaris) {
        //     $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $inventaris->id_inventaris .'"><i class="fas fa-pen"></i></a>';
        //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal data-id="'. $inventaris->id_inventaris .'"><i class="fas fa-trash"></i></a>';
        //     return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'no_kk' => 'required',
            'id_inventaris' => 'bail|required',
        ]);
        $today = Carbon::now();
        peminjaman_inventaris::create([
            'id_inventaris' => $request->id_inventaris,
            'jumlah_peminjaman' => 1,
            'id_peminjam' => $request->no_kk,
            'tanggal_peminjaman' => $today
        ]);

        return redirect('/ketuaRt/daftar_peminjaman')->with('success', 'peminjaman telah disimpan');
    }
    public function update($id){
        peminjaman_inventaris::find($id)->update([
            'tanggal_kembali' => now()
        ]);
        return redirect('/ketuaRt/daftar_peminjaman')->with('success', 'Inventaris telah dikembalikan');
    }
}
