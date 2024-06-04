<?php

namespace App\Http\Controllers;

use App\Models\akun;
use Illuminate\Http\Request;
use App\Models\kkModel;
use App\Models\ktp;
use App\Models\ktpModel;
use App\Models\level;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class data_kkRtController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Kartu Keluarga',
            'list' => ['Home', 'Data Kartu Keluarga'],
        ];
        $page = (object) [
            'title' => 'Daftar data kartu keluarga yang terdaftar dalam sistem',
        ];
        $activeMenu = 'data_kk';

        return view('data_KKrt', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function index1()
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

        return view('data_KKSekretaris', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
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
        $kks = kkModel::select('no_kk','nama_kepala_keluarga', 'jumlah_individu', 'no_rumah', 'alamat', 'dokumen');
        if ($request->has('customSearch') && !empty($request->customSearch)) {
            $search = $request->customSearch;
            $kks->where(function($query) use ($search) {
                $query->where('nama_kepala_keluarga', 'like', "%{$search}%")
                      ->orWhere('no_kk', 'like', "%{$search}%")
                      ->orWhere('no_rumah', 'like', "%{$search}%")
                      ->orWhere('jumlah_individu', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%");
            });
        }
    
        return DataTables::of($kks)
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
        $request->validate([
            'no_kk'                 => 'required|max:255',                         
            'nama_kepala_keluarga'  => 'required|max:255',
            'jumlah_individu'       => 'required|max:255',
            'alamat'                => 'required|max:255',
            'no_rumah'              => 'required|max:255'
        ]);
        
        $pathBaru = null;
        if ($request->hasFile('dokumen')) {
            $imageFile = $request->file('dokumen');
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            Storage::disk('img_kks')->put($namaFile, file_get_contents($imageFile));
            $pathBaru = $namaFile;
        }

        kkModel::create([
            'no_kk'                 => $request->no_kk,
            'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
            'jumlah_individu'       => $request->jumlah_individu,
            'alamat'                => $request->alamat,
            'no_rumah'              => $request->no_rumah,
            'dokumen'               => $pathBaru,
        ]);
        $level = level::where('nama_level', 'penduduk')->firstOrFail();
        // dd($level);
        akun::create([
            'id_akun' => $request->no_kk,
            'id_level' => $level->id_level,
            'password' => bcrypt($request->no_kk),  // Meng-hash password
            'nama' => $request->nama_kepala_keluarga
        ]);
        return redirect('/ketuaRt/data_kk')->with('success', 'Data Kartu Keluarga berhasil disimpan');
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
        // dd($data_kk->rumah->status_rumah);

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
    
    public function update(Request $request)
    {
        // dd($request);
        $request->validate([
            'no_kk'                 => 'required|max:255|unique:kks,no_kk,'. $request->id . ',no_kk',
            'nama_kepala_keluarga'  => 'required|max:255',
            'jumlah_individu'       => 'required|max:255',
            'alamat'                => 'required|max:255',
        ]);

        if ($request->hasFile('dokumen')) {
            $imageFile = $request->file('dokumen');
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            Storage::disk('img_kks')->put($namaFile, file_get_contents($imageFile));
            $pathBaru = $namaFile;
            kkModel::find($request->id)->update([
                'no_kk'                 => $request->no_kk,
                'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
                'jumlah_individu'       => $request->jumlah_individu,
                'alamat'                => $request->alamat,
                'dokumen'               => $pathBaru,
            ]);
        } else {
            kkModel::find($request->id)->update([
                'no_kk'                 => $request->no_kk,
                'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
                'jumlah_individu'       => $request->jumlah_individu,
                'alamat'                => $request->alamat,
            ]);
        }
        return redirect('/ketuaRt/data_kk')->with('success', 'Data berhasil diubah');
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
        akun::destroy($request->no_kk);

        return redirect('/ketuaRt/data_kk')->with('success', 'Data Kartu Keluarga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) { 
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/ketuaRt/data_kk')->with('error', 'Data Data Kartu Keluarga gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }

}


