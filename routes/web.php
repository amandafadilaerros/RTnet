<?php

use App\Http\Controllers\kerjabaktiController;
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
use App\Http\Controllers\pengumumanController;
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
Route::get('/kerjabakti', [kerjabaktiController::class, 'index']);




Route::group(['prefix' => 'ketuaRt'], function () {
    Route::get('/dashboard', [ketuaController::class, 'index']);
    Route::get('/data_rumah', [data_rumahController::class, 'index']);
    Route::get('/data_penduduk', [ketuaController::class, 'dataPenduduk']);
    Route::get('/data_kk', [KKController::class, 'index']);
    Route::get('/detail_anggota', [KKController::class, 'detail']);
    Route::get('/laporan_keuangan', [ketuaController::class, 'keuangan']);
    Route::get('/kerja_bakti', [ketuaController::class, 'kegiatan']);
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/daftar_inventaris', [inventarisController::class, 'index']);
    Route::get('/daftar_peminjaman', [daftar_peminjamanController::class, 'index']);
    Route::get('/kelola_pengumuman', [pengumumanController::class, 'index']);
    Route::get('/akun', [ketuaController::class, 'akun']);
});

Route::group(['prefix' => 'sekretaris'], function () {
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/akun', [ketuaController::class, 'akun']);
});

Route::group(['prefix' => 'bendahara'], function () {
    Route::get('/pemasukan', [pemasukanController::class, 'index']);
    Route::get('/pengeluaran', [pengeluaranController::class, 'index']);
    Route::get('/dashboardBendahara', [bendaharaController::class, 'index']);
    Route::get('/keuanganBendahara', [bendaharaController::class, 'keuangan']);
    Route::get('/akunBendahara', [bendaharaController::class, 'akun']);
});

Route::group(['prefix' => 'penduduk'], function () {
    Route::get('/dashboard', [pendudukController::class, 'index']);
    Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::get('/inventaris', [inventarisController::class, 'index']);
    Route::get('/keuangan', [pendudukController::class, 'keuangan']);
    Route::get('/kerja_bakti', [pendudukController::class, 'kegiatan']);
    Route::get('/pengumuman', [pendudukController::class, 'pengumuman']);
    Route::get('/akun', [pendudukController::class, 'akun']);
});

//halaman tidak ditemukan
Route::fallback(function () {
    return view('404');
});

