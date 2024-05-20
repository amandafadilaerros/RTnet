<?php

namespace App\Http\Controllers;

use App\Models\akun;
use Illuminate\Http\Request;
use App\Models\IuranModel;
use App\Models\Inventaris;
use App\Models\ktp;
use App\Models\Pengumumans;
use Illuminate\Support\Facades\DB;

// use App\Models\ktp;


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
        $ktp = ktp::count();

        $totalPemasukan = iuranModel::where('jenis_transaksi', 'pemasukan')->sum('nominal');
        $totalPengeluaran = iuranModel::where('jenis_transaksi', 'pengeluaran')->sum('nominal');

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
                return view('ketuaRT.dashboardKetuaRt', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman, 'ktp' => $ktp]);
                break;
            case 'penduduk':
                return view('penduduk.dashboard', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman, 'data_grafik' => $data_grafik]);
                break;
            case 'sekretaris':
                return view('sekretaris.dashboardSekretaris', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman]);
                break;
            case 'bendahara':
                return view('bendahara.dashboardBendahara', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'role' => $role, 'laporan_keuangan' => $laporan_keuangan, 'inventaris' => $inventaris, 'pengumuman' => $pengumuman, 'totalPemasukan' => $totalPemasukan, 'totalPengeluaran' => $totalPengeluaran]);
                break;
        }
    }
    public function login(Request $request)
    {
        // Find the user by family number (assuming family_number is a unique identifier)
        $role = akun::find($request->family_number);
        // id akun harus sesuai dengan nkk
        $request->session()->put('id_akun', $role->id_akun);
        // nama harus sesuai dengan kk (proses pembuatan akun dari inputan kk rt/sekretaris)
        $request->session()->put('nama', $role->nama);


        // If the user is not found, handle the error (e.g., redirect back with an error message)
        if (!$role) {
            return back()->withErrors(['family_number' => 'Family number not found.']);
        }

        // Verify the password by comparing plaintext passwords
        if ($request->password !== $role->password) {
            return back()->withErrors(['password' => 'The provided password does not match our records.']);
        }

        // Retrieve the name of the role (nama_level) from the levels table
        $level = DB::table('levels')->where('id_level', $role->id_level)->first();

        if (!$level) {
            return back()->withErrors(['role' => 'The role level associated with this user does not exist.']);
        }

        // Store the nama_level in session
        $request->session()->put('role', $level->nama_level);

        // Retrieve the role from the session
        $sessionRole = session()->get('role');

        // Debug and dump the session role value (optional)
        // dd($sessionRole);

        // Prepare common variables
        $laporan_keuangan = IuranModel::count();
        $inventaris = Inventaris::count();
        $pengumuman = Pengumumans::count();
        $ktp = ktp::count();

        $totalPemasukan = IuranModel::where('jenis_transaksi', 'pemasukan')->sum('nominal');
        $totalPengeluaran = IuranModel::where('jenis_transaksi', 'pengeluaran')->sum('nominal');

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

        // Switch based on the session role
        switch ($sessionRole) {
            case 'ketua_rt':
                return view('ketuaRT.dashboardKetuaRt', [
                    'breadcrumb' => $breadcrumb,
                    'page' => $page,
                    'activeMenu' => $activeMenu,
                    'role' => $sessionRole,
                    'laporan_keuangan' => $laporan_keuangan,
                    'inventaris' => $inventaris,
                    'pengumuman' => $pengumuman,
                    'ktp' => $ktp
                ]);
            case 'penduduk':
                return view('penduduk.dashboard', [
                    'breadcrumb' => $breadcrumb,
                    'page' => $page,
                    'activeMenu' => $activeMenu,
                    'role' => $sessionRole,
                    'laporan_keuangan' => $laporan_keuangan,
                    'inventaris' => $inventaris,
                    'pengumuman' => $pengumuman,
                    'data_grafik' => $data_grafik
                ]);
            case 'sekretaris':
                return view('sekretaris.dashboardSekretaris', [
                    'breadcrumb' => $breadcrumb,
                    'page' => $page,
                    'activeMenu' => $activeMenu,
                    'role' => $sessionRole,
                    'laporan_keuangan' => $laporan_keuangan,
                    'inventaris' => $inventaris,
                    'pengumuman' => $pengumuman
                ]);
            case 'bendahara':
                return view('bendahara.dashboardBendahara', [
                    'breadcrumb' => $breadcrumb,
                    'page' => $page,
                    'activeMenu' => $activeMenu,
                    'role' => $sessionRole,
                    'laporan_keuangan' => $laporan_keuangan,
                    'inventaris' => $inventaris,
                    'pengumuman' => $pengumuman,
                    'totalPemasukan' => $totalPemasukan,
                    'totalPengeluaran' => $totalPengeluaran
                ]);
        }
    }
}