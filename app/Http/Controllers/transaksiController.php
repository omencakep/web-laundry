<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Detail_Transaksi;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\Paket;
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

        $transaksi = DB::table('transaksi')->select('transaksi.id as id_transaksi','transaksi.*','outlet.*','member.*',"paket.*")
                                           ->join('outlet','outlet.id', '=', 'transaksi.id_outlet')
                                           ->join('member','member.id', '=', 'transaksi.id_member')
                                           ->join('paket','paket.id', '=', 'transaksi.id_paket')->paginate(5);
        Paginator::useBootstrap();
        return view('transaksi', compact('transaksi'));
    }
    
    //tampil tambah data transaksi
    public function tambah(){
        $outlet = Outlet::all();
        $member = Member::all();
        $paket = Paket::all();
        return view('transaksi-tambah', compact('outlet','member','paket'));
        
        
    }

    //simpan data
    public function simpan(Request $request){        

        

        //Tabel Transaksi
        $validator = $request->validate([
            'id_outlet' => 'required',
            'id_member' => 'required|string',
            'id_paket' => 'required|string',
            'qty' => 'required|min:1',
            'tgl'=>'required',
            'batas_waktu'=>'required',
            'tgl_bayar'=>'',
            'status'=>'required',
            'dibayar'=>'required',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
                'id_member.required' => 'Nama member tidak boleh kosong!',
                'id_paket.required' => 'Jenis paket tidak boleh kosong!',
                'qty.required' => 'Berat tidak boleh kosong!',
                'qty.min' => 'Berat minimal min:! kg',
                'tgl.required' => 'Tanggal transaksi tidak boleh kosong!',
                'batas_waktu.required' => 'Batas waktu tidak boleh kosong!',
                'status.required' => 'Status tidak boleh kosong!',  
                'dibayar.required' => 'Status bayar tidak boleh kosong!',  
            ]
        );
        
        $transaksi = Transaksi::create([
        'id_outlet'=>$request->get('id_outlet'),
        'id_member'=>$request->get('id_member'),
        'id_paket'=>$request->get('id_paket'),
        'qty'=>$request->get('qty'),
        'tgl'=>$request->get('tgl'),
        'batas_waktu'=>$request->get('batas_waktu'),
        'tgl_bayar'=>$request->get('tgl_bayar'),
        'status'=>$request->get('status'),
        'dibayar'=>$request->get('dibayar'),
        ]);
        
        $id = $request->get('id_paket');
        $paket = Paket::all()->find($id);

        $detail = detail_transaksi::create([
        'id_transaksi' => $transaksi->id,
        'subtotal' => $transaksi->qty * $paket->harga,
        'keterangan' => '',
        ]);
        
         return redirect()->route('tampil-transaksi')->with('message-simpan','Data berhasil disimpan!');
        
    }

        //tampil edit data
        public function edit($id){
        
            $transaksi = DB::table('transaksi')->select('*')->where('id', $id)->first();
            $outlet = DB::table('outlet')->select('id','nama')->get();
            $member = DB::table('member')->select('id','nama_member')->get();
            $paket = DB::table('paket')->select('id','nama_paket')->get();
            return view('transaksi-edit', compact('transaksi','outlet','member','paket'));
    
        }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'id_outlet' => 'required',
            'id_member' => 'required|string',
            'id_paket' => 'required|string',
            'qty' => 'required|min:1',
            'tgl'=>'required',
            'batas_waktu'=>'required',
            'tgl_bayar'=>'',
            'status'=>'required',
            'dibayar'=>'required',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
                'id_member.required' => 'Nama member tidak boleh kosong!',
                'id_paket.required' => 'Jenis paket tidak boleh kosong!',
                'qty.required' => 'Berat tidak boleh kosong!',
                'qty.min' => 'Berat minimal min:! kg',
                'tgl.required' => 'Tanggal transaksi tidak boleh kosong!',
                'batas_waktu.required' => 'Batas waktu tidak boleh kosong!',
                'status.required' => 'Status tidak boleh kosong!',  
                'dibayar.required' => 'Status bayar tidak boleh kosong!',  
            ]
        );
        $transaksi = Transaksi::where('id',$id)->update([
            'id_outlet'=>$request->get('id_outlet'),
            'id_member'=>$request->get('id_member'),
            'id_paket'=>$request->get('id_paket'),
            'qty'=>$request->get('qty'),
            'tgl'=>$request->get('tgl'),
            'batas_waktu'=>$request->get('batas_waktu'),
            'tgl_bayar'=>$request->get('tgl_bayar'),
            'status'=>$request->get('status'),
            'dibayar'=>$request->get('dibayar'),
                ]);

            $id_paket = $request->get('id_paket');
            $paket = Paket::all()->find($id_paket);

            $detail = detail_transaksi::where('id_transaksi',$id)->update([
            'id_transaksi' => $id,
            'subtotal' => $request->get('qty') * $paket->harga,
            'keterangan' => '',
            ]);
        return redirect()->route('tampil-transaksi')->with('message-update','Data berhasil diupdate!');
    }

        //hapus data
        public function hapus($id){
            $detail = Detail_Transaksi::where('id_transaksi',$id)->delete();
            $transaksi = Transaksi::where('id',$id)->delete();
            return redirect()->back()->with('message-hapus','Data berhasil dihapus!');
        }

        public function detailTransaksi($id)
        {
            // return $id;
            
            // $transaksi = DB::table('transaksi')->join('outlet','outlet.id', '=', 'transaksi.id_outlet')
            //                                    ->join('member','member.id', '=', 'transaksi.id_member')
            //                                    ->join('paket','paket.id', '=', 'transaksi.id_paket')->first();
            // $detail = DB::table('detail_transaksi')->where('id_transaksi', $id)->first();

        $transaksi = DB::table('transaksi')->select('*')->where('id', $id)->first();
        $outlet = DB::table('outlet')->where('id', $transaksi->id_outlet)->get();
        $member = DB::table('member')->where('id', $transaksi->id_member)->get();
        $paket  = DB::table('paket')->where('id', $transaksi->id_paket)->get();

        $detail = DB::table('detail_transaksi')->where('id_transaksi', $id)->first();
        return view('detail-transaksi', compact('transaksi','outlet','member','paket','detail',));

        }

}
