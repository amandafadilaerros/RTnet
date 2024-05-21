<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class alternatifController extends Controller
{
    public function list(Request $request){
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
    public function store(Request $request){
        $validated = $request->validate([
            'nama_alternatif' => 'bail|required',
        ]);
        
        alternatif::create([
            'nama_alternatif' => $request->nama_alternatif,
        ]);

        return redirect('/ketuaRt/alternatif')->with('success', 'Data alternatif berhasil disimpan');
    }
    public function getData(Request $request){
        $idAlternatif = $request->id_alternatif;

        // Lakukan apa pun yang diperlukan dengan ID inventaris
        // Di sini Anda dapat melakukan pencarian atau operasi lainnya
        $alternatif = alternatif::find($idAlternatif);

        // Misalnya, mengembalikan data alternatif dalam format JSON
        return response()->json($alternatif);
    }
    public function update(Request $request,){
        $request->validate([
            'nama_alternatif' => 'bail|required',
        ]);
    
        // Lakukan pembaruan
        alternatif::find($request->id_alternatif)->update([
            'nama_alternatif' => $request->nama_alternatif,
        ]);

        return redirect('/ketuaRt/alternatif')->with('success', 'Data alternatif berhasil diubah');
    }
    public function destroy(Request $request){
        $check = alternatif::find($request->id_alternatif);
        if(!$check) {
            return redirect('/ketuaRt/alternatif')->with('error', 'Data alternatif tidak ditemukan');
        }

        try{
            alternatif::destroy($request->id_alternatif);

            return redirect('/ketuaRt/alternatif')->with('success', 'Data alternatif berhasil dihapus');
        }catch (\illuminate\Database\QueryException $e){
            return redirect('/ketuaRt/alternatif')->with('error', 'Data alternatif gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
