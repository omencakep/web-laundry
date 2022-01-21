<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Paket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class detailController extends Controller
{
    public function tampil(){


        $detail = DB::table('detail_transaksi')->first();
        Paginator::useBootstrap();
        return view('detail-transaksi', compact('detail'));

        
    }

    //tampil tambah
    public function tambah(){
        $transaksi = Transaksi::all();
        $paket = Paket::all();
        return view('detail-tambah', compact('transaksi','paket'));
    }
}
