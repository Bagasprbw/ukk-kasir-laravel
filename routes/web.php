<?php

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
    Route::post('/edit-produk/{produk:id}', [ProdukController::class, 'update']);
    Route::get('/hapus-produk/{produk:id}', [ProdukController::class, 'delete']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/tambah-user', [UserController::class, 'tambah']);
    Route::post('/tambah-user', [UserController::class, 'insert']);
    Route::get('/edit-user={user:id}', [UserController::class, 'edit']);
    Route::post('/edit-user/{user:id}', [UserController::class, 'update']);
    Route::get('/hapus-user/{user:id}', [UserController::class, 'delete']);
});
Route::middleware(['auth', 'onlyKasir'])->group(function(){
    //
});
