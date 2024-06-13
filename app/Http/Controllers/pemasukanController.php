<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\iuranModel;
use App\Models\kkModel;
use App\Models\rumahModel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class pemasukanController extends Controller
{
    public function index()
    {
        // ini hanya TEST
        $breadcrumb = (object) [
            'title' => 'Pemasukan',
            'list' => ['Bendahara', 'Pemasukan'],
        ];
        $page = (object) [
            'title' => '-----',
        ];

        $activeMenu = 'pemasukan';

        $kk = kkModel::all(); // Mengambil semua data KK dari model
        $kkPaguyuban = KkModel::where('paguyuban', true)->get(); // Mengambil semua data KK dari model

        return view('pemasukan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk, 'kkPaguyuban' => $kkPaguyuban, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        // Validasi input dari form pencarian
        $request->validate([
            'search' => 'nullable|string|max:255', // Kolom pencarian, bisa berupa teks atau kosong
            'no_kk' => 'nullable|integer', // Validasi input no_kk
        ]);

        try {
            // Mengambil data berdasarkan input pencarian
            $searchQuery = $request->input('search');
            $no_kk = $request->input('no_kk');

            $bendaharas = iuranModel::select('id_iuran', 'nominal', 'keterangan', 'jenis_transaksi', 'jenis_iuran', 'no_kk', 'bulan', 'created_at')
                ->with('kk')
                // ->where('jenis_transaksi', 'pemasukan') // Hanya mengambil jenis transaksi "pemasukan"
                ->orderBy('created_at', 'DESC'); // Urutkan berdasarkan bulan secara descending

            // Filter data berdasarkan no_kk
            if ($no_kk) {
                $bendaharas->where('no_kk', $no_kk);
            }

            // Filter data berdasarkan pencarian teks
            if ($searchQuery) {
                $bendaharas->where(function ($query) use ($searchQuery) {
                    $query->where('nominal', 'LIKE', "%$searchQuery%")
                        ->orWhere('jenis_iuran', 'LIKE', "%$searchQuery%")
                        ->orWhereHas('kk', function ($query) use ($searchQuery) {
                            $query->where('nama_kepala_keluarga', 'LIKE', "%$searchQuery%");
                        });

                    // Check if searchQuery is a valid date
                    if (strtotime($searchQuery)) {
                        $query->orWhereDate('bulan', $searchQuery); // Pencarian berdasarkan tanggal
                    }
                });
            }

            // Fetch the data
            $bendaharasData = $bendaharas->get();
            \Log::info($bendaharasData);

            // Menggunakan DataTables untuk memformat data
            return DataTables::of($bendaharasData)
                ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
                ->addColumn('bulan_formatted', function ($row) {
                    return Carbon::parse($row->bulan)->format('m'); // Format datetime sesuai kebutuhan
                })
                ->addColumn('transaksi_formatted', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y'); // Format datetime sesuai kebutuhan
                })
                ->rawColumns(['bulan_formatted']) // memberitahu bahwa kolom bulan_formatted adalah HTML
                ->rawColumns(['transaksi_formatted']) // memberitahu bahwa kolom bulan_formatted adalah HTML
                ->make(true);

        } catch (\Exception $e) {
            \Log::error('Error fetching data: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }



    public function checkIuran(Request $request)
    {
        $no_kk = $request->input('no_kk');
        $jenis_iuran = $request->input('jenis_iuran');
        $response = [];

        if ($jenis_iuran === 'Kas') {
            $warga = kkModel::where('no_kk', $no_kk)->first();

            if ($warga) {
                $no_rumah = $warga->no_rumah;
                $count_no_kk = kkModel::where('no_rumah', $no_rumah)->count();
                $rumah = rumahModel::where('no_rumah', $no_rumah)->first();

                $response['no_rumah'] = $no_rumah;
                $response['count_no_kk'] = $count_no_kk;
                $response['status_rumah'] = $rumah->status_rumah;
            } else {
                return response()->json(['error' => 'Warga tidak ditemukan'], 404);
            }
        }

        // Pengecekan pembayaran terakhir berdasarkan no_kk yang dipilih dan jenis_iuran yang diberikan
        $pembayaranTerakhir = iuranModel::where('no_kk', $no_kk)
            ->where('jenis_iuran', $jenis_iuran)
            ->orderBy('bulan', 'desc')
            ->first();

        $bulanPembayaranTerakhir = $pembayaranTerakhir ? Carbon::parse($pembayaranTerakhir->bulan)->format('Y-m') : Carbon::now()->format('Y-m');
        $bulanSelanjutnya = Carbon::parse($bulanPembayaranTerakhir)->addMonth()->format('Y-m');

        $response['bulanSelanjutnya'] = $bulanSelanjutnya;

        return response()->json($response);
    }


    public function store(Request $request)
    {
        $request->merge(['jenis_transaksi' => 'pemasukan']); // Pengisian manual jenis transaksi

        $request->validate([
            'nominal' => 'required|numeric',
            'jenis_transaksi' => 'required|max:10',
            'jenis_iuran' => 'required|max:50',
            'no_kk' => 'required|integer',
            'bulan_mulai' => 'required|date', // Tambahkan validasi untuk bulan mulai
            'bulan_selesai' => 'nullable|date', // Jadikan bulan selesai opsional
        ]);

        // Menghitung jumlah bulan antara bulan mulai dan bulan selesai
        $start = Carbon::parse($request->bulan_mulai);
        $end = $request->filled('bulan_selesai') ? Carbon::parse($request->bulan_selesai) : $start;
        $diffInMonths = $end->diffInMonths($start) + 1;

        // Memastikan diffInMonths tidak bernilai negatif
        $diffInMonths = max(1, $diffInMonths);

        // Menghitung nominal per bulan
        $nominal = $request->nominal;
        $kasNominal = 0;
        if ($request->jenis_iuran === 'Paguyuban') {
            // Kurangi nominal sebesar 5000 per bulan untuk 'Paguyuban' dan tambahkan ke 'Kas'
            $kasNominal = 5000 * $diffInMonths;
            $nominal -= $kasNominal;
        }

        $nominalPerBulan = $nominal / $diffInMonths;

        // Jika bulan selesai tidak diisi, maka lakukan penyimpanan untuk bulan mulai saja
        if (!$request->filled('bulan_selesai')) {
            iuranModel::create([
                'nominal' => $nominal,
                'jenis_transaksi' => $request->jenis_transaksi,
                'jenis_iuran' => $request->jenis_iuran,
                'no_kk' => $request->no_kk,
                'bulan' => $start->format('Y-m-d'), // Simpan bulan dalam format 'YYYY-MM'
            ]);

            if ($kasNominal > 0) {
                iuranModel::create([
                    'nominal' => $kasNominal,
                    'jenis_transaksi' => $request->jenis_transaksi,
                    'jenis_iuran' => 'Tambahan',
                    'no_kk' => $request->no_kk,
                    'bulan' => $start->format('Y-m-d'), // Simpan bulan dalam format 'YYYY-MM'
                ]);
            }
        } else {
            // Jika bulan selesai diisi, lakukan penyimpanan untuk setiap bulan di antara bulan mulai dan bulan selesai
            $start = Carbon::parse($request->bulan_mulai);
            $end = Carbon::parse($request->bulan_selesai);

            // Lakukan iterasi dari bulan mulai hingga bulan selesai
            while ($start <= $end) {
                iuranModel::create([
                    'nominal' => $nominalPerBulan,
                    'jenis_transaksi' => $request->jenis_transaksi,
                    'jenis_iuran' => $request->jenis_iuran,
                    'no_kk' => $request->no_kk,
                    'bulan' => $start->format('Y-m-d'), // Simpan bulan dalam format 'YYYY-MM'
                ]);

                if ($kasNominal > 0) {
                    iuranModel::create([
                        'nominal' => 5000,
                        'jenis_transaksi' => $request->jenis_transaksi,
                        'jenis_iuran' => 'Tambahan',
                        'no_kk' => $request->no_kk,
                        'bulan' => $start->format('Y-m-d'), // Simpan bulan dalam format 'YYYY-MM'
                    ]);
                }

                // Pindah ke bulan berikutnya
                $start->addMonth();
            }
        }

        return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil disimpan');
    }



    public function edit(Request $request)
    {
        $idIuran = $request->id_iuran;

        // Lakukan apa pun yang diperlukan dengan ID inventaris
        // Di sini Anda dapat melakukan pencarian atau operasi lainnya
        $iuran = iuranModel::find($idIuran);

        // Misalnya, mengembalikan data inventaris dalam format JSON
        return response()->json($iuran);
    }


    public function update(Request $request)
    {
        $id = $request->id_iuran;
        $request->validate([
            'nominal' => 'required|numeric', // Ubah 'decimal' menjadi 'numeric' agar sesuai dengan validasi
            'no_kk' => 'required|integer', // Ubah 'bigint' menjadi 'integer' agar sesuai dengan validasi
        ]);

        iuranModel::find($id)->update([
            'nominal' => $request->nominal, // Sesuaikan dengan field 'nominal' pada model
            'no_kk' => $request->no_kk, // Sesuaikan dengan field 'no_kk' pada model
        ]);

        return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $id = $request->id_iuran;
        $check = iuranModel::find($id);

        if (!$check) {
            return redirect('/bendahara/pemasukan')->with('error', 'Data tidak ditemukan');
        }

        try {
            // Dapatkan no_kk, bulan, dan jenis_iuran dari catatan yang akan dihapus
            $no_kk = $check->no_kk;
            $bulan = Carbon::parse($check->bulan);
            $jenis_iuran = $check->jenis_iuran;

            // Query dasar untuk mencari catatan yang akan dihapus
            $query = iuranModel::where('no_kk', $no_kk)
                ->where('bulan', '>=', $bulan->format('Y-m-d'));

            // Jika jenis_iuran adalah paguyuban, tambahkan filter untuk jenis_iuran "Tambahan"
            if ($jenis_iuran === 'Paguyuban') {
                $query->where(function ($q) {
                    $q->where('jenis_iuran', 'Paguyuban')
                        ->orWhere('jenis_iuran', 'Tambahan');
                });
            } else {
                // Jika jenis_iuran bukan paguyuban, filter hanya berdasarkan jenis_iuran yang sama
                $query->where('jenis_iuran', $jenis_iuran);
            }

            // Dapatkan semua catatan yang sesuai dengan kriteria di atas
            $catatanUntukDihapus = $query->get();

            // Hapus semua catatan yang ditemukan
            foreach ($catatanUntukDihapus as $catatan) {
                $catatan->delete();
            }

            return redirect('/bendahara/pemasukan')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/bendahara/pemasukan')->with('error', 'Data gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }





    public function search(Request $request)
    {
        // Validasi input dari form pencarian
        $request->validate([
            'search' => 'nullable|string|max:255', // Kolom pencarian, bisa berupa teks atau kosong
        ]);

        // Mengambil data berdasarkan input pencarian
        $searchQuery = $request->input('search');

        // Query untuk mengambil data sesuai dengan input pencarian
        $data = iuranModel::where(function ($query) use ($searchQuery) {
            $query->where('nominal', 'LIKE', "%$searchQuery%")
                ->orWhere('jenis_iuran', 'LIKE', "%$searchQuery%")
                ->orWhereHas('kk', function ($query) use ($searchQuery) {
                    $query->where('nama_kepala_keluarga', 'LIKE', "%$searchQuery%");
                })
                ->orWhereDate('bulan', $searchQuery); // Pencarian berdasarkan tanggal
        })->paginate(10); // Ganti sesuai dengan jumlah data yang ingin ditampilkan per halaman

        // Return data dalam bentuk JSON
        return response()->json($data);
    }
}
