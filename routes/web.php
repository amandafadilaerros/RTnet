<?php

use App\Http\Controllers\bendaharaController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pemasukanController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\templateController;
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
    return view('welcome');
});

// Login
Route::get('/login', function () {
    return view('login');
});
Route::post('/dashboard', [loginController::class, 'test']);

// hanya untuk testing template
Route::get('/templates', [templateController::class, 'index']);

//testing bendahara
Route::get('/pemasukan', [pemasukanController::class, 'index']);
Route::get('/pengeluaran', [pengeluaranController::class, 'index']);
Route::get('/dashboardBendahara', [bendaharaController::class, 'index']);
Route::get('/keuanganBendahara', [bendaharaController::class, 'keuangan']);
Route::get('/akunBendahara', [bendaharaController::class, 'akun']);


//Data keluarga
Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
Route::get('/Dashboard', [DashboardController::class, 'index']);