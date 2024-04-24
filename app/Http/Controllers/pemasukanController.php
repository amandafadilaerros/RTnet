<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use App\Models\kkModel;
use Yajra\DataTables\Facades\DataTables;

class pemasukanController extends Controller
{
    public function index(){
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Pemasukan',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'pemasukan';

        $kk = kkModel::all(); // Mengambil semua data KK dari model

        return view('pemasukan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $bendaharas = iuranModel::select('nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk')
                ->with('kk')
                ->where('jenis_transaksi', 'pemasukan') // Hanya mengambil jenis transaksi "pemasukan"
                ->groupBy('nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk') // Group by kolom tertentu
                ->get();


        //Filter data barang berdasarkan no_kk
        if ($request->no_kk) {
            $bendaharas->where('no_kk', $request->no_kk);
        }
        return DataTables::of($bendaharas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($bendaharas) {
                $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $bendaharas->id_iuran .'"><i class="fas fa-pen"></i></a>  ';
                $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="'. $bendaharas->id_iuran .'"><i class="fas fa-trash"></i></a>  ';
                return $btn;
            })
            
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function store(Request $request)
    {   $request->merge(['jenis_transaksi' => 'pemasukan']); //pengisian manual
        $request->merge(['jenis_iuran' => 'kas']); //pengisian manual
        $request->validate([
            'nominal' => 'required|numeric', // Ubah 'decimal' menjadi 'numeric' agar sesuai dengan validasi
            'jenis_transaksi' => 'required|in:pemasukan',
            'jenis_iuran' => 'required|in:kas',
            'no_kk' => 'required|integer', // Ubah 'bigint' menjadi 'integer' agar sesuai dengan validasi
        ]);
        
        iuranModel::create([
            'nominal' => $request->nominal, // Sesuaikan dengan field 'nominal' pada model
            'jenis_transaksi' => $request->jenis_transaksi, // Sesuaikan dengan field 'jenis_transaksi' pada model
            'jenis_iuran' => $request->jenis_iuran, // Sesuaikan dengan field 'jenis_iuran' pada model
            'no_kk' => $request->no_kk, // Sesuaikan dengan field 'no_kk' pada model
        ]);
        

        return redirect('/bendahara/pemasukan')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit(String $id)
{
    $iuran = iuranModel::find($id);
    $kk = kkModel::all();

    return view('nama_view', compact('iuran', 'kk'));
}


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nominal' => 'required|numeric', // Ubah 'decimal' menjadi 'numeric' agar sesuai dengan validasi
            'no_kk' => 'required|integer', // Ubah 'bigint' menjadi 'integer' agar sesuai dengan validasi
        ]);

        iuranModel::find($id)->update([
            'nominal' => $request->nominal, // Sesuaikan dengan field 'nominal' pada model
            'no_kk' => $request->no_kk, // Sesuaikan dengan field 'no_kk' pada model
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }
}