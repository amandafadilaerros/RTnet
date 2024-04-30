<?php

use App\Http\Controllers\kerja_baktiController;
use App\Http\Controllers\bendaharaController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\inventarisController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pemasukanController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\templateController;
use App\Http\Controllers\peminjamanController;
use App\Http\Controllers\daftar_peminjamanController;
use App\Http\Controllers\data_rumahController;
use App\Http\Controllers\ketuaController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\pendudukController;
use App\Http\Controllers\pengumumanKetuaController;
use App\Http\Controllers\laporanKeuanganController;
use App\Http\Controllers\sekretarisController;
use App\Http\Controllers\datapendudukController;
use App\Http\Controllers\InventarisKetuaController;
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

Route::post('/dashboard', [loginController::class, 'test']);

Route::get('/templates', [templateController::class, 'index']);

//testing pemasukan
Route::get('/pemasukan', [pemasukanController::class, 'index']);

//Kerja Bakti
// Route::get('/kerjabakti', [kerjabaktiController::class, 'index']);




Route::group(['prefix' => 'ketuaRt'], function () {
    Route::get('/dashboard', [ketuaController::class, 'index']);
    //Data Rumah
    Route::group(['prefix' => 'data_rumah'], function () {
        Route::get('/', [data_rumahController::class, 'index']);
        Route::post('/list', [data_rumahController::class, 'list']);
        Route::get('/create', [data_rumahController::class, 'create']);
        Route::post('/', [data_rumahController::class, 'store']);
        Route::get('/{id}', [data_rumahController::class, 'show']);
        Route::get('/{id}/edit', [data_rumahController::class, 'edit']);
        Route::put('/{id}', [data_rumahController::class, 'update']);
        Route::delete('/{id}', [data_rumahController::class, 'destroy']);
    });
    Route::get('/data_penduduk', [ketuaController::class, 'dataPenduduk']);
    //Data KK
    Route::group(['prefix' => 'data_kk'], function () {
        Route::get('/', [KKController::class, 'index']);
        Route::post('/list', [KKController::class, 'list']);
        Route::get('/create', [KKController::class, 'create']);
        Route::post('/', [KKController::class, 'store']);
        Route::get('/{id}', [KKController::class, 'show']);
        Route::get('/{id}/edit', [KKController::class, 'edit']);
        Route::put('/{id}', [KKController::class, 'update']);
        Route::delete('/{id}', [KKController::class, 'destroy']);
    });
    Route::get('/detail_anggota', [KKController::class, 'detail']);
    Route::get('/laporan_keuangan', [ketuaController::class, 'keuangan']);
    Route::get('/kerja_bakti', [ketuaController::class, 'kegiatan']);
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::get('/laporanKeuangan', [laporanKeuanganController::class, 'keuangan']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/daftar_inventaris', [InventarisKetuaController::class, 'index']);
    Route::post('/inventaris', [InventarisKetuaController::class, 'store']);
    Route::post('/inventaris/getData', [InventarisKetuaController::class, 'getData']);
    Route::post('/inventaris/edit', [InventarisKetuaController::class, 'update']);
    Route::delete('/inventaris/delete', [InventarisKetuaController::class, 'destroy']);
    Route::post('/daftar_inventaris/list', [InventarisKetuaController::class, 'list']);
    Route::get('/daftar_peminjaman', [daftar_peminjamanController::class, 'index']);
    Route::get('/kelola_pengumuman', [pengumumanKetuaController::class, 'index']);
    Route::post('/pengumuman/list', [pengumumanKetuaController::class, 'list']);
    Route::post('/pengumuman', [pengumumanKetuaController::class, 'store']);
    Route::post('/pengumuman/getData', [pengumumanKetuaController::class, 'getData']);
    Route::post('/pengumuman/edit', [pengumumanKetuaController::class, 'update']);
    Route::delete('/pengumuman/delete', [pengumumanKetuaController::class, 'destroy']);
    Route::get('/akun', [ketuaController::class, 'akun']);
});

Route::group(['prefix' => 'sekretaris'], function () {
    Route::get('/dashboard', [sekretarisController::class, 'index']);
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::get('/data_rumah', [data_rumahController::class, 'index']);
    Route::get('/data_penduduk', [sekretarisController::class, 'dataPenduduk']);
    Route::get('/data_kk', [KKController::class, 'index1']);
    Route::get('/detail_anggota', [KKController::class, 'detail']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/akun', [sekretarisController::class, 'akun']);
});

Route::group(['prefix' => 'bendahara'], function () {
    Route::group(['prefix' => 'pemasukan'], function () { 
        Route::get('/', [pemasukanController::class, 'index']); 
        Route::post('/list', [pemasukanController::class, 'list']);
        // Route::get('/create', [pemasukanController::class, 'create']);
        Route::post('/tambah', [pemasukanController::class, 'store']);
        // Route::get('/{id}', [pemasukanController::class, 'show']);
        Route::post('/edit', [pemasukanController::class, 'edit']);
        Route::post('/update', [pemasukanController::class, 'update']);
        Route::delete('/destroy', [pemasukanController::class, 'destroy']);
    }); 
    Route::get('/pengeluaran', [pengeluaranController::class, 'index']);
    Route::get('/dashboardBendahara', [bendaharaController::class, 'index']);
    Route::get('/keuanganBendahara', [bendaharaController::class, 'keuangan']);
    Route::get('/akunBendahara', [bendaharaController::class, 'akun']);
});

Route::group(['prefix' => 'penduduk'], function () {
    Route::get('/dashboard', [pendudukController::class, 'index']);

    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/laporan_keuangan', [pendudukController::class, 'keuangan']);
    Route::get('/keuangan', [pendudukController::class, 'keuangan']);
    Route::get('/kerja_bakti', [pendudukController::class, 'kegiatan']);
    Route::get('/pengumuman', [pendudukController::class, 'pengumuman']);
    Route::get('/akun', [pendudukController::class, 'akun']);
    Route::post('penduduk/laporan_keuangan/search', 'LaporanKeuanganController@search');

    Route::group(['prefix' => 'laporan_keuangan'], function () {
        Route::post('/search', [pendudukController::class, 'search']);
        Route::post('/list', [pendudukController::class, 'laporan']);
    });

    Route::group(['prefix' => 'daftar_inventaris'], function () {
        Route::get('/', [inventarisController::class, 'index']);
        Route::post('/list', [inventarisController::class, 'list']);
    });
    Route::post('/peminjaman', [inventarisController::class, 'pk_peminjaman']);

});


//halaman tidak ditemukan
Route::fallback(function () {
    return view('404');
});

