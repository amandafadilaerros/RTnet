<?php

use App\Http\Controllers\alternatifController;
use App\Http\Controllers\kerja_baktiController;
use App\Http\Controllers\bendaharaController;
use App\Http\Controllers\data_PendudukRTController;
use App\Http\Controllers\data_PendudukSekretarisController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\inventarisController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pemasukanController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\templateController;
use App\Http\Controllers\peminjamanController;
use App\Http\Controllers\daftar_peminjamanController;
use App\Http\Controllers\data_rumahRTController;
use App\Http\Controllers\data_rumahSekretarisController;
use App\Http\Controllers\ketuaController;
use App\Http\Controllers\data_kkRtController;
use App\Http\Controllers\data_kkSekretarisController;
use App\Http\Controllers\pendudukController;
use App\Http\Controllers\pengumumanKetuaController;
use App\Http\Controllers\laporanKeuanganController;
use App\Http\Controllers\sekretarisController;
use App\Http\Controllers\datapendudukController;
use App\Http\Controllers\detail_dataKKRtController;
use App\Http\Controllers\InventarisKetuaController;
use App\Http\Controllers\MabacController;
use App\Http\Controllers\MautController;
use App\Models\gambar;
use App\Models\inventaris;
use Illuminate\Auth\Events\Login;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');

});

Route::post('/dashboard', [loginController::class, 'login']);

Route::get('/templates', [templateController::class, 'index']);

//testing pemasukan
Route::get('/pemasukan', [pemasukanController::class, 'index']);

//Kerja Bakti
// Route::get('/kerjabakti', [kerjabaktiController::class, 'index']);




