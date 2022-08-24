<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [DashboardController::class, 'index'])->name('index');


//Auth Attempt
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/registeruser', [RegisterController::class, 'registeruser'])->name('registeruser');

Route::get('/approval-list', [ApprovalController::class, 'index'])->name('approval-list');
Route::post('/approval-user/{id}', [ApprovalController::class, 'approve'])->name('approval-user');
Route::post('/not-approve-use/{id}r', [ApprovalController::class, 'notApprove'])->name('not-approve-user');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Buku
Route::get('/buku', [BooksController::class, 'buku'])->name('buku');
Route::get('/buku/search', [PeminjamanController::class, 'pinjam'])->name('search');
Route::get('/tambahbuku', [BooksController::class, 'tambahbuku'])->name('tambahbuku');
Route::post('/insertbuku', [BooksController::class, 'insertbuku'])->name('insertbuku');
Route::get('/tampilkanbuku/{id}', [BooksController::class, 'tampilkanbuku'])->name('tampilkanbuku');
Route::post('/updatebuku/{id}', [BooksController::class, 'updatebuku'])->name('updatebuku');
Route::get('/deletebuku/{id}', [BooksController::class, 'deletebuku'])->name('deletebuku');

//Kategori
Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
Route::post('/tambahkategori', [KategoriController::class, 'tambahkategori'])->name('tambahkategori');
Route::post('/editkategori', [KategoriController::class, 'editkategori'])->name('editkategori');
Route::get('/hapuskategori/{id}', [KategoriController::class, 'hapuskategori'])->name('hapuskategori');

//Denda
Route::get('/denda', [DendaController::class, 'index'])->name('denda');
Route::post('/tambahdenda', [DendaController::class, 'tambahdenda'])->name('tambahdenda');
Route::post('/editdenda', [DendaController::class, 'editdenda'])->name('editdenda');
Route::get('/hapusdenda/{id}', [DendaController::class, 'hapusdenda'])->name('hapusdenda');

//Rak
Route::get('/rak', [RakController::class, 'rak'])->name('rak');
Route::post('/tambahrak', [RakController::class, 'tambahrak'])->name('tambahrak');
Route::post('/editrak', [RakController::class, 'editrak'])->name('editrak');
Route::get('/hapusrak/{id}', [RakController::class, 'hapusrak'])->name('hapusrak');

//Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'cekpeminjaman'])->name('cekpeminjaman');
Route::post('/tambahpeminjaman', [PeminjamanController::class, 'tambahpeminjaman'])->name('tambahpeminjaman');
Route::post('/editpeminjaman', [PeminjamanController::class, 'editpeminjaman'])->name('editpeminjaman');
Route::get('/hapuspeminjaman/{id}', [PeminjamanController::class, 'hapuspeminjaman'])->name('hapuspeminjaman');

Route::get('/approval-peminjaman-list', [ApprovalController::class, 'approvalPeminjamanList'])->name('approval-peminjaman-list');
Route::post('/approval-peminjaman', [ApprovalController::class, 'approvePeminjaman'])->name('approve-peminjaman');
Route::post('/not-approve-peminjaman', [ApprovalController::class, 'notApprovePeminjaman'])->name('not-approve-peminjaman');


//Exportpdf
Route::post('/peminjaman/pdf', [PeminjamanController::class, 'exportpdf'])->name('peminjaman.pdf');
Route::post('/datadenda/pdf', [PeminjamanController::class, 'datadendapdf'])->name('datadenda.pdf');


//User Pinjam
Route::get('/pinjam', [PeminjamanController::class, 'pinjam'])->name('pinjam');
// Route::get('/pinjam/{id}', [PeminjamanController::class, 'cekpinjam'])->name('cekpinjam');
// Route::post('/tambahpinjam', [PeminjamanController::class, 'tambahpinjam'])->name('tambahpinjam');
// Route::post('/editpinjam', [PeminjamanController::class, 'editpinjam'])->name('editpinjam');
Route::get('/pinjam/list', [PeminjamanController::class, 'pinjamlist'])->name('pinjamlist');

//List User
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/tambahuser', [UserController::class, 'tambahuser'])->name('tambahuser');
Route::post('/edituser', [UserController::class, 'edituser'])->name('edituser');
Route::get('/hapususer/{id}', [UserController::class, 'hapususer'])->name('hapususer');
Route::get('/cetakuser/{id}', [UserController::class, 'cetakuser'])->name('cetakuser');

//List Pengunjung
Route::get('/pengunjung', [PengunjungController::class, 'index'])->name('pengunjung');
Route::post('/tambahpengunjung', [PengunjungController::class, 'tambahpengunjung'])->name('tambahpengunjung');
Route::post('/editpengunjung', [PengunjungController::class, 'editpengunjung'])->name('editpengunjung');
Route::get('/hapuspengunjung/{id}', [PengunjungController::class, 'hapuspengunjung'])->name('hapuspengunjung');
