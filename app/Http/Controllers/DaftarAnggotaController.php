<?php

namespace App\Http\Controllers;

use App\Models\kkModel;
use App\Models\ktp;
use App\Models\PendudukKosModel;
use Illuminate\Http\Request;

class DaftarAnggotaController extends Controller
{
    public function index()
    {
        $no_kk = session()->get('id_akun');
        $kks = kkModel::select('nama_kepala_keluarga','no_kk','alamat','jumlah_individu')->where('no_kk', $no_kk)->get();
        $ktps = ktp::select('nama','NIK','agama','status_keluarga')->where('jenis_penduduk','tetap')->where('no_kk', $no_kk)->get();
        $ktpss = ktp::select('nama', 'NIK')->where('jenis_penduduk', 'kos')->where('no_kk', $no_kk)->get();
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Keluarga Saya',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'DaftarAnggota';

        return view('DaftarAnggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu , 'kks' => $kks, 'ktps' => $ktps, 'ktpss' => $ktpss]);
    }

    public function store(Request $request)
    {
        $noKK = session()->get('id_akun');
        // dd($request);

        $jumlahIndividu = kkModel::where('no_kk', $noKK)->value('jumlah_individu');
        $jumlahKtp = ktp::where('no_kk', $noKK)
                    ->where('jenis_penduduk', 'tetap')
                    ->count();
        if($jumlahKtp >= $jumlahIndividu){
            return redirect('/penduduk/DaftarAnggota')->with('error', 'Maaf, jumlah individu dalam KK sudah mencapai batas.');
        }

        $validated = $request->validate([
            'NIK' => 'required',
            'nama' => 'required',
            'tempat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'status_keluarga' => 'required',
            'dokumen' => 'image|max:5000'
            ]);
        $pathBaru = null;
            if ($request->hasFile('dokumen')) {
                $extFile = $request->dokumen->getClientOriginalExtension();
                $namaFile = 'web-'.time().".". $extFile;
    
                $path = $request->dokumen->move('gambar', $namaFile);
                $path = str_replace("\\","//",$path);
                
                $pathBaru = asset('gambar/'. $namaFile);
            }
        ktp::create([
                'NIK' => $request->NIK,
                'no_kk' => $noKK,
                'nama' => $request->nama,
                'tempat' => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan_darah' => $request->golongan_darah,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'status_keluarga' => $request->status_keluarga,
                'status_anggota' => $request->status_anggota,
                'jenis_penduduk' => 'tetap',
                'dokumen' => $pathBaru,
            ]);
                
        return redirect('/penduduk/DaftarAnggota')->with('success', 'Data anggota berhasil ditambahkan');
    }
    public function show(Request $request)
    {
        // dd($request);
        $ktp = ktp::find($request->NIK);
        // dd($ktp);

        return response()->json($ktp);
    }

    public function update(Request $request)
    {   
        // dd($request);
        $ktp = ktp::find($request->NIK);
        $request->validate([
            'NIK' => 'required',
            'nama' => 'required',
            'tempat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'status_keluarga' => 'required',
            'dokumen' => 'image|max:5000'
        ]);
        if ($request->hasFile('dokumen')) {
            $extFile = $request->dokumen->getClientOriginalExtension();
            $namaFile = 'web-'.time().".". $extFile;

            $path = $request->dokumen->move('gambar', $namaFile);
            $path = str_replace("\\","//",$path);
            
            $pathBaru = asset('gambar/'. $namaFile);
            ktp::find($request->nik)->update([
                'NIK' => $request->NIK,
                'nama' => $request->nama,
                'tempat' => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan_darah' => $request->golongan_darah,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'status_keluarga' => $request->status_keluarga,
                'status_anggota' => $request->status_anggota,
                'dokumen' => $pathBaru,
            ]);
        } else {
            ktp::find($request->nik)->update([
                'NIK' => $request->NIK,
                'nama' => $request->nama,
                'tempat' => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan_darah' => $request->golongan_darah,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'status_keluarga' => $request->status_keluarga,
                'status_anggota' => $request->status_anggota,
            ]);
        }
        return redirect('/penduduk/DaftarAnggota')->with('success', 'Data anggota berhasil diedit');
    }

    public function destroy(Request $request)
    {
        $ktp = ktp::find($request->NIK);
        $ktp->delete();
        return redirect('/penduduk/DaftarAnggota')->with('success', 'Data anggota berhasil dihapus');
    }

    public function store_kos(Request $request)
    {
        $noKK = session()->get('id_akun'); 

        $validated = $request->validate([
            'NIK' => 'required',
            'nama' => 'required',
            'tempat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'status_keluarga' => 'required',
            'dokumen' => 'image|max:5000'
            ]);
        $pathBaru = null;
            if ($request->hasFile('dokumen')) {
                $extFile = $request->dokumen->getClientOriginalExtension();
                $namaFile = 'web-'.time().".". $extFile;
    
                $path = $request->dokumen->move('gambar', $namaFile);
                $path = str_replace("\\","//",$path);
                
                $pathBaru = asset('gambar/'. $namaFile);
            }
        ktp::create([
                'NIK' => $request->NIK,
                'no_kk' => $noKK,
                'nama' => $request->nama,
                'tempat' => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan_darah' => $request->golongan_darah,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'status_keluarga' => $request->status_keluarga,
                'status_anggota' => $request->status_anggota,
                'jenis_penduduk' => 'kos',
                'dokumen' => $pathBaru,
            ]);
                
        return redirect('/penduduk/DaftarAnggota')->with('success', 'Data anggota berhasil ditambahkan');

    }

    public function show_kos(Request $request)
    {
        // dd($request);
        $kost= ktp::find($request->NIK);
        // dd($ktp);

        return response()->json($kost);
    }

    public function update_kos(Request $request)
    {
        $kost = ktp::find($request->NIK);
        $request->validate([
            'nama' => 'required',
            'NIK' => 'required',
            'no_kk' => 'required',
        ]);
        ktp::find($request->NIK)->update([
                'nama' => $request->nama,
                'NIK' => $request->NIK,
                'no_kk' => $request->no_kk,
        ]);
        return redirect('/penduduk/DaftarAnggota')->with('success', 'Data anggota berhasil diedit');
    }

    public function destroy_kos(Request $request)
    {
        $kost = ktp::find($request->NIK);
        $kost->delete();
        return redirect('/penduduk/DaftarAnggota')->with('success', 'Data anggota berhasil dihapus');
    }
}