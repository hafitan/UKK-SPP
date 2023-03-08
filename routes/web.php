<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
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
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('pembayaran/history', [PembayaranController::class, 'history'])->name('pembayaran.history');
    Route::middleware(['admin'])->group(function () {
        Route::resource('spp', SppController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('petugas', PetugasController::class);
        Route::resource('siswa', SiswaController::class);
    });
    Route::get('pembayaran/getData/{id_siswa}/{berapa}', [PembayaranController::class, 'getData'])->middleware('twice');
    Route::resource('pembayaran', PembayaranController::class)->middleware('twice');
    // // Route::get('export/pembayaran', [PembayaranController::class, 'export_excel'])->middleware('twice');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
