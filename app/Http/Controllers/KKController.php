<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kkModel;
use App\Models\ktp;
use App\Models\ktpModel;
use Yajra\DataTables\Facades\DataTables;

class KKController extends Controller
{
    public function index()
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

        return view('dataKK', [
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

        return view('dataKKSekretaris', [
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

        return view('detailDataKK', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function list(Request $request){
        $kks = kkModel::select('no_kk','nama_kepala_keluarga', 'jumlah_individu', 'alamat', 'dokumen');
    
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

    public function createKTP()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah KTP',
            'list'  => ['Home', 'KTP', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data KTP'
        ];

        $activeMenu = 'data_ktp';

        return view('data_ktp.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function storeKTP(Request $request)
    {
        $request->validate([
            'nik'                => 'required|unique:ktps|max:255',
            'no_kk'              => 'required|max:255',
            'nama'               => 'required|max:255',
            'tempat'             => 'required|max:255',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => 'required|max:255',
            'golongan_darah'     => 'required|max:255',
            'agama'              => 'required|max:255',
            'status_perkawinan'  => 'required|max:255',
            'pekerjaan'          => 'required|max:255',
            'status_keluarga'    => 'required|max:255',
            'status_anggota'     => 'required|max:255',
            'jenis_penduduk'     => 'required|max:255',
            'tgl_masuk'          => 'required|date',
            'tgl_keluar'         => 'nullable|date',
            'dokumen'            => 'nullable|max:255',
        ]);

        ktpModel::create($request->all());

        return redirect('/ketuaRt/data_kk')->with('success', 'Data KTP berhasil disimpan');
    }

    public function createKK()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah KK',
            'list'  => ['Home', 'KK', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data KK'
        ];

        $activeMenu = 'data_kk';

        return view('data_kk.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function storeKK(Request $request)
    {
        $request->validate([
            'no_kk'               => 'required|unique:kks|max:255',
            'nama_kepala_keluarga'=> 'required|max:255',
            'id_level'            => 'required|integer',
            'jumlah_individu'     => 'required|integer',
            'alamat'              => 'required|max:255',
            'dokumen'             => 'nullable|max:255',
        ]);

        kkModel::create($request->all());

        return redirect('/ketuaRt/data_kk')->with('success', 'Data KK berhasil disimpan');
    }

    public function store(Request $request){
        $request->validate([
            'nik'                => 'required|unique:ktps|max:255',
            'no_kk'              => 'required|max:255',
            'nama'              => 'required|max:255',
            'alamat'              => 'required|max:255',
            'jumlah_anggota'               => 'required|integer',
            'tempat_lahir'             => 'required|max:255',
            'tanggal_lahir'      => 'required|date',
            'agama'              => 'required|max:255',
            'no_rumah'              => 'required',
            'status_pernikahan'  => 'required|max:255',
            'pekerjaan'          => 'required|max:255',
            'pendidikan'          => 'required|max:255',
            'tgl_masuk'          => 'nullable|date',
            'tgl_keluar'         => 'nullable|date',
            'dokumen'            => 'nullable',
        ]);

        kkModel::create([
            'no_kk' => $request->no_kk,
            'nama_kepala_keluarga' => $request->nama,
            'jumlah_individu' => $request->jumlah_anggota,
            'alamat' => $request->alamat,
            'no_rumah' => $request->no_rumah,
        ]);
        ktp::create([
            'NIK' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama' => $request->nama,
            'tempat' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_pernikahan,
            'pekerjaan' => $request->pekerjaan,
        ]);
        return redirect('/ketuaRt/data_kk')->with('success', 'Data kk berhasil disimpan');
    }
    
    public function edit(Request $request)
    {
        $kk = kkModel::find($request->no_kk);

        if ($kk) {
            // Jika KK ditemukan, kita bisa menggunakan relasi hasMany untuk mencari data KTP
            $nama = $kk->nama; // Mendapatkan nama dari KK

            // Mencari data KTP berdasarkan no_kk dari KK dan kemudian memfilter berdasarkan nama
            $data_ktps = ktp::where('no_kk', $kk->no_kk)
                            ->where('nama', 'LIKE', "%$nama%")
                            ->get();

            $combinedData = [
                'kk' => $kk,
                'ktp' => $data_ktps
            ];
                    
            // Mengembalikan data KK dan KTP dalam format JSON
            return response()->json($combinedData);
        } else {
            // Handle jika KK tidak ditemukan
            return response()->json(['message' => 'KK not found'], 404);
        }
    }
}


