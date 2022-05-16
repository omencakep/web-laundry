<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class memberController extends Controller
{
    //tampil data member
    public function tampil(){
        return Member::all();
        // $data = DB::table('member')->paginate(5);
        // Paginator::useBootstrap();
        // return view('member',['member' => $data]);
    }


    //simpan data
    public function simpan(Request $request){
        $this->validate($request,[
            'nama_member' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_kelamin'=>'required',
            'telp'=>'required|string|max:15',
            ],
            [
                'nama_member.required' => 'Nama member tidak boleh kosong!',
                'nama_member.max' => 'Nama melebihi batas!',
    
                'alamat.required' => 'Alamat member tidak boleh kosong!',

                'jenis_kelamin.required' => 'Jenis kelamin member tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon member tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
            ]
        );
        $member = Member::create([
        'nama_member'=>$request->get('nama_member'),
        'alamat'=>$request->get('alamat'),
        'jenis_kelamin'=>$request->get('jenis_kelamin'),
        'telp'=>$request->get('telp'),
        ]);
        
    }

     //tampil edit data
     public function edit($id){
        $member = DB::table('member')->where('id',$id)->first();
        return view('member-edit',['member' => $member]);
    }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'nama_member' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_kelamin'=>'required',
            'telp'=>'required|string|max:15',
            ],
            [
                'nama_member.required' => 'Nama member tidak boleh kosong!',
                'nama_member.max' => 'Nama melebihi batas!',
    
                'alamat.required' => 'Alamat member tidak boleh kosong!',

                'jenis_kelamin.required' => 'Jenis kelamin member tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon member tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
            ]
        );
        $member = Member::where('id',$id)->update([
                	'nama_member'=>$request->get('nama_member'),
                	'alamat'=>$request->get('alamat'),
                    'jenis_kelamin'=>$request->get('jenis_kelamin'),
                	'telp'=>$request->get('telp'),
                ]);
        return redirect()->route('tampil-member')->with('message-update','Data berhasil diupdate!');
    }

    //hapus data
    public function hapus($id){
        $member = Member::where('id',$id)->delete();
        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');;
    }

}
