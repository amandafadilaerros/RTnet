<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\pemasukanController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\templateController;
use App\Http\Controllers\peminjamanController;
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

//testing pemasukan
Route::get('/pemasukan', [pemasukanController::class, 'index']);
Route::get('/pengeluaran', [pengeluaranController::class, 'index']);

//peminjaman
Route::get('/peminjaman', [peminjamanController::class, 'index']);


//Data keluarga
Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
Route::get('/Dashboard', [DashboardController::class, 'index']);