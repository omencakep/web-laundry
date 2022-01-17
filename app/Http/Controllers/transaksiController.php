<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class transaksiController extends Controller
{
    //tampil data
    public function tampil(){
        // $data = DB::table('transaksi')->join('outlet','outlet.id', '=', 'transaksi.id_outlet')
        //                            ->join('member','member.id', '=', 'transaksi.id_member')->paginate(5);
        // Paginator::useBootstrap();
        // return view('transaksi',['transaksi' => $data]);

        $transaksi = DB::table('transaksi')->join('outlet','outlet.id', '=', 'transaksi.id_outlet')
                                           ->join('member','member.id', '=', 'transaksi.id_member')->paginate(5);
        Paginator::useBootstrap();
        return view('transaksi', compact('transaksi'));
    }
    
    //tampil tambah data transaksi
    public function tambah(){
        $outlet = Outlet::all();
        $member = Member::all();
        return view('transaksi-tambah', compact('outlet','member'));
        
        
    }
    //simpan data
    public function simpan(Request $request){
        $validator = $request->validate([
            'id_outlet' => 'required',
            'id_member' => 'required|string',
            'nama_paket'=>'required|string',
            'harga'=>'required|string',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
    
                'jenis.required' => 'Jenis paket tidak boleh kosong!',

                'nama_paket.required' => 'Nama paket tidak boleh kosong!',
    
                'harga.required' => 'Harga paket tidak boleh kosong!',
                
            ]
        );
        $paket = Paket::create([
        'id_outlet'=>$request->get('id_outlet'),
        'jenis'=>$request->get('jenis'),
        'nama_paket'=>$request->get('nama_paket'),
        'harga'=>$request->get('harga'),
        ]);
        
        return redirect()->route('tampil-paket')->with('message-simpan','Data berhasil disimpan!');
    }

}
