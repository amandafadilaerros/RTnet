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
    $bendaharas = iuranModel::select('id_iuran','nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
                ->with('kk')
                ->where('jenis_transaksi', 'pemasukan') // Hanya mengambil jenis transaksi "pemasukan"
                ->groupBy('id_iuran','nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at') // Group by kolom tertentu
                ->orderBy('created_at', 'DESC'); // Urutkan berdasarkan created_at secara descending

    // Filter data berdasarkan no_kk
    if ($request->no_kk) {
        $bendaharas->where('no_kk', $request->no_kk);
    }

    // Menggunakan DataTables untuk memformat data
    return DataTables::of($bendaharas)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('created_at_formatted', function ($row) {
            return $row->created_at->format('d-m-Y'); // Format datetime sesuai kebutuhan
        })
        ->rawColumns(['created_at_formatted']) // memberitahu bahwa kolom created_at_formatted adalah HTML
        ->make(true);
}


public function store(Request $request)
{
    $request->merge(['jenis_transaksi' => 'pemasukan']); // pengisian manual

    $request->validate([
        'nominal' => 'required|numeric', // Ubah 'decimal' menjadi 'numeric' agar sesuai dengan validasi
        'jenis_transaksi' => 'required|max:10',
        'jenis_iuran' => 'required|max:50',
        'no_kk' => 'required|integer' // Ubah 'bigint' menjadi 'integer' agar sesuai dengan validasi
    ]);

    // Periksa apakah data sudah ada pada bulan yang sama
    $existingData = iuranModel::where('no_kk', $request->no_kk)
        ->whereMonth('created_at', now()->month) // Filter berdasarkan bulan
        ->whereYear('created_at', now()->year) // Filter berdasarkan tahun
        ->first();

    if ($existingData) {
        return redirect('/bendahara/pemasukan')->with('error', 'Penduduk ini sudah membayar pada bulan ini');
    }

    // Jika data belum ada, simpan data baru
    iuranModel::create([
        'nominal' => $request->nominal, // Sesuaikan dengan field 'nominal' pada model
        'jenis_transaksi' => $request->jenis_transaksi, // Sesuaikan dengan field 'jenis_transaksi' pada model
        'jenis_iuran' => $request->jenis_iuran, // Sesuaikan dengan field 'jenis_iuran' pada model
        'no_kk' => $request->no_kk, // Sesuaikan dengan field 'no_kk' pada model
    ]);

    return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil disimpan');
}


    public function edit(Request $request)
    {
        $idIuran = $request->id_iuran;

        // Lakukan apa pun yang diperlukan dengan ID inventaris
        // Di sini Anda dapat melakukan pencarian atau operasi lainnya
        $iuran = iuranModel::find($idIuran);

        // Misalnya, mengembalikan data inventaris dalam format JSON
        return response()->json($iuran);
    }


    public function update(Request $request)
    {
        $id = $request->id_iuran;
        $request->validate([
            'nominal' => 'required|numeric', // Ubah 'decimal' menjadi 'numeric' agar sesuai dengan validasi
            'no_kk' => 'required|integer', // Ubah 'bigint' menjadi 'integer' agar sesuai dengan validasi
        ]);

        iuranModel::find($id)->update([
            'nominal' => $request->nominal, // Sesuaikan dengan field 'nominal' pada model
            'no_kk' => $request->no_kk, // Sesuaikan dengan field 'no_kk' pada model
        ]);

        return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $id = $request->id_iuran;
        $check = iuranModel::find($id);
        if (!$check) {      //untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
            return redirect('/bendahara/pemasukan')->with('error', 'Data tidak ditemukan');
        }

        try{
            iuranModel::destroy($id);    //Hapus data

            return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/bendahara/pemasukan')->with('error', 'Data gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }
}