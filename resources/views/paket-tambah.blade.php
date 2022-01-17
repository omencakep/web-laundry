@extends('layouts.master')
@section('link')
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li class="active"><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-detail')}}"><i class="fas fa-receipt"></i> <span>Detail Transaksi</span></a></li>
@stop
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Tambah Data Paket</h4>
                        </div>
                        <form action="{{route ('simpan-paket')}}" method="POST">
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
                            <label>Jenis :</label>
                            <br>
                            <select class="form-control col-md-2" name="jenis">
                            <option value="" selected>--Pilih--</option>
                            <option value="kiloan">Kiloan</option>
                            <option value="selimut">Selimut</option>
                            <option value="bed_cover">Bed cover</option>
                            <option value="kaos">Kaos</option>
                            <option value="lain">Lain</option>
                            </select> 
                            <label 
                            @error('jenis') 
                            class="text-danger"
                            @enderror>
                            @error('jenis')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <div class="form-group">
                            <label>Nama Paket :</label>
                            <input type="text" class="form-control" name="nama_paket">
                            <label 
                            @error('nama_paket') 
                            class="text-danger"
                            @enderror>
                            @error('nama_paket')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <div class="form-group">
                            <label>Harga :</label>
                            <input type="number" class="form-control" name="harga">
                            <label 
                            @error('harga') 
                            class="text-danger"
                            @enderror>
                            @error('harga')
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