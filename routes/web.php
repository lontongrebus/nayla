<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\KeranjangController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\AuthController;


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

// Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route::post('/postlogin', [LoginController::class, 'postlogin']);

// Route::group(['middleware' => 'auth'], function (){


Route::get('/', [MainController::class, "index"]);
Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

Route::get('/barang', [BarangController::class, "index"]);
Route::post('/barang', [BarangController::class, "addNewBarang"]);
Route::get('/barang/{id}', [BarangController::class, "destroy"]);
Route::get('/barang/detail/{id}', [BarangController::class, "detail"]);

Route::get('/kategori', [KategoriController::class, "index"]);
Route::post('/kategori', [KategoriController::class, "addNewKategori"]);
Route::get('/kategori/{id}', [KategoriController::class, "destroy"]);

// Route::get('/detailproduct', [DetailController::class, "detailproduct"])->name('detailproduct');
// Route::get('/detailproduct/{id}', [DetailController::class, "show"]);

Route::get('/keranjang', [KeranjangController::class, "keranjang"])->name('keranjang');
Route::get('/keranjang/{id}', [KeranjangController::class, "show"]);
Route::get('/addToKeranjang/{id}', [KeranjangController::class, "addToKeranjang"]);


// Route::get('/addNewDetail', [DetailController::class, "addNewDetail"]);
// Route::get('/hapusdetail/{id}', [DetailController::class, "hapusdetail"]);
