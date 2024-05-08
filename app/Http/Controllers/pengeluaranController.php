<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use App\Models\kkModel;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pengeluaran',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'pengeluaran';

        return view(
            'pengeluaran',
            [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'activeMenu' => $activeMenu,
            ]
        );
    }

    public function list(Request $request)
    {
        $bendaharas = iuranModel::select('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
            ->with('kk')
            ->where('jenis_transaksi', 'pengeluaran') // Hanya mengambil jenis transaksi "pengeluaran"
            ->groupBy('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at') // Group by kolom tertentu
            ->orderBy('created_at', 'DESC'); // Urutkan berdasarkan created_at secara descending

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
    // Menentukan jenis transaksi secara manual
    $request->merge(['jenis_transaksi' => 'pengeluaran']);

    // Validasi input
    $request->validate([
        'nominal' => 'required|numeric',
        'jenis_transaksi' => 'required|in:pengeluaran',
        'jenis_iuran' => 'required|max:50',
        'keterangan' => 'required'
    ]);

    // Menghitung saldo saat ini berdasarkan jenis iuran (kas atau paguyuban)
    $jenisIuran = $request->jenis_iuran;
    $totalUangMasuk = iuranModel::where('jenis_transaksi', 'pemasukan')->where('jenis_iuran', $jenisIuran)->sum('nominal');
    $totalUangKeluar = iuranModel::where('jenis_transaksi', 'pengeluaran')->where('jenis_iuran', $jenisIuran)->sum('nominal');
    $saldo = $totalUangMasuk - $totalUangKeluar;

    // Memeriksa apakah saldo cukup
    $pengeluaranDiminta = $request->nominal;
    if ($saldo < $pengeluaranDiminta) {
        return redirect('/bendahara/pengeluaran')->with('error', 'Saldo tidak mencukupi untuk melakukan pengeluaran '.$jenisIuran);
    }

    // Menyimpan data pengeluaran kas jika saldo cukup
    iuranModel::create([
        'nominal' => $request->nominal,
        'jenis_transaksi' => $request->jenis_transaksi,
        'jenis_iuran' => $request->jenis_iuran,
        'keterangan' => $request->keterangan
    ]);

    return redirect('/bendahara/pengeluaran')->with('success', 'Data berhasil disimpan');
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
            'nominal' => 'required|numeric',
            'jenis_iuran' => 'required|max:50',
            'keterangan' => 'required'
        ]);

        iuranModel::find($id)->update([
            'nominal' => $request->nominal,
            'jenis_iuran' => $request->jenis_iuran,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/bendahara/pengeluaran')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $id = $request->id_iuran;
        $check = iuranModel::find($id);
        if (!$check) {      //untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
            return redirect('/bendahara/pengeluaran')->with('error', 'Data tidak ditemukan');
        }

        try {
            iuranModel::destroy($id);    //Hapus data

            return redirect('/bendahara/pengeluaran')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/bendahara/pengeluaran')->with('error', 'Data gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }
}
