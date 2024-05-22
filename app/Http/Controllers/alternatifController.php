<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\Matrik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class alternatifController extends Controller
{
    public function list(Request $request)
    {
        $alternatif = alternatif::select('id_alternatif', 'nama_alternatif');

        // if ($request->kategori_id){
        //     $alternatif->where('kategori_id', $request->kategori_id);
        // }

        return DataTables::of($alternatif)
            ->addIndexColumn()
            // ->addColumn('aksi', function ($barang) {
            //     $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $barang->id_alternatif .'"><i class="fas fa-pen"></i></a>';
            //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal data-id="'. $barang->id_alternatif .'"><i class="fas fa-trash"></i></a>';
            //     return $btn;
            // })
            // ->rawColumns(['aksi'])
            ->make(true);
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_alternatif' => 'required|string|max:255',
            'kemudahan_pelaksanaan' => 'required|integer|between:1,5',
            'jumlah_partisipan' => 'required|integer|between:1,5',
            'tingkat_urgensi' => 'required|integer|between:1,5',
            'dampak_sosial' => 'required|integer|between:1,5',
            'tingkat_uang' => 'required|integer|between:1,5',
        ]);

        // Simpan data alternatif baru ke database
        $alternatif = Alternatif::create([
            'nama_alternatif' => $validatedData['nama_alternatif'],
        ]);

        // Simpan nilai kriteria ke model Matrik
        Matrik::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'id_kriteria' => 1, // ID Kriteria untuk kemudahan pelaksanaan
            'nilai' => $validatedData['kemudahan_pelaksanaan'],
        ]);
        Matrik::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'id_kriteria' => 2, // ID Kriteria untuk jumlah partisipan
            'nilai' => $validatedData['jumlah_partisipan'],
        ]);
        Matrik::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'id_kriteria' => 3, // ID Kriteria untuk tingkat urgensi
            'nilai' => $validatedData['tingkat_urgensi'],
        ]);
        Matrik::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'id_kriteria' => 4, // ID Kriteria untuk dampak sosial
            'nilai' => $validatedData['dampak_sosial'],
        ]);
        Matrik::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'id_kriteria' => 5, // ID Kriteria untuk dana yang dibutuhkan
            'nilai' => $validatedData['tingkat_uang'],
        ]);

        // Redirect ke halaman yang sesuai
        return redirect('/ketuaRt/alternatif')->with('success', 'Data alternatif berhasil ditambah');
    }

    public function getData(Request $request)
    {
        // Mengambil id_alternatif dari request
        $idAlternatif = $request->id_alternatif;

        // Mencari data alternatif berdasarkan ID
        $alternatif = Alternatif::find($idAlternatif);

        // Jika data tidak ditemukan, kembalikan respon not found
        if (!$alternatif) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Mengambil nilai-nilai matrik berdasarkan id_alternatif yang dipilih
        $nilaiMatrik = Matrik::where('id_alternatif', $idAlternatif)->get();

        // Menggabungkan data alternatif dengan nilai-nilai matrik
        $data = [
            'nama_alternatif' => $alternatif,
            'nilai_matrik' => $nilaiMatrik
        ];

        // Mengembalikan data dalam format JSON
        return response()->json($data);
    }

    public function update(Request $request,)
    {
        $request->validate([
            'nama_alternatif' => 'required|string|max:255',
            'kemudahan_pelaksanaan' => 'required|integer|between:1,5',
            'jumlah_partisipan' => 'required|integer|between:1,5',
            'tingkat_urgensi' => 'required|integer|between:1,5',
            'dampak_sosial' => 'required|integer|between:1,5',
            'tingkat_uang' => 'required|integer|between:1,5',
        ]);

        // Lakukan pembaruan
        alternatif::find($request->id_alternatif)->update([
            'nama_alternatif' => $request->nama_alternatif,
        ]);

        Matrik::where('id_alternatif', $request->id_alternatif)
        ->where('id_kriteria', 1) // ID Kriteria untuk kemudahan pelaksanaan
        ->update(['nilai' => $request->kemudahan_pelaksanaan]);

        Matrik::where('id_alternatif', $request->id_alternatif)
        ->where('id_kriteria', 2) // ID Kriteria untuk jumlah partisipan
        ->update(['nilai' => $request->jumlah_partisipan]);

        Matrik::where('id_alternatif', $request->id_alternatif)
        ->where('id_kriteria', 3) // ID Kriteria untuk tingkat urgensi
        ->update(['nilai' => $request->tingkat_urgensi]);

        Matrik::where('id_alternatif', $request->id_alternatif)
        ->where('id_kriteria', 4) // ID Kriteria untuk dampak sosial
        ->update(['nilai' => $request->dampak_sosial]);

        Matrik::where('id_alternatif', $request->id_alternatif)
        ->where('id_kriteria', 5) // ID Kriteria untuk dana yang dibutuhkan
        ->update(['nilai' => $request->tingkat_uang]);

        return redirect('/ketuaRt/alternatif')->with('success', 'Data alternatif berhasil diubah');
    }
    public function destroy(Request $request)
    {
        $check = alternatif::find($request->id_alternatif);
        if (!$check) {
            return redirect('/ketuaRt/alternatif')->with('error', 'Data alternatif tidak ditemukan');
        }

        try {
            alternatif::destroy($request->id_alternatif);

            return redirect('/ketuaRt/alternatif')->with('success', 'Data alternatif berhasil dihapus');
        } catch (\illuminate\Database\QueryException $e) {
            return redirect('/ketuaRt/alternatif')->with('error', 'Data alternatif gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
