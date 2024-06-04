<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\akun;
use Illuminate\Support\Facades\Hash;

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

    public function update_password(Request $request)
    {
        $akun = akun::find(session()->get('id_akun'));
        
        // Validasi apakah password lama sesuai dengan yang tersimpan di database
        if (!Hash::check($request->old_password, $akun->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.'])->withInput();
        }
        $akun->password = Hash::make($request->password);
        $akun->save();

        return redirect('/bendahara/akunBendahara')->with('success', 'Password berhasil diubah.');
    }

    public function list(Request $request)
    {
        $bendaharas = iuranModel::select('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
            ->with('kk')
            ->groupBy('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'created_at')
            ->orderBy('created_at', 'ASC');

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

        // Filter data berdasarkan filter yang dipilih
        if ($request->filter) {
            $filter = $request->filter;
            $bendaharas->where(function ($query) use ($filter) {
                if (strtolower($filter) === 'kas') {
                    $query->where('jenis_iuran', 'Kas')
                        ->orWhere('jenis_iuran', 'Tambahan'); // Contoh tambahan kondisi lainnya
                } else {
                    $query->where('jenis_iuran', $filter);
                }
            });
        }

        return DataTables::of($bendaharas)
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
