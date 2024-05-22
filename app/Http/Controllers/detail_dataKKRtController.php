<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kkModel;
use App\Models\ktpModel;
use Yajra\DataTables\Facades\DataTables;

class detail_dataKKRtController extends Controller
{
    // public function index()
    // {
    //     // ini hanya TEST
    //     $breadcrumb = (object) [
    //         'title' => 'Data Kartu Keluarga',
    //         'list' => ['--', '--'],
    //     ];
    //     $page = (object) [
    //         'title' => '-----',
    //     ];
    //     $activeMenu = 'data_kk';

    //     return view('data_KKrt', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu,
    //     ]);
    // }
    // public function index1()
    // {
    //     // ini hanya TEST
    //     $breadcrumb = (object) [
    //         'title' => 'Data Kartu Keluarga',
    //         'list' => ['--', '--'],
    //     ];
    //     $page = (object) [
    //         'title' => '-----',
    //     ];
    //     $activeMenu = 'data_kk';

    //     return view('data_KKSekretaris', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu,
    //     ]);
    // }

    public function detail()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Kartu Keluarga',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_kk';

        return view('detail_dataKKRt', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function list(Request $request){
            $ktps = ktpModel::select('nik','no_kk', 'nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin',
             'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'status_anggota', 'jenis_penduduk',
              'tgl_masuk', 'tgl_keluar', 'dokumen')->where('jenis_penduduk', 'tetap')
              ->get();
    
        return DataTables::of($ktps)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($kk) {
        //     $btn = '<a href="#" class="btn btn-primary btn-sm btn-detail" data-toggle="modal" data-target="#detailModal" data-id="'. $kk->no_kk .'"><i class="fas fa-info-circle"></i></a>  '; // Tombol detail
        //     $btn .= '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $kk->no_kk .'"><i class="fas fa-pen"></i></a>  ';
        //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="'. $kk->no_kk .'"><i class="fas fa-trash"></i></a>  ';
        //     return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }
    public function list2(Request $request){
            $ktps = ktpModel::select('nik','no_kk', 'nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin',
             'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'status_anggota', 'jenis_penduduk',
              'tgl_masuk', 'tgl_keluar', 'dokumen')->where('jenis_penduduk', 'kos')
              ->get();
    
        return DataTables::of($ktps)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($kk) {
        //     $btn = '<a href="#" class="btn btn-primary btn-sm btn-detail" data-toggle="modal" data-target="#detailModal" data-id="'. $kk->no_kk .'"><i class="fas fa-info-circle"></i></a>  '; // Tombol detail
        //     $btn .= '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $kk->no_kk .'"><i class="fas fa-pen"></i></a>  ';
        //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="'. $kk->no_kk .'"><i class="fas fa-trash"></i></a>  ';
        //     return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }

    public function store(Request $request)
    {
        dd($request);
        // $request->validate([
        //     'nik'                   => 'required|max:255',                         
        //     'no_kk'                 => 'required|max:255',
        //     'nama'                  => 'required|max:255',
        //     'tempat'                => 'required|max:255',
        //     'tanggal_lahir'         => 'required|max:255',
        //     'jenis_kelamin'         => 'required|max:255',
        //     'golongan_darah'        => 'required|max:255',
        //     'agama'                 => 'required|max:255',
        //     'status_perkawinan'     => 'required|max:255',
        //     'pekerjaan'             => 'required|max:255',
        //     'status_keluarga'       => 'required|max:255',
        //     'status_anggota'        => 'required|max:255',
        //     'jenis_penduduk'        => 'required|max:255',
            // 'tgl_masuk'             => 'required|max:255', penduduk tetap gak butuh ini
            // 'tgl_keluar'            => 'required|max:255', ini juga, jadi di comment
            
        // ]);
       
        ktpModel::create([
            'nik'                   => $request->nik,                         
            'no_kk'                 => $request->no_kk,
            'nama'                  => $request->nama,
            'tempat'                => $request->tempat,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'golongan_darah'        => $request->golongan_darah,
            'agama'                 => $request->agama,
            'status_perkawinan'     => $request->status_perkawinan,
            'pekerjaan'             => $request->pekerjaan,
            'status_keluarga'       => $request->status_keluarga,
            'status_anggota'        => $request->status_anggota,
            'jenis_penduduk'        => $request->jenis_penduduk,
            'tgl_masuk'             => $request->tgl_masuk,
            'tgl_keluar'            => $request->tgl_keluar,
            'dokumen'               => $request->dokumen,
        ]);
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('success', 'Data Kartu Keluarga berhasil disimpan');
    }
    public function store2(Request $request)
    {
        // dd($request);
        $request->validate([
            'nik'                   => 'required|max:255',                         
            'no_kk'                 => 'required|max:255',
            'nama'                  => 'required|max:255',
            'tempat'                => 'required|max:255',
            'tanggal_lahir'         => 'required|max:255',
            'jenis_kelamin'         => 'required|max:255',
            'golongan_darah'        => 'required|max:255',
            'agama'                 => 'required|max:255',
            'status_perkawinan'     => 'required|max:255',
            'pekerjaan'             => 'required|max:255',
            'status_keluarga'       => 'required|max:255',
            'status_anggota'        => 'required|max:255',
            'jenis_penduduk2'        => 'required|max:255',
            // 'tgl_masuk'             => 'required|max:255', penduduk tetap gak butuh ini
            // 'tgl_keluar'            => 'required|max:255', ini juga, jadi di comment
            
        ]);
       
        ktpModel::create([
            'nik'                   => $request->nik,                         
            'no_kk'                 => $request->no_kk,
            'nama'                  => $request->nama,
            'tempat'                => $request->tempat,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'golongan_darah'        => $request->golongan_darah,
            'agama'                 => $request->agama,
            'status_perkawinan'     => $request->status_perkawinan,
            'pekerjaan'             => $request->pekerjaan,
            'status_keluarga'       => $request->status_keluarga,
            'status_anggota'        => $request->status_anggota,
            'jenis_penduduk'        => $request->jenis_penduduk2,
            'tgl_masuk'             => $request->tgl_masuk,
            'tgl_keluar'            => $request->tgl_keluar,
            'dokumen'               => $request->dokumen,
        ]);
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('success', 'Data Kartu Keluarga berhasil disimpan');
    }

    public function create()
    {

        $breadcrumb = (object) [
            'title' => 'Tambah Data Kartu Keluarga',
            'list'  => ['Home', 'Kartu Keluarga', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Kartu Keluarga'
        ];

        $activeMenu = 'data_kk';       //set menu yang sedang aktif
        return view('data_kk.create', 
        [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

      //Menampilkan detail rumah
      public function show($no_kk)
      {

        $data_kk = kkModel::with('rumah')->find($no_kk);
        // dd($data_kk);

          $breadcrumb = (object) [
              'title' => 'Detail Data Kartu Keluarga',
              'list'  => ['Home', 'Kartu Keluarga', 'Detail']
          ];
  
          $page = (object) [
              'title' => 'Detail Kartu Keluarga'
          ];
  
          $activeMenu = 'data_kk';       //set menu yang sedang aktif
          return view('detail_dataKKRt', 
          [
              'breadcrumb' => $breadcrumb,
              'page'       => $page,
              'activeMenu' => $activeMenu,
              'data_kk' => $data_kk,
          ]);
      }

    public function edit(Request $request)
    {
        $data_kk = kkModel::find($request->no_kk);
        return response()->json($data_kk);
    }
    
    public function update(Request $request){
        // dd($request);
        // $request->validate([
        //     // 'no_kk'     => 'required|integer|max:255|unique:kks,no_kk,'. $request->id . ',no_kk',
        //     'nama_kepala_keluarga'  => 'required|max:255',
        //     'jumlah_individu'       => 'required|max:255',
        //     'alamat'                => 'required|max:255',
        // ]);

        kkModel::find($request->id)->update([
            'no_kk'                 => $request->no_kk,
            'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
            'jumlah_individu'       => $request->jumlah_individu,
            'alamat'                => $request->alamat,
            'dokumen'               => $request->dokumen,
        ]);
        return redirect('/ketuaRt/data_kk')->with('success', 'Data kk berhasil disimpan');
    }

   //Menghapus data rumah
    public function destroy(Request $request)
    {
        $check = kkModel::find($request->no_kk); // Menggunakan $request->no_rumah dari parameter

        if (!$check) {      //untuk mengecek apakah data rumah dengan id yang dimaksud ada atau tidak
        return redirect('/ketuaRt/data_kk')->with('error', 'Data Kartu Keluarga tidak ditemukan');
        }

        try {
        kkModel::destroy($request->no_kk);    //Hapus data rumah dengan $request->no_rumah dari parameter

        return redirect('/ketuaRt/data_kk')->with('success', 'Data Kartu Keluarga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) { 
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/ketuaRt/data_kk')->with('error', 'Data Data Kartu Keluarga gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }

}


