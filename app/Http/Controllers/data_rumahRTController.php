<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\kkModel;
use App\Models\rumahModel;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class data_rumahRTController extends Controller
{
    public function index(){
        // menampilkan halaman awal data rumah
        // menampilkan halaman awal data rumah
        $breadcrumb = (object) [
            'title' => 'Data Rumah',
            'list' => ['Home', 'Data Rumah'],
            'list' => ['Home', 'Data Rumah'],
        ];
        $page = (object) [
            'title' => 'Daftar data rumah yang terdaftar dalam sistem ',
            'title' => 'Daftar data rumah yang terdaftar dalam sistem ',
        ];

        $activeMenu = 'data_rumah';
        $rumahs = rumahModel::all();
        // return view('data_rumah.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk , 'activeMenu' => $activeMenu]);
        return view('data_rumahRT', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        $rumahs = rumahModel::select('no_rumah', 'status_rumah');

        return DataTables::of($rumahs)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($data_rumah) {
        // //     $btn = '<button type="button" class="button-detail btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874;" id='. $data_rumah->no_rumah .' data-toggle="modal" data-target="#detailModal">
        // //     Detail
        // // </button>';
        // //     $btn .= '<a href="' . url('/ketuaRt/data_rumah/' . $data_rumah->no_rumah . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>  ';
        // //     $btn .= '<form class="d-inline-block" method="POST" action="' . url('/ketuaRt/data_rumah/' . $data_rumah->no_rumah) . '">' . csrf_field() . method_field('DELETE').
        // //             '<button type="submit" class="btn btn-danger btn-sm"
        // //             onclik="return confirm(\'Apakah Anda yakin menhapus data ini?\');">Hapus</button></form>' ;
        //     // return $btn;
        // })
        // ->rawColumns(['aksi'])
        // ->addColumn('aksi', function ($data_rumah) {
        // //     $btn = '<button type="button" class="button-detail btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874;" id='. $data_rumah->no_rumah .' data-toggle="modal" data-target="#detailModal">
        // //     Detail
        // // </button>';
        // //     $btn .= '<a href="' . url('/ketuaRt/data_rumah/' . $data_rumah->no_rumah . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>  ';
        // //     $btn .= '<form class="d-inline-block" method="POST" action="' . url('/ketuaRt/data_rumah/' . $data_rumah->no_rumah) . '">' . csrf_field() . method_field('DELETE').
        // //             '<button type="submit" class="btn btn-danger btn-sm"
        // //             onclik="return confirm(\'Apakah Anda yakin menhapus data ini?\');">Hapus</button></form>' ;
        //     // return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rumah'     => 'required|max:255',                         
            'status_rumah'     => 'required|max:255',                                         
        ]);

        rumahModel::create([
            'no_rumah'     => $request->no_rumah,
            'status_rumah'     => $request->status_rumah,
        ]);
        return redirect('/ketuaRt/data_rumah')->with('success', 'Data rumah berhasil disimpan');
    }

    public function create()
    {

        $breadcrumb = (object) [
            'title' => 'Tambah rumah',
            'list'  => ['Home', 'Rumah', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Rumah'
        ];

        $activeMenu = 'data_rumah';       //set menu yang sedang aktif
        return view('data_rumah.create', 
        [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            // 'kk'        => $kk,
            'activeMenu' => $activeMenu,
        ]);
    }

      //Menampilkan detail rumah
      public function show(String $no_rumah)
      {

        $data_rumah = rumahModel::find($no_rumah);

          $breadcrumb = (object) [
              'title' => 'Detail rumah',
              'list'  => ['Home', 'Rumah', 'Detail']
          ];
  
          $page = (object) [
              'title' => 'Detail Rumah'
          ];
  
          $activeMenu = 'data_rumah';       //set menu yang sedang aktif
          return view('data_rumah.show', 
          [
              'breadcrumb' => $breadcrumb,
              'page'       => $page,
              'activeMenu' => $activeMenu,
              'data_rumah' => $data_rumah,
          ]);
      }

    public function edit(Request $request)
    {
        $data_rumah = rumahModel::find($request->no_rumah);
        return response()->json($data_rumah);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'no_rumah'     => 'required|integer|max:255|unique:rumahs,no_rumah,'. $request->id . ',no_rumah',
            'status_rumah'     => 'required|max:255',
        ]);

        rumahModel::find($request->id)->update([
            'no_rumah'     => $request->no_rumah,
            'status_rumah'     => $request->status_rumah,
        ]);

        return redirect('/ketuaRt/data_rumah')->with('success', 'Data berhasil diubah');
    }

   //Menghapus data rumah
    public function destroy(Request $request)
    {
        $check = rumahModel::find($request->no_rumah); // Menggunakan $request->no_rumah dari parameter

        if (!$check) {      //untuk mengecek apakah data rumah dengan id yang dimaksud ada atau tidak
        return redirect('/ketuaRt/data_rumah')->with('error', 'Data Rumah tidak ditemukan');
        }

        try {
        rumahModel::destroy($request->no_rumah);    //Hapus data rumah dengan $request->no_rumah dari parameter

        return redirect('/ketuaRt/data_rumah')->with('success', 'Data rumah berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) { 
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/ketuaRt/data_rumah')->with('error', 'Data rumah gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

}
