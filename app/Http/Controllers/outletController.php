<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class outletController extends Controller
{

    //tampil data
    public function tampil(){
        return Outlet::all();
        // $data = DB::table('outlet')->paginate(5);
        // Paginator::useBootstrap();
        // return view('outlet', ['outlet' => $data]);
        
    }

    //simpan data
    public function simpan(Request $request){

        $this->validate($request,[
        'nama' => 'required|string|max:30',
        'alamat' => 'required|string',
        'telp'=>'required|string|max:15',
        ],
        [
            'nama.required' => 'Nama outlet tidak boleh kosong!',
            'nama.max' => 'Nama melebihi batas!',

            'alamat.required' => 'Alamat outlet tidak boleh kosong!',

            'telp.required' => 'Nomor telepon outlet tidak boleh kosong!',
            'telp.max' => 'Panjang nomor telepon melebihi batas!',
        ]
    );
        $outlet = Outlet::create([
        'nama'=>$request->get('nama'),
        'alamat'=>$request->get('alamat'),
        'telp'=>$request->get('telp'),
        ]);
    }

    //tampil edit data
    public function edit($id){
        $outlet = DB::table('outlet')->where('id',$id)->first();
        return view('outlet-edit',['outlet' => $outlet]);
    }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telp'=>'required|string|max:15',
            ],
            [
                'nama.required' => 'Nama outlet tidak boleh kosong!',
                'nama.max' => 'Nama melebihi batas!',
    
                'alamat.required' => 'Alamat outlet tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon outlet tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
            ]
        );
        $outlet = Outlet::where('id',$id)->update([
                	'nama'=>$request->get('nama'),
                	'alamat'=>$request->get('alamat'),
                	'telp'=>$request->get('telp'),
                ]);
        return redirect()->route('tampil-outlet')->with('message-update','Data berhasil diupdate!');
    }

    //hapus data
    public function hapus($id){
        $outlet = Outlet::where('id',$id)->delete();

        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');;
    }




    // public function store(Request $request)
    // {
    // 	$validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|max:255',
    //         'alamat' => 'required|string|max:255',
    //         'telp'=>'required|string',
    //     ]);
    //     if($validator->fails()){
    //         return response()->json($validator->errors()->toJson(), 400);
    //     }        
    //     $outlet = Outlet::create([
    //     	'nama'=>$request->get('nama'),
    //     	'alamat'=>$request->get('alamat'),
    //     	'telp'=>$request->get('telp'),
    //     ]);
    //     if($outlet){
    //     	return response()->json(['status'=>true]);
    //     } else {
    //     	return response()->json(['status'=>false]);
    //     }
    // }
    // public function update(Request $request, $id)
    // {
    // 	$validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|max:255',
    //         'alamat' => 'required|string|max:255',
    //         'telp'=>'required|string',
    //     ]);
    //     if($validator->fails()){
    //         return response()->json($validator->errors()->toJson(), 400);
    //     }        
    //     $outlet = Outlet::where('id',$id)->update([
    //     	'nama'=>$request->get('nama'),
    //     	'alamat'=>$request->get('alamat'),
    //     	'telp'=>$request->get('telp'),
    //     ]);
    //     if($outlet){
    //     	return response()->json(['status'=>true]);
    //     } else {
    //     	return response()->json(['status'=>false]);
    //     }
    // }
    // public function delete($id)
    // {
    // 	$outlet = Outlet::where('id',$id)->delete();
    //     if($outlet){
    //     	return response()->json(['status'=>true]);
    //     } else {
    //     	return response()->json(['status'=>false]);
    //     }
    // }
}
