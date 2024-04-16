<?php

use App\Http\Controllers\templateController;
use App\Http\Controllers\bendaharaController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\pemasukanController;
use App\Http\Controllers\inventarisController;
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
Route::get('/pemasukan',[pemasukanController::class, 'index']);

//tersting pengeluaran
Route::get('pengeluaran',[pengeluaranController::class, 'index']);

//testing bendahara
Route::get('dashboardBendahara',[bendaharaController::class, 'index']);

//testing inventaris
Route::get('/inventaris',[inventarisController::class, 'index']);