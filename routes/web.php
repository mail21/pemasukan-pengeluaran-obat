<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [LaporanController::class, 'index']);

    Route::post('/obat/add', [ObatController::class, 'store']);
    Route::post('/obat/edit', [ObatController::class, 'edit']);
    Route::post('/obat/hapus', [ObatController::class, 'hapus']);
    Route::get('/obat', [ObatController::class, 'index']);

    Route::post('/users/add', [UserController::class, 'store']);
    Route::post('/users/edit', [UserController::class, 'edit']);
    Route::post('/users/hapus', [UserController::class, 'hapus']);
    Route::get('/users', [UserController::class, 'index']);

    Route::post('/transaksi/add', [TransaksiController::class, 'store']);
    Route::post('/transaksi/edit', [TransaksiController::class, 'edit']);
    Route::post('/transaksi/hapus', [TransaksiController::class, 'hapus']);
    Route::get('/transaksi', [TransaksiController::class, 'index']);


    Route::get('/laporan-pemasukan', [LaporanController::class, 'index_pemasukan']);
    Route::get('/laporan-pengeluaran', [LaporanController::class, 'index_pengeluaran']);

});
