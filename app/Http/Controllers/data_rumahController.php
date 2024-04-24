<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\rumahModel;
// use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\rumahModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class data_rumahController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Rumah',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'data_rumah';
        // $barang = BarangModel::all();
        return view('data_rumah', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => '$kk', 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        $rumahs = rumahModel::select('no_rumah', 'status_rumah');

        return DataTables::of($rumahs)
        ->addIndexColumn()
        ->addColumn('aksi', function ($rumah) {
            $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $rumah->no_rumah .'"><i class="fas fa-pen"></i></a>  ';
            $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="'. $rumah->no_rumah .'"><i class="fas fa-trash"></i></a>  ';
            return $btn;
        })
        ->rawColumns(['aksi'])
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

    //Menampilkan detail rumah
    // public function show(String $id)
    // {
    //     $rumah = rumahModel::find($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Detail rumah',
    //         'list'  => ['Home', 'Rumah', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail Rumah'
    //     ];

    //     $activeMenu = 'data_rumah';       //set menu yang sedang aktif
    //     return view('data_rumah.show', 
    //     [
    //         'breadcrumb' => $breadcrumb,
    //         'page'       => $page,
    //         'activeMenu' => $activeMenu,
    //     ]);
    // }

    //Menampilkan halaman form edit Rumah
    public function edit(String $id)
    {
        $rumah = rumahModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Rumah',
            'list'  => ['Home', 'Rumah', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Rumah'
        ];

        $activeMenu = 'data_rumah'; //set menu yang sedang aktif

        return view('/ketuaRt/data_rumah.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kk' => $kk,
            'activeMenu' => $activeMenu,
        ]);
    }

    //Menyimpan perubahan data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            //levelname harus didisi, berupa string, minimal 3 karakter,
            //dan bernilai unik ditabel m_levels kolom level kecuali untuk level dengan id yang sedang diedit
            'no_rumah'     => 'required|max:255',                         
            'status_rumah'     => 'required|max:255',
           
        ]);

        rumahModel::find($id)->update([
            'no_rumah'     => $request->no_rumah,
            'status_rumah'     => $request->status_rumah,
        ]);

        return redirect('/ketuaRt/data_rumah')->with('success', 'Data rumah berhasil diubah');
    }

    //Menghapus data rumah
    public function destroy(string $id)
    {
        $check = rumahModel::find($id);
        if (!$check) {      //untuk mengecek apakah data rumah dengan id yang dimaksud ada atau tidak
            return redirect('/data_rumah')->with('error', 'Data Rumah tidak ditemukan');
        }

        try{
            rumahModel::destroy($id);    //Hapus data rumah

            return redirect('/data_rumah')->with('seccess', 'Data rumah berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/data_rumah')->with('error', 'Data rumah gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }
}
