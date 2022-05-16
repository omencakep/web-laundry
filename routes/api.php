<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\outletController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\paketController;
use App\Http\Controllers\authController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//outlet
Route::get('getdataoutlet',[outletController::class,'tampil']);
Route::post('simpanoutlet',[outletController::class,'simpan']);

//member
Route::get('getdatamember',[memberController::class,'tampil']);
Route::post('simpanmember',[memberController::class,'simpan']);

//paket
Route::get('getdatapaket',[paketController::class,'tampil']);
Route::post('simpanpaket',[paketController::class,'simpan']);

//pengurus
Route::get('getdatapengurus',[authController::class,'tampil']);
Route::post('simpanpengurus',[authController::class,'simpan']);
