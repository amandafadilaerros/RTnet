<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kkModel;
use App\Models\ktp;
use App\Models\ktpModel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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

        $no_kk = $request->no_kk;
            $ktps = ktpModel::select('nik','no_kk', 'nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin',
             'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'jenis_penduduk',
              'tgl_masuk', 'tgl_keluar', 'dokumen')->where('jenis_penduduk', 'tetap')->where('no_kk', $no_kk)
              ->whereNull('tgl_keluar')
              ->get();

              if ($request->has('customSearch') && !empty($request->customSearch)) {
                $search = $request->customSearch;
                $ktps->where(function($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                          ->orWhere('no_kk', 'like', "%{$search}%")
                          ->orWhere('nik', 'like', "%{$search}%");
                        });
                    }
                    $ktps = $ktps->get();
    
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
        $no_kk = $request->no_kk;
            $ktps = ktpModel::select('nik','no_kk', 'nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin',
             'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'jenis_penduduk',
              'tgl_masuk', 'tgl_keluar', 'dokumen')->where('jenis_penduduk', 'kos')->where('no_kk', $no_kk)
              ->whereNull('tgl_keluar')
              ->get();

              if ($request->has('customSearch') && !empty($request->customSearch)) {
                $search = $request->customSearch;
                $ktps->where(function($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                        //   ->orWhere('no_kk', 'like', "%{$search}%")
                        //   ->orWhere('nik', 'like', "%{$search}%");
                        });
                    }
                    $ktps = $ktps->get();
    
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
        $jumlahIndividu = kkModel::where('no_kk', $request->no_kk)->value('jumlah_individu');
        $jumlahKtp = ktp::where('no_kk', $request->no_kk)
                    ->where('jenis_penduduk', 'tetap')
                    ->count();
        if($jumlahKtp >= $jumlahIndividu){
            return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('error', 'Maaf, jumlah individu dalam KK sudah mencapai batas.');
        }
        // dd($request);
        $request->validate([
            'nik'                   => 'required|max:255|unique:ktps,NIK',                         
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
            // 'status_anggota'        => 'required|max:255',
            'jenis_penduduk'        => 'required|max:255',
            // 'tgl_masuk'             => 'required|max:255', penduduk tetap gak butuh ini
            // 'tgl_keluar'            => 'required|max:255', ini juga, jadi di comment
            
        ]);

        $pathBaru = null;
        if ($request->hasFile('dokumen')) {
            $imageFile = $request->file('dokumen');
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            Storage::disk('img_ktps')->put($namaFile, file_get_contents($imageFile));
            $pathBaru = $namaFile;
        }
        $today = Carbon::now();
       
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
            // 'status_anggota'        => $request->status_anggota,
            'jenis_penduduk'        => $request->jenis_penduduk,
            'tgl_masuk'             => $today,
            'tgl_keluar'            => $request->tgl_keluar,
            'dokumen'               => $pathBaru,
        ]);
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('success', 'Data Kartu Keluarga berhasil disimpan');
    }

    public function store2(Request $request)
    {
        // dd($request);
        $request->validate([
            'nik'                   => 'required|max:255|unique:ktps,NIK',                         
            'no_kk'                 => 'required|max:255',
            'nama'                  => 'required|max:255',
            'tempat'                => 'required|max:255',
            'tanggal_lahir'         => 'required|max:255',
            'jenis_kelamin'         => 'required|max:255',
            'golongan_darah'        => 'required|max:255',
            'agama'                 => 'required|max:255',
            'status_perkawinan'     => 'required|max:255',
            'pekerjaan'             => 'required|max:255',
            // 'status_keluarga'       => 'required|max:255',
            // 'status_anggota'        => 'required|max:255',
            'jenis_penduduk2'        => 'required|max:255',
            'tgl_masuk'             => 'required|max:255',
            // 'tgl_keluar'            => 'required|max:255', ini juga, jadi di comment
            
        ]);

        $pathBaru = null;
        if ($request->hasFile('dokumen')) {
            $imageFile = $request->file('dokumen');
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            Storage::disk('img_ktps')->put($namaFile, file_get_contents($imageFile));
            $pathBaru = $namaFile;
        }
        $today = Carbon::now();
       
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
            // 'status_keluarga'       => $request->status_keluarga,
            // 'status_anggota'        => $request->status_anggota,
            'jenis_penduduk'        => $request->jenis_penduduk2,
            'tgl_masuk'             => $today,
            'tgl_keluar'            => $request->tgl_keluar,
            'dokumen'               => $pathBaru,
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
        $data_ktp = ktpModel::find($request->nik);
        return response()->json($data_ktp);
    }
    
    public function update(Request $request){
        // dd($request->nik_awal);
        $request->validate([
            'nik'                   => 'required|max:255',
            'nama'                  => 'required|max:255',
            'tempat'                => 'required|max:255',
            'tanggal_lahir'         => 'required|max:255',
            'jenis_kelamin'         => 'required|max:255',
            'golongan_darah'        => 'required|max:255',
            'agama'                 => 'required|max:255',
            'status_perkawinan'     => 'required|max:255',
            'pekerjaan'             => 'required|max:255',
            'status_keluarga'       => 'required|max:255',
            //'status_anggota'        => 'required|max:255',
            // 'tgl_masuk'             => 'required|max:255', penduduk tetap gak butuh ini
            // 'tgl_keluar'            => 'required|max:255', ini juga, jadi di comment
            
        ]);

        if ($request->hasFile('dokumen')) {
            $imageFile = $request->file('dokumen');
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            Storage::disk('img_ktps')->put($namaFile, file_get_contents($imageFile));
            $pathBaru = $namaFile;
            ktp::find($request->nik_awal)->update([
                'nik'                   => $request->nik,
                'nama'                  => $request->nama,
                'tempat'                => $request->tempat,
                'tanggal_lahir'         => $request->tanggal_lahir,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'golongan_darah'        => $request->golongan_darah,
                'agama'                 => $request->agama,
                'status_perkawinan'     => $request->status_perkawinan,
                'pekerjaan'             => $request->pekerjaan,
                'status_keluarga'       => $request->status_keluarga,
                // 'status_anggota'        => $request->status_anggota,
                'dokumen'               => $pathBaru,
            ]);
        } else {
            ktp::find($request->nik_awal)->update([
                'nik'                   => $request->nik,
                'nama'                  => $request->nama,
                'tempat'                => $request->tempat,
                'tanggal_lahir'         => $request->tanggal_lahir,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'golongan_darah'        => $request->golongan_darah,
                'agama'                 => $request->agama,
                'status_perkawinan'     => $request->status_perkawinan,
                'pekerjaan'             => $request->pekerjaan,
                'status_keluarga'       => $request->status_keluarga,
                // 'status_anggota'        => $request->status_anggota,
            ]);
        }
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('success', 'Data ktp berhasil disimpan');
    }

    public function update2(Request $request){
        // dd($request);
        $request->validate([
            'nik'                   => 'required|max:255',
            'nama'                  => 'required|max:255',
            'tempat'                => 'required|max:255',
            'tanggal_lahir'         => 'required|max:255',
            'jenis_kelamin'         => 'required|max:255',
            'golongan_darah'        => 'required|max:255',
            'agama'                 => 'required|max:255',
            'status_perkawinan'     => 'required|max:255',
            'pekerjaan'             => 'required|max:255',
            // 'status_keluarga'       => 'required|max:255',
            // 'status_anggota'        => 'required|max:255',
            'tgl_masuk'             => 'required|max:255',
            // 'tgl_keluar'            => 'required|max:255', ini juga, jadi di comment
            
        ]);
        
        if ($request->hasFile('dokumen')) {
            $imageFile = $request->file('dokumen');
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            Storage::disk('img_ktps')->put($namaFile, file_get_contents($imageFile));
            $pathBaru = $namaFile;
            ktp::find($request->nik_awal)->update([
                'nik'                   => $request->nik,
                'nama'                  => $request->nama,
                'tempat'                => $request->tempat,
                'tanggal_lahir'         => $request->tanggal_lahir,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'golongan_darah'        => $request->golongan_darah,
                'agama'                 => $request->agama,
                'status_perkawinan'     => $request->status_perkawinan,
                'pekerjaan'             => $request->pekerjaan,
                // 'status_keluarga'       => $request->status_keluarga,
                // 'status_anggota'        => $request->status_anggota,
                'dokumen'               => $pathBaru,
            ]);
        } else {
            ktp::find($request->nik_awal)->update([
                'nik'                   => $request->nik,
                'nama'                  => $request->nama,
                'tempat'                => $request->tempat,
                'tanggal_lahir'         => $request->tanggal_lahir,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'golongan_darah'        => $request->golongan_darah,
                'agama'                 => $request->agama,
                'status_perkawinan'     => $request->status_perkawinan,
                'pekerjaan'             => $request->pekerjaan,
                // 'status_keluarga'       => $request->status_keluarga,
                // 'status_anggota'        => $request->status_anggota,
            ]);
        }
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('success2', 'Data ktp berhasil disimpan');
    }

   //Menghapus data rumah
    public function destroy(Request $request)
    {
        $check = ktp::find($request->nik); // Menggunakan $request->no_rumah dari parameter

        if (!$check) {      //untuk mengecek apakah data rumah dengan id yang dimaksud ada atau tidak
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('error', 'Data ktp tidak ditemukan');
        }

        try {
            $today = Carbon::now();
            ktp::find($request->nik)->update([
                'tgl_keluar'            => $today,
            ]);

        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('success', 'Data ktp berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) { 
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/ketuaRt/detail_kk/'.$request->no_kk)->with('error', 'Data Data ktp gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }

}


