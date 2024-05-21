<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IuranModel;
use App\Models\Inventaris;
use App\Models\ktp;
use App\Models\Pengumumans;

class loginController extends Controller
{
    public function test(Request $request)
    {
        // Pengaturan role
        $role = $request->family_number;
        $request->session()->put('role', $role);

        // Mengambil data untuk dashboard
        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();
        $ktp = ktp::count();

        $totalPemasukan = iuranModel::where('jenis_transaksi', 'pemasukan')->sum('nominal');
        $totalPengeluaran = iuranModel::where('jenis_transaksi', 'pengeluaran')->sum('nominal');

        $data_grafik = [
            'penduduk_tetap' => ktp::where('jenis_penduduk', 'Penduduk Tetap')->count(),
            'penduduk_kos' => ktp::where('jenis_penduduk', 'Penduduk Kos')->count()
        ];

        // Variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['--', '--'],
        ];

        $activeMenu = 'dashboard';

        // Mengembalikan view sesuai dengan role
        switch ($role) {
            case 'ketua_rt':
                return view('ketuaRT.dashboardKetuaRt', compact('breadcrumb', 'activeMenu', 'role', 'laporan_keuangan', 'inventaris', 'pengumuman', 'ktp'));
            case 'penduduk':
                return view('penduduk.dashboard', compact('breadcrumb', 'activeMenu', 'role', 'laporan_keuangan', 'inventaris', 'pengumuman', 'data_grafik'));
            case 'sekretaris':
                return view('sekretaris.dashboardSekretaris', compact('breadcrumb', 'activeMenu', 'role', 'laporan_keuangan', 'inventaris', 'pengumuman'));
            case 'bendahara':
                return view('bendahara.dashboardBendahara', compact('breadcrumb', 'activeMenu', 'role', 'laporan_keuangan', 'inventaris', 'pengumuman', 'totalPemasukan', 'totalPengeluaran'));
        }
    }
}
