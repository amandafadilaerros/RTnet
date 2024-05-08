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
    public function store(Request $request){
        $request->validate([
            'no_kk'                 => 'required|max:255',                         
            'nama_kepala_keluarga'  => 'required|max:255',
            'jumlah_individu'       => 'required|max:255',
            'alamat'                => 'required|max:255',
            'no_rumah'              => 'required|max:255'
        ]);
        // dd($request);

        kkModel::create([
            'no_kk'                 => $request->no_kk,
            'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
            'jumlah_individu'       => $request->jumlah_individu,
            'alamat'                => $request->alamat,
            'no_rumah'                => $request->no_rumah,
            'dokumen'               => $request->dokumen,
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
    public function update(Request $request){
        // dd($request);
        $request->validate([
            'no_kk'                 => 'required|max:255',                         
            'nama_kepala_keluarga'  => 'required|max:255',
            'jumlah_individu'       => 'required|max:255',
            'alamat'                => 'required|max:255',
        ]);

        kkModel::find($request->id)->update([
            'no_kk'                 => $request->no_kk,
            'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
            'jumlah_individu'       => $request->jumlah_individu,
            'alamat'                => $request->alamat,
            'dokumen'               => $request->dokumen,
        ]);
        return redirect('/ketuaRt/data_kk')->with('success', 'Data kk berhasil disimpan');
    }

}