Route::group(['prefix' => 'ketuaRt'], function () {
    Route::get('/dashboard', [ketuaController::class, 'index']);
    //Data Rumah
    Route::group(['prefix' => 'data_rumah'], function () {
        Route::get('/', [data_rumahRTController::class, 'index']);
        Route::get('/mabac', [MabacController::class, 'calculateMabac']);
        Route::post('/list', [data_rumahRTController::class, 'list']);
        Route::get('/create', [data_rumahRTController::class, 'create']);
        Route::post('/', [data_rumahRTController::class, 'store']);
        Route::get('/show', [data_rumahRTController::class, 'show']);
        Route::post('/edit', [data_rumahRTController::class, 'edit']);
        Route::put('/update', [data_rumahRTController::class, 'update']);
        Route::delete('/delete', [data_rumahRTController::class, 'destroy']);
    });

    //Data Penduduk
    Route::group(['prefix' => 'data_penduduk'], function () {
        Route::get('/', [data_pendudukRTController::class, 'index']);
        Route::post('/list', [data_pendudukRTController::class, 'list']);
        Route::get('/create', [data_pendudukRTController::class, 'create']);
        Route::post('/', [data_pendudukRTController::class, 'store']);
        Route::get('/{id}', [data_pendudukRTController::class, 'show']);
        Route::get('/{id}/edit', [data_pendudukRTController::class, 'edit']);
        Route::put('/{id}', [data_pendudukRTController::class, 'update']);
        Route::delete('/{id}', [data_pendudukRTController::class, 'destroy']);
    });

    //Data KK
    Route::group(['prefix' => 'data_kk'], function () {
        Route::get('/', [data_kkRtController::class, 'index']);
        Route::post('/list', [data_kkRtController::class, 'list']);
        Route::get('/create', [data_kkRtController::class, 'create']);
        Route::post('/', [data_kkRtController::class, 'store']);
        Route::get('/show/{no_kk}', [data_kkRtController::class, 'show']); // Update the route to accept no_kk parameter
        Route::post('/edit', [data_kkRtController::class, 'edit']);
        Route::put('/update', [data_kkRtController::class, 'update']);
        Route::delete('/delete', [data_kkRtController::class, 'destroy']);
    });
    Route::group(['prefix' => 'detail_kk'], function () {
        Route::get('/{no_kk}', [detail_dataKKRtController::class, 'show']);
        Route::post('/list', [detail_dataKKRtController::class, 'list']);
        Route::post('/list2', [detail_dataKKRtController::class, 'list2']);
        Route::get('/create', [detail_dataKKRtController::class, 'create']);
        Route::post('/create', [detail_dataKKRtController::class, 'store']);
        Route::post('/create2', [detail_dataKKRtController::class, 'store2']);
        Route::get('/show', [detail_dataKKRtController::class, 'show']);
        Route::post('/edit', [detail_dataKKRtController::class, 'edit']);
        Route::put('/update', [detail_dataKKRtController::class, 'update']);
        Route::delete('/delete', [detail_dataKKRtController::class, 'destroy']);
    });

    // Route::get('/detail_anggota', [KKController::class, 'detail']);
    Route::get('/laporan_keuangan', [ketuaController::class, 'keuangan']);
    Route::get('/kerja_bakti', [ketuaController::class, 'kegiatan']);
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::get('/laporanKeuangan', [laporanKeuanganController::class, 'keuangan']);
    Route::post('/keuangan/list', [laporanKeuanganController::class, 'list']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/daftar_inventaris', [InventarisKetuaController::class, 'index']);
    Route::post('/inventaris', [InventarisKetuaController::class, 'store']);
    Route::post('/inventaris/getData', [InventarisKetuaController::class, 'getData']);
    Route::post('/inventaris/edit', [InventarisKetuaController::class, 'update']);
    Route::delete('/inventaris/delete', [InventarisKetuaController::class, 'destroy']);
    Route::post('/daftar_inventaris/list', [InventarisKetuaController::class, 'list']);
    Route::get('/daftar_peminjaman', [daftar_peminjamanController::class, 'index']);
    Route::post('/daftar_peminjaman/list', [daftar_peminjamanController::class, 'list']);
    Route::get('/daftar_peminjaman/edit/{id}', [daftar_peminjamanController::class, 'update']);
    Route::get('/kelola_pengumuman', [pengumumanKetuaController::class, 'index']);
    Route::post('/pengumuman/list', [pengumumanKetuaController::class, 'list']);
    Route::post('/pengumuman', [pengumumanKetuaController::class, 'store']);
    Route::post('/pengumuman/getData', [pengumumanKetuaController::class, 'getData']);
    Route::post('/pengumuman/edit', [pengumumanKetuaController::class, 'update']);
    Route::delete('/pengumuman/delete', [pengumumanKetuaController::class, 'destroy']);
    Route::get('/kriteria', [ketuaController::class, 'kriteria']);
    Route::get('/alternatif', [ketuaController::class, 'alternatif']);
    Route::post('/alternatif', [alternatifController::class, 'store']);
    Route::post('/alternatif/edit', [alternatifController::class, 'update']);
    Route::post('/alternatif/delete', [alternatifController::class, 'destroy']);
    Route::post('/alternatif/list', [alternatifController::class, 'list']);
    Route::post('/alternatif/getData', [alternatifController::class, 'getData']);
    Route::get('/maut', [mautController::class, 'index']);
    Route::get('/mabac', [MabacController::class, 'index']);
    Route::get('/akun', [ketuaController::class, 'akun']);
    Route::post('/akun', [ketuaController::class, 'update_password']);
});


Route::group(['prefix' => 'sekretaris'], function () {
    Route::get('/dashboard', [sekretarisController::class, 'index']);
    //Data Rumah
    Route::group(['prefix' => 'data_rumah'], function () {
        Route::get('/', [data_rumahSekretarisController::class, 'index']);
        Route::post('/list', [data_rumahSekretarisController::class, 'list']);
        Route::get('/create', [data_rumahSekretarisController::class, 'create']);
        Route::post('/', [data_rumahSekretarisController::class, 'store']);
        Route::get('/show', [data_rumahSekretarisController::class, 'show']);
        Route::post('/edit', [data_rumahSekretarisController::class, 'edit']);
        Route::put('/update', [data_rumahSekretarisController::class, 'update']);
        Route::delete('/delete', [data_rumahSekretarisController::class, 'destroy']);
    });

    //Data Penduduk
    Route::group(['prefix' => 'data_penduduk'], function () {
        Route::get('/', [data_pendudukSekretarisController::class, 'index']);
        Route::post('/list', [data_pendudukSekretarisController::class, 'list']);
        Route::get('/create', [data_pendudukSekretarisController::class, 'create']);
        Route::post('/', [data_pendudukSekretarisController::class, 'store']);
        Route::get('/{id}', [data_pendudukSekretarisController::class, 'show']);
        Route::get('/{id}/edit', [data_pendudukSekretarisController::class, 'edit']);
        Route::put('/{id}', [data_pendudukSekretarisController::class, 'update']);
        Route::delete('/{id}', [data_pendudukSekretarisController::class, 'destroy']);
    });

    //Data KK
    Route::group(['prefix' => 'data_kk'], function () {
        Route::get('/', [data_kkSekretarisController::class, 'index']);
        Route::post('/list', [data_kkSekretarisController::class, 'list']);
        Route::get('/create', [data_kkSekretarisController::class, 'create']);
        Route::post('/', [data_kkSekretarisController::class, 'store']);
        Route::get('/show', [data_kkSekretarisController::class, 'show']);
        Route::post('/edit', [data_kkSekretarisController::class, 'edit']);
        Route::put('/update', [data_kkSekretarisController::class, 'update']);
        Route::delete('/delete', [data_kkSekretarisController::class, 'destroy']);
    });

    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    // Route::get('/data_rumah', [data_rumahController::class, 'index']);
    // Route::get('/data_penduduk', [sekretarisController::class, 'dataPenduduk']);
    // Route::get('/data_kk', [KKController::class, 'index1']);
    // Route::get('/detail_anggota', [KKController::class, 'detail']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/akun', [sekretarisController::class, 'akun']);
    Route::post('/akun', [sekretarisController::class, 'update_password']);
});

Route::group(['prefix' => 'bendahara'], function () {
    Route::group(['prefix' => 'pemasukan'], function () {
        Route::get('/', [pemasukanController::class, 'index']);
        Route::get('/checkIuran', [pemasukanController::class, 'checkIuran']);
        Route::post('/list', [pemasukanController::class, 'list']);
        // Route::get('/create', [pemasukanController::class, 'create']);
        Route::post('/tambah', [pemasukanController::class, 'store']);
        // Route::get('/{id}', [pemasukanController::class, 'show']);
        Route::post('/edit', [pemasukanController::class, 'edit']);
        Route::post('/update', [pemasukanController::class, 'update']);
        Route::post('/search', [pemasukanController::class, 'search']);
        Route::delete('/destroy', [pemasukanController::class, 'destroy']);
    });
    Route::group(['prefix' => 'pengeluaran'], function () {
        Route::get('/', [pengeluaranController::class, 'index']);
        Route::post('/list', [pengeluaranController::class, 'list']);
        // Route::get('/create', [pengeluaranController::class, 'create']);
        Route::post('/tambah', [pengeluaranController::class, 'store']);
        // Route::get('/{id}', [pengeluaranController::class, 'show']);
        Route::post('/edit', [pengeluaranController::class, 'edit']);
        Route::post('/update', [pengeluaranController::class, 'update']);
        Route::delete('/destroy', [pengeluaranController::class, 'destroy']);
    });
    Route::get('/dashboardBendahara', [bendaharaController::class, 'index']);
    Route::get('/keuanganBendahara', [bendaharaController::class, 'keuangan']);
    Route::group(['prefix' => 'laporan'], function () {
        Route::post('/list', [bendaharaController::class, 'list']);
    });
    Route::get('/akunBendahara', [bendaharaController::class, 'akun']);
    Route::post('/akun', [bendaharaController::class, 'update_password']);
});

Route::group(['prefix' => 'penduduk'], function () {
    Route::get('/dashboard', [PendudukController::class, 'index'])->name('penduduk.dashboard');
    Route::get('/', [PendudukController::class, 'getData'])->name('penduduk.dashboard');
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/laporan_keuangan', [pendudukController::class, 'keuangan']);
    Route::get('/keuangan', [pendudukController::class, 'keuangan']);
    Route::get('/maut', [mautController::class, 'index']);
    Route::get('/mabac', [MabacController::class, 'index']);
    Route::get('/pengumuman', [pendudukController::class, 'pengumuman']);
    Route::post('/pengumuman', [pendudukController::class, 'list_pengumuman']);
    Route::get('/showPengumumanPenduduk/{id_pengumuman}', [pendudukController::class, 'show_pengumuman']);
    Route::get('/akun', [pendudukController::class, 'akun']);
    Route::group(['prefix' => 'laporan_keuangan'], function () {
        Route::post('/list', [pendudukController::class, 'list']);
    });

    Route::group(['prefix' => 'daftar_inventaris'], function () {
        Route::get('/inventaris/image/{id}', function ($id) {
            $inventaris = inventaris::with('gambar')->find($id);

            if ($inventaris && $inventaris->id_gambar) {
                $gambar = gambar::find($inventaris->id_gambar);
                // Get the image data from the database or storage
                $imageData = base64_encode($gambar->data_gambar); // Assuming you have an image relationship
                $mimeType = $gambar->mime_type; // Assuming you have a mime_type attribute

                // Return the image data with appropriate headers
                // return response($imageData, 200)->header('Content-Type', $mimeType);
                return response()->json([
                    'imageData' => $imageData,
                    'mimeType' => $mimeType
                ], 200);
            } else {
                return response()->json('Image not found', 404);
            }
        });
        Route::get('/', [inventarisController::class, 'index']);
        Route::post('/list', [inventarisController::class, 'list']);
        Route::post('/show/{request}', [inventarisController::class, 'show']);
        Route::get('/searchdate', [inventarisController::class, 'searchdate']);
    });
    Route::get('/peminjaman', [inventarisController::class, 'pk_peminjaman']);
    Route::get('/peminjaman/{id}', [inventarisController::class, 'store_peminjaman']);
    Route::post('/peminjaman/update', [inventarisController::class, 'update_peminjaman']);

});

Route::get('/inventaris/image/{id}', function ($id) {
    $inventaris = inventaris::with('gambar')->find($id);

    if ($inventaris && $inventaris->id_gambar) {
        $gambar = gambar::find($inventaris->id_gambar);
        // Get the image data from the database or storage
        $imageData = base64_encode($gambar->data_gambar); // Assuming you have an image relationship
        $mimeType = $gambar->mime_type; // Assuming you have a mime_type attribute

        // Return the image data with appropriate headers
        // return response($imageData, 200)->header('Content-Type', $mimeType);
        return response()->json([
            'imageData' => $imageData,
            'mimeType' => $mimeType
        ], 200);
    } else {
        return response()->json('Image not found', 404);
    }
});

//halaman tidak ditemukan
Route::fallback(function () {
    return view('404');
});

