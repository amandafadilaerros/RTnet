<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use App\Models\kkModel;
use Yajra\DataTables\Facades\DataTables;

class pemasukanController extends Controller
{
    public function index()
    {
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
    // Validasi input dari form pencarian
    $request->validate([
        'search' => 'nullable|string|max:255', // Kolom pencarian, bisa berupa teks atau kosong
        'no_kk' => 'nullable|integer', // Validasi input no_kk
    ]);

    // Mengambil data berdasarkan input pencarian
    $searchQuery = $request->input('search');
    $no_kk = $request->input('no_kk');

    $bendaharas = iuranModel::select('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
        ->with('kk')
        ->where('jenis_transaksi', 'pemasukan') // Hanya mengambil jenis transaksi "pemasukan"
        ->groupBy('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at') // Group by kolom tertentu
        ->orderBy('created_at', 'DESC'); // Urutkan berdasarkan created_at secara descending

    // Filter data berdasarkan no_kk
    if ($no_kk) {
        $bendaharas->where('no_kk', $no_kk);
    }

    // Filter data berdasarkan pencarian teks
    if ($searchQuery) {
        $bendaharas->where(function ($query) use ($searchQuery) {
            $query->where('nominal', 'LIKE', "%$searchQuery%")
                ->orWhere('jenis_iuran', 'LIKE', "%$searchQuery%")
                ->orWhereHas('kk', function ($query) use ($searchQuery) {
                    $query->where('nama_kepala_keluarga', 'LIKE', "%$searchQuery%");
                })
                ->orWhereDate('created_at', $searchQuery); // Pencarian berdasarkan tanggal
        });
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
        $request->merge(['jenis_transaksi' => 'pemasukan']); // Pengisian manual jenis transaksi

        $request->validate([
            'nominal' => 'required|numeric',
            'jenis_transaksi' => 'required|max:10',
            'jenis_iuran' => 'required|max:50',
            'no_kk' => 'required|integer'
        ]);

        // Periksa apakah data sudah ada pada bulan yang sama berdasarkan jenis iuran
        $existingData = iuranModel::where('no_kk', $request->no_kk)
            ->where('jenis_iuran', $request->jenis_iuran) // Filter berdasarkan jenis iuran
            ->whereMonth('created_at', now()->month) // Filter berdasarkan bulan
            ->whereYear('created_at', now()->year) // Filter berdasarkan tahun
            ->first();

        if ($existingData) {
            return redirect('/bendahara/pemasukan')->with('error', 'Penduduk ini sudah membayar pada bulan ini');
        }

        // Jika data belum ada, simpan data baru
        iuranModel::create([
            'nominal' => $request->nominal,
            'jenis_transaksi' => $request->jenis_transaksi,
            'jenis_iuran' => $request->jenis_iuran,
            'no_kk' => $request->no_kk,
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

        try {
            iuranModel::destroy($id);    //Hapus data

            return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/bendahara/pemasukan')->with('error', 'Data gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }

    public function search(Request $request)
    {
        // Validasi input dari form pencarian
        $request->validate([
            'search' => 'nullable|string|max:255', // Kolom pencarian, bisa berupa teks atau kosong
        ]);

        // Mengambil data berdasarkan input pencarian
        $searchQuery = $request->input('search');

        // Query untuk mengambil data sesuai dengan input pencarian
        $data = iuranModel::where(function ($query) use ($searchQuery) {
            $query->where('nominal', 'LIKE', "%$searchQuery%")
                ->orWhere('jenis_iuran', 'LIKE', "%$searchQuery%")
                ->orWhereHas('kk', function ($query) use ($searchQuery) {
                    $query->where('nama_kepala_keluarga', 'LIKE', "%$searchQuery%");
                })
                ->orWhereDate('created_at', $searchQuery); // Pencarian berdasarkan tanggal
        })->paginate(10); // Ganti sesuai dengan jumlah data yang ingin ditampilkan per halaman

        // Return data dalam bentuk JSON
        return response()->json($data);
    }
}
