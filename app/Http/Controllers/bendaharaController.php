<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use Yajra\DataTables\Facades\DataTables;

class bendaharaController extends Controller
{
    public function index()
    {
        // Mengambil total pemasukan dan pengeluaran
        $totalPemasukan = iuranModel::where('jenis_transaksi', 'pemasukan')->sum('nominal');
        $totalPengeluaran = iuranModel::where('jenis_transaksi', 'pengeluaran')->sum('nominal');
        $laporan_keuangan = IuranModel::count();

        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'dashboard';

        return view('bendahara.dashboardBendahara', compact('breadcrumb', 'page', 'activeMenu', 'totalPemasukan', 'totalPengeluaran', 'laporan_keuangan'));
    }


    public function keuangan()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Laporan Keuangan',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'laporan_keuangan';

        return view('keuanganBendahara', [
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

    public function list(Request $request)
    {
        $bendaharas = iuranModel::select('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
            ->with('kk')
            ->groupBy('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at') // Group by kolom tertentu
            ->orderBy('created_at', 'ASC'); // Urutkan berdasarkan created_at secara descending

        // Filter data berdasarkan no_kk
        if ($request->no_kk) {
            $bendaharas->where('no_kk', $request->no_kk);
        }

        // Filter data berdasarkan pencarian
        if ($request->search) {
            $search = $request->search;
            $bendaharas->where(function ($query) use ($search) {
                $query->where('nominal', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('jenis_iuran', 'like', '%' . $search . '%');
            });
        }

        // Menggunakan DataTables untuk memformat data
        return DataTables::of($bendaharas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('jumlah_uang_masuk', function ($row) {
                return $row->jenis_transaksi === 'pemasukan' ? $row->nominal : 0;
            })
            ->addColumn('jumlah_uang_keluar', function ($row) {
                return $row->jenis_transaksi === 'pengeluaran' ? $row->nominal : 0;
            })
            ->addColumn('saldo', function ($row) use ($request) {
                // Menghitung saldo dengan menjumlahkan jumlah uang masuk dan mengurangkan jumlah uang keluar
                $totalUangMasuk = iuranModel::where('jenis_transaksi', 'pemasukan')
                    ->where('created_at', '<=', $row->created_at) // Hanya menghitung data sebelum atau pada tanggal saat ini
                    ->sum('nominal');
                $totalUangKeluar = iuranModel::where('jenis_transaksi', 'pengeluaran')
                    ->where('created_at', '<=', $row->created_at) // Hanya menghitung data sebelum atau pada tanggal saat ini
                    ->sum('nominal');
                return $totalUangMasuk - $totalUangKeluar;
            })
            ->make(true);
    }
}
