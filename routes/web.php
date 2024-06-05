<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TigaAduaController;
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
    Route::get('/dashboard', function (){
        return view('welcome')
        ->with('content', 'dashboard');})->name('dashboard');
    
  
Route::get('/', [TigaAduaController::class, "index2"]);

Route::get('/barang', [BarangController::class, "barang"]);
Route::get('/addNewBarang', [BarangController::class, "addNewBarang"]);
Route::post('/barang', [BarangController::class, "addbarang"]);
Route::get('/hapusbarang/{id}', [BarangController::class, "hapusbarang"]);

Route::get('/kategori', [KategoriController::class, "kategori"]);
Route::get('/addNewKategori', [KategoriController::class, "addNewKategori"]);
Route::post('/kategori', [KategoriController::class, "kategori"]);
Route::get('/hapuskategori/{id}', [KategoriController::class, "hapuskategori"]);

Route::get('/detailproduct', [DetailController::class, "detailproduct"])->name('detailproduct');
Route::get('/detailproduct/{id}', [DetailController::class, "show"]);

Route::get('/keranjang', [KeranjangController::class, "keranjang"])->name('keranjang');
Route::get('/keranjang/{id}', [KeranjangController::class, "show"]);
Route::get('/addToKeranjang/{id}', [KeranjangController::class, "addToKeranjang"]);


Route::get('/addNewDetail', [DetailController::class, "addNewDetail"]);
Route::get('/hapusdetail/{id}', [DetailController::class, "hapusdetail"]);










































Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/perkalian', [TigaAduaController::class, "perkalian"]);
Route::get('/penjumlahan', [TigaAduaController::class, "perkalian"]);
Route::get('/pmb', [TigaAduaController::class, "pmb"]);
Route::get('/datapmb', [TigaAduaController::class, "datapmb"]);
Route::post('/kali', [TigaAduaController::class, "perkalian2"]);
Route::post('/jumlah', [TigaAduaController::class, "penjumlahan2"]);
Route::post('/pmb', [TigaAduaController::class, "pmb2"]);
Route::post('/store', [TigaAduaController::class, "store"]);
Route::get('/berita/{idberita}', [TigaAduaController::class, "berita"]);



Route::get('/mhsbaru', [TigaAduaController::class, "mhsbaru"]);
Route::post('/mhsbaru', [TigaAduaController::class, "mhsbaru"]);
Route::get('/editmhs/{id}', [TigaAduaController::class, "editmhs"]);
Route::get('/hapusmhs/{id}', [TigaAduaController::class, "hapusmhs"]);



Route::get('/dsn', [TigaAduaController::class, "dsn"]);
Route::post('/dsn', [TigaAduaController::class, "dsn"]);
Route::get('/editdsn/{id}', [TigaAduaController::class, "editdsn"]);
Route::get('/hapusdsn/{id}', [TigaAduaController::class, "hapusdsn"]);





Route::get('/fakultas', [TigaAduaController::class, "fakultas"]);
Route::get('/addNewFakultas', [TigaAduaController::class, "addNewFakultas"]);
Route::post('/fakultas', [TigaAduaController::class, "fakultas"]);
Route::get('/hapusfakultas/{id}', [TigaAduaController::class, "hapusfakultas"]);



Route::get('/prodi', [TigaAduaController::class, "prodi"]);
Route::get('/addNewProdi', [TigaAduaController::class, "addNewProdi"]);
Route::post('/prodi', [TigaAduaController::class, "prodi"]);
Route::get('/hapusprodi/{id}', [TigaAduaController::class, "hapusprodi"]);


Route::get('/matkul', [TigaAduaController::class, "matkul"]);
Route::get('/addNewMatkul', [TigaAduaController::class, "addNewMatkul"]);
Route::post('/matkul', [TigaAduaController::class, "matkul"]);
Route::get('/editmatkul/{id}', [TigaAduaController::class, "editmatkul"]);
Route::get('/hapusmatkul/{id}', [TigaAduaController::class, "hapusmatkul"]);


Route::get('/hari', [TigaAduaController::class, "hari"]);
Route::post('/hari', [TigaAduaController::class, "hari"]);

Route::get('/jenjang', [TigaAduaController::class, "jenjang"]);
Route::post('/jenjang', [TigaAduaController::class, "jenjang"]);

Route::get('/kelas', [TigaAduaController::class, "kelas"]);
Route::post('/kelas', [TigaAduaController::class, "kelas"]);

Route::get('/ruang', [TigaAduaController::class, "ruang"]);
Route::post('/ruang', [TigaAduaController::class, "ruang"]);


Route::get('/transaksi', [TigaAduaController::class, "transaksi"]);
Route::post('/transaksi', [TigaAduaController::class, "transaksi"]);
Route::get('/edittransaksi/{id}', [TigaAduaController::class, "edittransaksi"]);
Route::get('/hapustransaksi/{id}', [TigaAduaController::class, "hapustransaksi"]);

Route::get('/jadwal', [TigaAduaController::class, "jadwal"]);
Route::post('/jadwal', [TigaAduaController::class, "jadwal"]);
Route::get('/editjadwal/{id}', [TigaAduaController::class, "editjadwal"]);
Route::get('/hapusjadwal/{id}', [TigaAduaController::class, "hapusjadwal"]);



Route::get('/thnakademik', [TigaAduaController::class, "thnakademik"]);
Route::post('/thnakademik', [TigaAduaController::class, "thnakademik"]);
Route::get('/editthnakademik/{id}', [TigaAduaController::class, "editthnakademik"]);
Route::get('/hapusthnakademik/{id}', [TigaAduaController::class, "hapusthnakademik"]);


Route::get('/edituser/{id}', [TigaAduaController::class, "edituser"]);
Route::get('/hapususer/{id}', [TigaAduaController::class, "hapususer"]);

Route::get('/register', [TigaAduaController::class, "register"]);
Route::post('/register', [TigaAduaController::class, "register"]);

// });  

// Route::get('/editprodi/{id}', [TigaAduaController::class, "editprodi"]);

// Route::post('/mahasiswa', [TigaAduaController::class, "mahasiswa"]);
// Route::get('/editdosen/{id}', [TigaAduaController::class, "editdosen"]);
// Route::get('/hapusdosen/{id}', [TigaAduaController::class, "hapusdosen"]);
// Route::post('/dosen', [TigaAduaController::class, "dosen2"]);
// Route::get('/', [TigaAduaController::class, "index"]);

// Route::get('bladeTest',[HomeController::class, "index"]);
// Route::get("welcomemantap", [HomeController::class, "indexadmin"]);
// Route::post('/hapusmhs', [TigaAduaController::class, "hapusmhs"]);
// Route::get('/datadosen', [TigaAduaController::class, "datadosen"]);

// Route::get('/', function () {
    //     return view('/welcome');
    // }
// );
// Route::resource('dosen', TigaAduaController::class);
// Route::get('/', [HomeController::class, 'index3']);
// Route::get('/login', [AuthController::class, 'login2']);
// Route::get('/register', [HomeController::class, 'register']);
// Route::post('/register', [AuthController::class, 'registerStore'])->name('registerPost');

// Route::group(['middleware' => 'prevent-back-history'], function()
// {
    //     Route::get('/', function () {
//         return view('Auth.login');
//     });
//     Route::get('/login', function () {
    //         return view('Auth.login');
//     })->name('login');
//     Route::get('/logout','AuthController@logout')->name('logout');
//     Route::post('/postlogin','AuthController@PostLogin')->name('postlogin');  
// });

// Route::get('/editfakultas/{id}', [TigaAduaController::class, "editfakultas"]);

