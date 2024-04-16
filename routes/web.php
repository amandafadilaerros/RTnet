<?php

use App\Http\Controllers\pemasukanController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\DashboardController;
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

// hanya untuk testing template
Route::get('/templates', [templateController::class, 'index']);

//testing pemasukan
Route::get('/pemasukan', [pemasukanController::class, 'index']);


//Data keluarga
Route::get('/DaftarAnggota', [DaftarAnggotaController::class, 'index']);
Route::get('/Dashboard', [DashboardController::class, 'index']);