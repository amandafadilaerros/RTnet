<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IuranModel;
use App\Models\Inventaris;
use App\Models\Pengumumans;
use App\Models\ktp;


class loginController extends Controller
{
    public function test(Request $request)
    {
        // ini hanya TEST
        // PENENTU ROLE
        $role = $request->family_number;
        $request->session()->put('role', $role);

        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();

        $data_grafik = [
            'penduduk_tetap' => ktp::where('jenis_penduduk', 'Penduduk Tetap')->count(),
            'penduduk_kos' => ktp::where('jenis_penduduk', 'Penduduk Kos')->count()
        ];

        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'dashboard';

        switch ($role) {
            case 'ketua_rt':
                return view('ketuaRT.dashboardKetuaRt', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman]);
                break;
            case 'penduduk':
                return view('penduduk.dashboard', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman, 'data_grafik' => $data_grafik]);
                break;
            case 'sekretaris':
                return view('sekretaris.dashboardSekretaris', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman]);
                break;
            case 'bendahara':
                return view('bendahara.dashboardBendahara', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman]);
                break;
        }
    }
}