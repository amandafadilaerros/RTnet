<?php

namespace App\Http\Controllers;

use App\Models\kkModel;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class paguyubanController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Paguyuban',
            'list' => ['Bendahara', 'Paguyuban'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'paguyuban';

        $kk = kkModel::all(); // Mengambil semua data KK dari model
        $kkNonPaguyuban = KkModel::where('paguyuban', false)
                          ->orWhereNull('paguyuban')
                          ->get(); // Mengambil semua data KK dari model

        return view('paguyuban', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk, 'kkNonPaguyuban' => $kkNonPaguyuban, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
{
    if ($request->ajax()) {
        // Validasi input dari form pencarian
        $request->validate([
            'search' => 'nullable|string|max:255', // Kolom pencarian, bisa berupa teks atau kosong
        ]);

        try {
            // Mengambil data berdasarkan input pencarian
            $searchQuery = $request->input('search');

            // Base query
            $data = KkModel::where('paguyuban', true);

            // Filter data berdasarkan pencarian teks
            if ($searchQuery) {
                $data->where(function ($query) use ($searchQuery) {
                    $query->where('nama_kepala_keluarga', 'LIKE', "%$searchQuery%")
                        ->where('paguyuban',1);
                    
                });
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);

        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }
}


    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|integer'
        ]);

        $kk = KkModel::where('no_kk', $request->no_kk)->first();
        $kk->paguyuban = true;
        $kk->save();

        return redirect()->back()->with('success', 'Berhasil ditambahkan ke daftar penduduk yang ikut paguyuban');
    }

    public function edit(Request $request)
    {
        // Validasi request
        $request->validate([
            'no_kk' => 'required|integer', // Sesuaikan dengan aturan validasi yang sesuai
        ]);

        // Ambil data KK berdasarkan nomor KK
        $kk = kkModel::where('no_kk', $request->no_kk)->first();

        // Jika data ditemukan, kirimkan sebagai respon JSON
        if ($kk) {
            return response()->json($kk);
        } else {
            // Jika data tidak ditemukan, kirim respon kosong atau pesan error
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|integer',
            'old_no_kk' => 'required|integer',
        ]);

        // Set old_no_kk paguyuban menjadi false
        $oldKk = KkModel::where('no_kk', $request->old_no_kk)->first();
        if ($oldKk) {
            $oldKk->paguyuban = false;
            $oldKk->save();
        }

        // Set no_kk baru paguyuban menjadi true
        $kk = KkModel::where('no_kk', $request->no_kk)->first();
        if ($kk) {
            $kk->paguyuban = true;
            $kk->save();
        }

        return redirect()->back()->with('success', 'Berhasil diperbarui ke daftar penduduk yang ikut paguyuban');
    }


    // Menghapus data KK dari Paguyuban (mengubah kolom paguyuban menjadi false)
    public function destroy(Request $request)
    {
        $kk = KkModel::where('no_kk', $request->no_kk)->first();
        $kk->paguyuban = false;
        $kk->save();

        return redirect()->back()->with('success', 'Berhasil dihapus dari paguyuban');
    }
}
