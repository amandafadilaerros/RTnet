<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun;
use App\Models\inventaris;
use App\Models\iuranModel;
use App\Models\kkModel;
use App\Models\ktp;
use App\Models\pengumumans;
use App\Models\rumahModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class sekretarisController extends Controller
{
    public function index()
    {

        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();

        // Ambil data untuk grafik garis dari kolom jenis_penduduk di dalam tabel ktps
        $data_grafik = [
            'pendudukTetapCount' => ktp::where('jenis_penduduk', 'Penduduk Tetap')->count(),
            'pendudukKosCount' => ktp::where('jenis_penduduk', 'Penduduk Kos')->count()
        ];

        // Ambil jumlah penduduk berdasarkan bulan
        $pendudukData = Ktp::select(
            DB::raw('MONTH(tgl_masuk) as bulan'),
            DB::raw('count(*) as total_penduduk')
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Mengubah data menjadi format yang lebih mudah digunakan di JavaScript
        $data_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_bulan[$i] = 0; // Inisialisasi setiap bulan dengan nilai 0
        }
        foreach ($pendudukData as $item) {
            $data_bulan[$item->bulan] = $item->total_penduduk;
        }

        // Inisialisasi variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];
        $activeMenu = 'dashboard';
        $ktpTetap = ktp::where('jenis_penduduk', 'Tetap')->count();
        $ktpKos = ktp::where('jenis_penduduk', 'kos')->count();
        $rumah = rumahModel::all()->count();
        $kk = kkModel::all()->count();
        $pendudukData = ktp::select(
            DB::raw('MONTH(tgl_masuk) as bulan'),
            DB::raw('count(*) as total_penduduk')
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        $data_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_bulan[$i] = 0; // Inisialisasi setiap bulan dengan nilai 0
        }
        foreach ($pendudukData as $item) {
            $data_bulan[$item->bulan] = $item->total_penduduk;
        }
        // dd($data_bulan);


        return view('sekretaris.dashboardSekretaris', compact('laporan_keuangan', 'activeMenu', 'rumah', 'kk', 'data_bulan', 'inventaris', 'ktpTetap', 'ktpKos', 'pengumuman', 'data_grafik', 'data_bulan', 'breadcrumb'));

    }
    public function dataPenduduk()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Penduduk',
            'list' => ['Home', 'Data Penduduk'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_penduduk';

        return view('dataPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function akun()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => ['Home', 'Akun Saya'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun';

        return view('akunSekretaris', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function update_password(Request $request)
    {
        $akun = akun::find(session()->get('id_akun'));

        // Validasi apakah password lama sesuai dengan yang tersimpan di database
        if (!Hash::check($request->old_password, $akun->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.'])->withInput();
        }
        $akun->password = Hash::make($request->password);
        $akun->save();

        return redirect('/sekretaris/akun')->with('success', 'Password berhasil diubah.');
    }
}
