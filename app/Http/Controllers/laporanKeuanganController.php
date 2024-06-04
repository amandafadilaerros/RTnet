<?php

namespace App\Http\Controllers;

use App\Models\iuranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use Yajra\DataTables\Facades\DataTables;

class laporanKeuanganController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'dashboard';

        return view('dashboardBendahara', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function keuangan()
    {
        // Menginisialisasi variabel breadcrumb
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['Home', 'Laporan Keuangan'],
        ];

        $activeMenu = 'laporan_keuangan';

        // Mengirimkan data ke tampilan Blade
        return view('laporanKeuangan', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function akun()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun_saya';

        return view('akunBendahara', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function list(Request $request){
        $keuangans = iuranModel::select('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
            ->with('kk')
            ->groupBy('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
            ->orderBy('created_at', 'ASC');

        // Filter data berdasarkan no_kk
        if ($request->no_kk) {
            $keuangans->where('no_kk', $request->no_kk);
        }

        // if ($request->kategori_id){
        //     $keuangans->where('kategori_id', $request->kategori_id);
        // }

        if ($request->has('customSearch') && !empty($request->customSearch)) {
            $search = $request->customSearch;
            $keuangans->where(function($query) use ($search) {
                $query->where('jenis_transaksi', 'like', "%{$search}%")
                      ->orWhere('jenis_iuran', 'like', "%{$search}%")
                      ->orWhere('no_kk', 'like', "%{$search}%");
            });
        }

        return DataTables::of($keuangans)
        ->addIndexColumn()
        ->addColumn('jumlah_uang_masuk', function ($row) {
            return $row->jenis_transaksi === 'pemasukan' ? $row->nominal : 0;
        })
        ->addColumn('jumlah_uang_keluar', function ($row) {
            return $row->jenis_transaksi === 'pengeluaran' ? $row->nominal : 0;
        })
        ->addColumn('saldo', function ($row) use ($request) {
            $totalUangMasuk = iuranModel::where('jenis_transaksi', 'pemasukan')
                ->where('id_iuran', '<=', $row->id_iuran)
                ->sum('nominal');
            $totalUangKeluar = iuranModel::where('jenis_transaksi', 'pengeluaran')
                ->where('id_iuran', '<=', $row->id_iuran)
                ->sum('nominal');
            return $totalUangMasuk - $totalUangKeluar;
        })
        ->make(true);
    }
}

