<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\outletController;
use App\Http\Controllers\paketController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\transaksiController;


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



//login
Route::get('/',[loginController::class,'halamanlogin'])->name('halaman-login');
Route::post('/',[loginController::class,'login'])->name('login');


Route::middleware(['auth','RoleMiddleware:admin'])->group (function() {

// dashboard
Route::get('/dashboard', function () {
    return view('index');
});    

//outlet
Route::get('/outlet',[outletController::class,'tampil'])->name('tampil-outlet');
Route::get('/outlet/tambah',[outletController::class,'tambah'])->name('tambah-outlet');
Route::post('/outlet/simpan',[outletController::class,'simpan'])->name('simpan-outlet');
Route::get('/outlet/edit/{id}',[outletController::class,'edit'])->name('edit-outlet');
Route::put('/outlet/edit/{id}',[outletController::class,'update'])->name('update-outlet');
Route::delete('/outlet/hapus/{id}',[outletController::class,'hapus'])->name('hapus-outlet');

//paket
Route::get('/paket',[paketController::class,'tampil'])->name('tampil-paket');
Route::get('/paket/tambah',[paketController::class,'tambah'])->name('tambah-paket');
Route::post('/paket/simpan',[paketController::class,'simpan'])->name('simpan-paket');
Route::get('/paket/edit/{id}',[paketController::class,'edit'])->name('edit-paket');
Route::put('/paket/edit/{id}',[paketController::class,'update'])->name('update-paket');
Route::delete('/paket/hapus/{id}',[paketController::class,'hapus'])->name('hapus-paket');

//member
Route::get('/member',[memberController::class,'tampil'])->name('tampil-member');
Route::get('/member/tambah',[memberController::class,'tambah'])->name('tambah-member');
Route::post('/member/simpan',[memberController::class,'simpan'])->name('simpan-member');
Route::get('/member/edit/{id}',[memberController::class,'edit'])->name('edit-member');
Route::put('/member/edit/{id}',[memberController::class,'update'])->name('update-member');
Route::delete('/member/hapus/{id}',[memberController::class,'hapus'])->name('hapus-member');

//transaksi
Route::get('/transaksi',[transaksiController::class,'tampil'])->name('tampil-transaksi');
Route::get('/transaksi/tambah',[transaksiController::class,'tambah'])->name('tambah-transaksi');
Route::get('/transaksi/simpan',[transaksiController::class,'simpan'])->name('simpan-transaksi');

//detail transaksi
Route::get('/detail-transaksi',[detailController::class,'tampil'])->name('tampil-detail');


//logout
Route::get('/logout',[loginController::class,'logout'])->name('logout');
});