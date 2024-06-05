<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\alternatif;
use App\Models\inventaris;
use App\Models\kriteria;
use App\Models\ktp;
use App\Models\pengumumans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ketuaController extends Controller
{
    public function index()
    {
        $pengumuman = pengumumans::count();
        $inventaris = inventaris::count();
        $ktpTetap = ktp::where('jenis_penduduk', 'Tetap')->count();
        $ktpKos = ktp::where('jenis_penduduk', 'kos')->count();
        $pendudukData = Ktp::select(
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
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'dashboard',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'dashboard';

        return view('ketuaRT.dashboardKetuaRt', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'pengumuman' => $pengumuman,
            'inventaris' => $inventaris,
            'ktpTetap' => $ktpTetap,
            'data_bulan' => $data_bulan,
            'ktpKos' => $ktpKos
        ]);
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

        return view('keuanganPenduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function kegiatan()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Kerja Bakti',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'kerja_bakti';

        return view('kerja_bakti', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function data_Penduduk()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Data Penduduk',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'data_penduduk';

        return view('data_Penduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function kriteria()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Kriteria',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'kriteria';
        $kriteria = kriteria::all();
        $rentangNilai = [
            1 => [
                'nama' => 'Kemudahan Pelaksanaan',
                'rentang' => [
                    'Sangat susah' => 1,
                    'Susah' => 2,
                    'Sedang' => 3,
                    'Mudah' => 4,
                    'Sangat mudah' => 5,
                ]
            ],
            2 => [
                'nama' => 'Jumlah Partisipan',
                'rentang' => [
                    '1 - 5 orang' => 1,
                    '6 - 10 orang' => 2,
                    '11 - 15 orang' => 3,
                    '16 - 20 orang' => 4,
                    'Lebih dari 20 orang' => 5,
                ]
            ],
            3 => [
                'nama' => 'Tingkat Urgensi',
                'rentang' => [
                    'Sangat rendah' => 1,
                    'Rendah' => 2,
                    'Cukup' => 3,
                    'Tinggi' => 4,
                    'Sangat Tinggi' => 5,
                ]
            ],
            4 => [
                'nama' => 'Dampak Sosial',
                'rentang' => [
                    'Sangat rendah' => 1,
                    'Rendah' => 2,
                    'Cukup' => 3,
                    'Tinggi' => 4,
                    'Sangat Tinggi' => 5,
                ]
            ],
            5 => [
                'nama' => 'Dana',
                'rentang' => [
                    'uang < 200.000' => 1,
                    '200.000 <= uang < 400.000' => 2,
                    '400.000 <= uang < 600.000' => 3,
                    '600.000 <= uang < 800.000' => 4,
                    'uang >= 800.000' => 5,
                ]
            ]
        ];

        return view('kriteria', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kriteria' => $kriteria,
            'rentangNilai' => $rentangNilai
        ]);
    }
    public function alternatif()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Alternatif',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'alternatif';
        $alternatif = alternatif::all();

        return view('alternatif', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'alternatif' => $alternatif
        ]);
    }
    public function maut()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'MAUT',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'maut';

        return view('maut', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function mabac()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'MABAC',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'mabac';

        return view('mabac', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function akun()
    {
        
        // dd($akuns);
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Akun Saya',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'akun';

        return view('akunKetua', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
    }
    public function update_password(Request $request){
        $akun = akun::find(session()->get('id_akun'));
        
        // Validasi apakah password lama sesuai dengan yang tersimpan di database
        if (!Hash::check($request->old_password, $akun->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.'])->withInput();
        }
        $akun->password = Hash::make($request->password);
        $akun->save();

        return redirect('/ketuaRt/akun')->with('success', 'Password berhasil diubah.');
    }
}
