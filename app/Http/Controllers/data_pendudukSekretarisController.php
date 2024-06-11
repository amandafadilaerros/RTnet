<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\kkModel;
use App\Models\ktp;
use App\Models\penduduk_tetapModel;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class data_pendudukSekretarisController extends Controller
{
    public function index(){
        // menampilkan halaman awal data penduduk
        // menampilkan halaman awal data penduduk
        $breadcrumb = (object) [
            'title' => 'Data Penduduk',
            'list' => ['Home', 'Data Penduduk'],
            'list' => ['Home', 'Data Penduduk'],
        ];
        $page = (object) [
            'title' => 'Daftar data penduduk yang terdaftar dalam sistem ',
            'title' => 'Daftar data penduduk yang terdaftar dalam sistem ',
        ];

        $activeMenu = 'data_penduduk';
        $ktps = penduduk_tetapModel::all();
        // return view('data_penduduk.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk , 'activeMenu' => $activeMenu]);
        return view('data_pendudukSekretaris', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        $ktps = penduduk_tetapModel::select('nik','no_kk', 'nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'status_anggota', 'jenis_penduduk', 'tgl_masuk', 'tgl_keluar', 'dokumen')->where('tgl_keluar', null);
        if ($request->has('customSearch') && !empty($request->customSearch)) {
            $search = $request->customSearch;
            $ktps->where(function($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                ->orWhere('no_kk', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('tempat', 'like', "%{$search}%")
                ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                ->orWhere('golongan_darah', 'like', "%{$search}%")
                ->orWhere('agama', 'like', "%{$search}%")
                ->orWhere('status_perkawinan', 'like', "%{$search}%")
                ->orWhere('pekerjaan', 'like', "%{$search}%")
                ->orWhere('status_keluarga', 'like', "%{$search}%")
                ->orWhere('status_anggota', 'like', "%{$search}%")
                ->orWhere('jenis_penduduk', 'like', "%{$search}%")
                ->orWhere('tgl_masuk', 'like', "%{$search}%")
                ->orWhere('tgl_keluar', 'like', "%{$search}%");
                    });
                }

                return DataTables::of($ktps)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '<input type="checkbox" class="row-checkbox" value="' . $row->nik . '">';
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }      
    public function export(Request $request){
        // $this->validate($request, [
        //     'niks' => 'required|array',
        //     'niks.*' => 'exists:ktps,NIK' // Pastikan data_penduduks adalah nama tabel Anda
        // ]);
        $niksArray = explode(',', $request->niks);

        // Ambil data berdasarkan NIK yang dipilih
        $penduduk = ktp::whereIn('nik', $niksArray)->get();
        // dd($penduduk);

        // Buat view untuk PDF
        $pdf= FacadePdf::loadView('pdf.penduduk', ['penduduk' => $penduduk]);

        // Generate nama file PDF
        $fileName = 'data_penduduk_' . time() . '.pdf';

        // Return PDF untuk di-download
        return $pdf->download($fileName);
    }
}

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'no_rumah'     => 'required|max:255',                         
    //         'status_rumah'     => 'required|max:255',                                         
    //     ]);

    //     rumahModel::create([
    //         'no_rumah'     => $request->no_rumah,
    //         'status_rumah'     => $request->status_rumah,
    //     ]);
    //     return redirect('/ketuaRt/data_rumah')->with('success', 'Data rumah berhasil disimpan');
    // }

  
    // //Menampilkan halaman form edit Rumah
    // public function edit(String $id)
    // {
    //     $rumah = rumahModel::find($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Edit Rumah',
    //         'list'  => ['Home', 'Rumah', 'Edit']
    //     ];

    //     $page = (object) [
    //         'title' => 'Edit Rumah'
    //     ];

    //     $activeMenu = 'data_rumah'; //set menu yang sedang aktif

    //     return view('/ketuaRt/data_rumah.edit', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'kk' => $kk,
    //         'activeMenu' => $activeMenu,
    //     ]);
    // }

    // //Menyimpan perubahan data level
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         //levelname harus didisi, berupa string, minimal 3 karakter,
    //         //dan bernilai unik ditabel m_levels kolom level kecuali untuk level dengan id yang sedang diedit
    //         'no_rumah'     => 'required|max:255',                         
    //         'status_rumah'     => 'required|max:255',
        
    //     ]);

    //     rumahModel::find($id)->update([
    //         'no_rumah'     => $request->no_rumah,
    //         'status_rumah'     => $request->status_rumah,
    //     ]);

    //     return redirect('/ketuaRt/data_rumah')->with('success', 'Data rumah berhasil diubah');
    // }

    // //Menghapus data rumah
    // public function destroy(string $id)
    // {
    //     $check = rumahModel::find($id);
    //     if (!$check) {      //untuk mengecek apakah data rumah dengan id yang dimaksud ada atau tidak
    //         return redirect('/data_rumah')->with('error', 'Data Rumah tidak ditemukan');
    //     }

    //     try{
    //         rumahModel::destroy($id);    //Hapus data rumah

    //         return redirect('/data_rumah')->with('seccess', 'Data rumah berhasil dihapus');
    //     }catch (\Illuminate\Database\QueryException $e){

    //         //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
    //         return redirect('/data_rumah')->with('error', 'Data rumah gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
    //     }
    // }

// }

