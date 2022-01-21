@extends('layouts.master')
@section('link')
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-detail')}}"><i class="fas fa-receipt"></i> <span>Detail Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif
@stop
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Tambah Data Transaksi</h4>
                        </div>
                        <form action="{{route ('simpan-transaksi')}}" method="POST">
                          @csrf
                        <div class="card-body">
                          
                            
                          <div class="form-group">
                            <label>Pilih Outlet :</label>
                            <br>
                            <select class="form-control col-md-2" name="id_outlet">
                            <option value="" selected>--Pilih--</option>  
                            @foreach ($outlet as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>            
                            @endforeach
                            </select>  
                            <label 
                            @error('id_outlet') 
                            class="text-danger"
                            @enderror>
                            @error('id_outlet')
                            {{$message}}
                            @enderror
                          </label>
                          
                        </div>
                      
                        
                          <div class="form-group">
                            <label>Pilih Member :</label>
                            <br>
                            <select class="form-control col-md-2" name="id_member">
                            <option value="" selected>--Pilih--</option>  
                            @foreach ($member as $data_member)
                            <option value="{{$data_member->id}}">{{$data_member->nama_member}}</option>            
                            @endforeach
                            </select>  
                            <label 
                            @error('id_member') 
                            class="text-danger"
                            @enderror>
                            @error('id_member')
                            {{$message}}
                            @enderror
                          </label>
                        </div>
                      
                    

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Transaksi :</label>
                            <input type="date" value="{{old('tgl')}}" class="form-control col-md-6" name="tgl">
                            <label 
                            @error('tgl') 
                            class="text-danger"
                            @enderror>
                            @error('tgl')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Batas Waktu :</label>
                            <input type="date" value="{{old('batas_waktu')}}" class="form-control col-md-6" name="batas_waktu">
                            <label 
                            @error('batas_waktu') 
                            class="text-danger"
                            @enderror>
                            @error('batas_waktu')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>
                          
                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Bayar :</label>
                            <input type="date" value="{{old('tgl_bayar')}}"class="form-control col-md-6" name="tgl_bayar">
                            <label 
                            @error('tgl_bayar') 
                            class="text-danger"
                            @enderror>
                            @error('tgl_bayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>
                        </div>

                          <div class="form-group">
                            <label>Status :</label>
                            <br>
                            <select class="form-control col-md-2" name="status">
                            <option value="" selected>--Pilih--</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Diambil</option>
                            </select> 
                            <label 
                            @error('status') 
                            class="text-danger"
                            @enderror>
                            @error('status')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <div class="form-group">
                            <label>Status Bayar :</label>
                            <br>
                            <select class="form-control col-md-2" name="dibayar">
                            <option value="" selected>--Pilih--</option>
                            <option value="dibayar">Dibayar</option>
                            <option value="belum_dibayar">Belum dibayar</option>
                            </select> 
                            <label 
                            @error('dibayar') 
                            class="text-danger"
                            @enderror>
                            @error('dibayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <button class="btn btn-primary" type="submit">Tambah</button>
                          <button class="btn btn-secondary" type="reset">Reset</button>
                        
                  </div>
                        </form>
            </div>
         </div>

    </div>
@stop



@push('scripts')

@endpush