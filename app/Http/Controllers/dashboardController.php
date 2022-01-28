<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Transaksi;

class dashboardController extends Controller
{
    public function dashboard(){
        $outlet = Outlet::all();
        $paket = Paket::all();
        $member = Member::all();
        $transaksi = Transaksi::where('status', '=', 'proses')->get();

        return view('index', compact('outlet','paket','member','transaksi'));

    }
}
