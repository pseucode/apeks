<?php

use App\Http\Middleware\CheckLevel;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('luar.index');
});
Route::post('/pengaduan/tambah', [App\Http\Controllers\PengaduanController::class, 'tambah'])->name('pengaduan.tambah');


Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [App\Http\Controllers\PengaduanController::class, 'dashboard'])->name('dashboard');

    Route::get('/pengaduan/masuk', [App\Http\Controllers\PengaduanController::class, 'masuk'])->name('pengaduan.masuk');
    Route::post('/pengaduan/forward/{id}', [App\Http\Controllers\PengaduanController::class, 'forward']);

    Route::get('/pengaduan/progres', [App\Http\Controllers\FollowupController::class, 'progres'])->name('pengaduan.progres');
    Route::post('/pengaduan/progres/update/{id}', [App\Http\Controllers\FollowupController::class, 'progresUpdate']);
    Route::post('/pengaduan/masuk/update/{id}', [App\Http\Controllers\FollowupController::class, 'masukUpdate']);
    Route::post('/pengaduan/signature/{id}', [App\Http\Controllers\FollowupController::class, 'uploadSignature'])->name('simpan.ttd');
    Route::get('/pengaduan/selesai/{id}', [App\Http\Controllers\FollowupController::class, 'detailSelesai']);
    Route::get('/pengaduan/detail/{id}', [App\Http\Controllers\PengaduanController::class, 'detail']);

    Route::get('/pengaduan/selesai', [App\Http\Controllers\PengaduanController::class, 'selesai'])->name('pengaduan.selesai');
    Route::post('/pengaduan/konfirmasi/{id}', [App\Http\Controllers\PengaduanController::class, 'konfirmasiSelesai']);

    Route::get('/pengaduan/hapus/{id}', [App\Http\Controllers\PengaduanController::class, 'hapus']);
    Route::post('/user/change-password/{id}', [App\Http\Controllers\UserController::class,'changePassword'])->name('update-password');

    Route::group(['middleware' => 'checkLevel'], function(){
        Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
        Route::get('/kinerja', [App\Http\Controllers\KinerjaController::class, 'index'])->name('kinerja');
        Route::get('/kinerja/detail/{id}', [App\Http\Controllers\KinerjaController::class, 'detail']);
        Route::post('/user/tambah', [App\Http\Controllers\UserController::class, 'tambah']);
        Route::get('/user/hapus/{id}', [App\Http\Controllers\UserController::class, 'hapus']);
        Route::get('/user/reset/{id}', [App\Http\Controllers\UserController::class, 'reset']);
        Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'showLaporan'])->name('laporan');
        Route::post('/laporan/pdf', [App\Http\Controllers\LaporanController::class, 'cetakLaporanPDF'])->name('laporanPDF');
    });
    
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
