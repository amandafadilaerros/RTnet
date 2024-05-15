<?php

namespace App\Http\Controllers;

use App\Models\pengumumans;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class pengumumanKetuaController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Pengumuman',
            'list' => ['Ketua RT', 'Pengumuman'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'kelola_pengumuman';

        return view('pengumumanKetua', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function list(Request $request){
        $pengumumans = pengumumans::select('id_pengumuman', 'judul', 'kegiatan', 'jadwal_pelaksanaan');

        // if ($request->kategori_id){
        //     $pengumumans->where('kategori_id', $request->kategori_id);
        // }

        return DataTables::of($pengumumans)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($barang) {
        //     $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $barang->id_pengumuman .'"><i class="fas fa-pen"></i></a>';
        //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal data-id="'. $barang->id_pengumuman .'"><i class="fas fa-trash"></i></a>';
        //     return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'judul' => 'bail|required',
            'kegiatan' => 'required',
            'jadwal' => 'required',
        ]);
        
        pengumumans::create([
            'judul' => $request->judul,
            'kegiatan' => $request->kegiatan,
            'jadwal_pelaksanaan' => $request->jadwal,
        ]);

        return redirect('/ketuaRt/kelola_pengumuman')->with('success', 'Data pengumuman berhasil disimpan');
    }
    public function getData(Request $request){
        $idPengumuman = $request->id_pengumuman;

        // Lakukan apa pun yang diperlukan dengan ID inventaris
        // Di sini Anda dapat melakukan pencarian atau operasi lainnya
        $pengumuman = pengumumans::find($idPengumuman);

        // Misalnya, mengembalikan data pengumuman dalam format JSON
        return response()->json($pengumuman);
    }
    public function update(Request $request,){
        $request->validate([
            'judul' => 'bail|required',
            'kegiatan' => 'required',
        ]);
    
        // Lakukan pembaruan
        pengumumans::find($request->id_pengumuman)->update([
            'judul' => $request->judul,
            'kegiatan' => $request->kegiatan,
            'jadwal_pelaksanaan' => $request->jadwal,
        ]);

        return redirect('/ketuaRt/kelola_pengumuman')->with('success', 'Data pengumuman berhasil diubah');
    }
    public function destroy(Request $request){
        $check = pengumumans::find($request->id_pengumuman);
        if(!$check) {
            return redirect('/ketuaRt/kelola_pengumuman')->with('error', 'Data pengumuman tidak ditemukan');
        }

        try{
            pengumumans::destroy($request->id_pengumuman);

            return redirect('/ketuaRt/kelola_pengumuman')->with('success', 'Data pengumuman berhasil dihapus');
        }catch (\illuminate\Database\QueryException $e){
            return redirect('/ketuaRt/kelola_pengumuman')->with('error', 'Data pengumuman gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
