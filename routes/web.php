<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function(){
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
    Route::get('/register', [SesiController::class, 'register']);
    Route::post('/register', [SesiController::class, 'store']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [SesiController::class, 'logout']);
    Route::get('/home', function (){
        return view('/home');
    });

    Route::get('/produk', [ProdukController::class, 'index']);
});
Route::middleware(['auth', 'onlyAdmin'])->group(function(){
    Route::post('/tambah-produk', [ProdukController::class, 'insert']);
    Route::get('/edit-produk={produk:id}', [ProdukController::class, 'edit']);
    Route::put('/edit-produk/{produk:id}', [ProdukController::class, 'update']);
    Route::get('/hapus-produk/{produk:id}', [ProdukController::class, 'delete']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/tambah-user', [UserController::class, 'tambah']);
    Route::post('/tambah-user', [UserController::class, 'insert']);
    Route::get('/edit-user={user:id}', [UserController::class, 'edit']);
    Route::put('/edit-user/{user:id}', [UserController::class, 'update']);
    Route::get('/hapus-user/{user:id}', [UserController::class, 'delete']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/cari', [LaporanController::class, 'search']);
    Route::get('/detail={penjualan:kode_penjualan}', [LaporanController::class, 'show']);
});
Route::middleware(['auth', 'onlyKasir'])->group(function(){
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/tambah-pelanggan', [PelangganController::class, 'tambah']);
    Route::post('/tambah-pelanggan', [PelangganController::class, 'insert']);
    Route::get('/edit-pelanggan={pelanggan:id}', [PelangganController::class, 'edit']);
    Route::put('/edit-pelanggan/{pelanggan:id}', [PelangganController::class, 'update']);
    Route::get('/hapus-pelanggan/{pelanggan:id}', [PelangganController::class, 'delete']);

    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::post('/pilih-pelanggan', [PenjualanController::class, 'mulai']);
    Route::get('proses-penjualan={kode_penjualan}', [PenjualanController::class, 'proses'])->name('proses.penjualan');
    Route::post('/pilih-produk', [PenjualanController::class, 'store']);
    Route::get('/hapus-produk={detailPenjualan:id}', [PenjualanController::class, 'delete']);
    Route::post('/bayar/{penjualan:kode_penjualan}', [PenjualanController::class, 'bayar']);
    Route::get('/nota-penjualan/{penjualan:kode_penjualan}', [PenjualanController::class, 'nota']);

    Route::get('/hapus-penjualan/{penjualan:kode_penjualan}', [PenjualanController::class, 'deletePenjualan']);
});
