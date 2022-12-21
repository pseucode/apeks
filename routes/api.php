<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PengaduanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pengaduan/admin', [PengaduanController::class, 'indexAdmin']);
Route::get('pengaduan/teknisi', [PengaduanController::class, 'indexTeknisi']);
Route::post('pengaduan/tambah', [PengaduanController::class, 'tambah']);
Route::put('Pengaduan/forward/{id}', [PengaduanController::class, 'forward']);
Route::delete('pengaduan/hapus/{id}', [PengaduanController::class, 'hapus']);