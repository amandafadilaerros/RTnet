<?php

namespace App\Http\Controllers;

use App\Models\gambar;
use App\Models\inventaris;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventarisKetuaController extends Controller
{
    public function index(){
        // hanya untuk testing template
        $breadcrumb = (object) [
            'title' => 'Inventaris',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'inventaris';

        // $barang = BarangModel::all();

        return view('inventaris.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request){
        $barangs = inventaris::select('id_inventaris', 'nama_barang', 'jumlah', 'id_gambar')->with('gambar');

        if ($request->kategori_id){
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
        ->addIndexColumn()
        // ->addColumn('aksi', function ($barang) {
        //     $btn = '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="'. $barang->id_inventaris .'"><i class="fas fa-pen"></i></a>';
        //     $btn .= '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal data-id="'. $barang->id_inventaris .'"><i class="fas fa-trash"></i></a>';
        //     return $btn;
        // })
        // ->rawColumns(['aksi'])
        ->make(true);
    }
    public function store(Request $request): RedirectResponse{
        $validated = $request->validate([
            'nama_barang' => 'bail|required',
            'jumlah' => 'required|integer',
        ]);
        $id_gambar = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = $image->getClientOriginalName();
            $mimeType = $image->getMimeType();
            $imageData = file_get_contents($image->getRealPath());
    
            $newImage = new gambar;
            $newImage->nama_file = $filename;
            $newImage->mime_type = $mimeType;
            $newImage->data_gambar = $imageData;
            $newImage->save();

            $id_gambar = $newImage->id;
        }
        inventaris::create([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'id_gambar' => $id_gambar,
        ]);

        return redirect('/ketuaRt/daftar_inventaris')->with('success', 'Data barang berhasil disimpan');
    }
    public function getData(Request $request){
        $idInventaris = $request->id_inventaris;

        // Lakukan apa pun yang diperlukan dengan ID inventaris
        // Di sini Anda dapat melakukan pencarian atau operasi lainnya
        $inventaris = Inventaris::find($idInventaris);

        // Misalnya, mengembalikan data inventaris dalam format JSON
        return response()->json($inventaris);
    }
    public function update(Request $request,){
        $request->validate([
            'id_inventaris' => 'required',
            'nama_barang' => 'bail|required',
            'jumlah' => 'required|integer',
        ]);
        $gambar = inventaris::find($request->id_inventaris);

        $id_gambar = $gambar->id_gambar;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = $image->getClientOriginalName();
            $mimeType = $image->getMimeType();
            $imageData = file_get_contents($image->getRealPath());
    
            $newImage = new gambar;
            $newImage->nama_file = $filename;
            $newImage->mime_type = $mimeType;
            $newImage->data_gambar = $imageData;
            $newImage->save();

            $id_gambar = $newImage->id;
        }

        inventaris::find($request->id_inventaris)->update([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'id_gambar' => $id_gambar,
        ]);

        return redirect('/ketuaRt/daftar_inventaris')->with('success', 'Data barang berhasil diubah');
    }
}
