@extends('layouts.master')
@section('link')
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin")  
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li class="active"><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif
@stop
@section('content')
    <div class="section-body">
      <div class="section-header">
        <h1>Data Paket</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{route('tampil-paket')}}">Paket</a></div>
          <div class="breadcrumb-item">Edit Paket</div>
        </div>
      </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Edit Data Paket</h4>
                        </div>
                        <form action="{{ route('update-paket',$paket->id)}}" method="POST">
                          @csrf
                          @method('put')
                        <div class="card-body">
                          
                          <div class="form-group">
                            <label>Outlet:</label>
                            <br>
                            <select class="form-control col-md-2" name="id_outlet">
                            {{-- <option value="" selected>--Pilih--</option>   --}}
                            {{-- <option value="{{$paket->id_outlet}}" selected>{{$outlet->nama}}</option> --}}
                             @foreach ($outlet as $data)
                             {{-- @if ($outlet->id != $outlet->id) --}}
                            <option value="{{$data->id}}"{{old('id_outlet',$paket->id_outlet) == $data->id  ? "selected" : ''}}>{{$data->nama}}</option>
                             {{-- @endif --}}
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
                            <option value="kiloan"{{ old('jenis', $paket->jenis) == 'kiloan' ? 'selected' : '' }}>Kiloan</option>
                            <option value="selimut"{{ old('jenis', $paket->jenis) == 'selimut' ? 'selected' : '' }}>Selimut</option>
                            <option value="bed_cover"{{ old('jenis', $paket->jenis) == 'bed_cover' ? 'selected' : '' }}>Bed cover</option>
                            <option value="kaos"{{ old('jenis', $paket->jenis) == 'kaos' ? 'selected' : '' }}>Kaos</option>
                            <option value="lain"{{ old('jenis', $paket->jenis) == 'lain' ? 'selected' : '' }}>Lain</option>
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
                            <input type="text" name="nama_paket"
                            @if (old('nama_paket'))
                            value="{{old('nama_paket')}}" 
                            @else
                            value="{{$paket->nama_paket}}" 
                            @endif
                            class="form-control">
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
                            <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="harga" 
                            @if (old('harga'))
                            value="{{old('harga')}}" 
                            @else
                            value="{{$paket->harga}}" 
                            @endif
                            class="form-control">
                            <div class="input-group-prepend">
                              <div class="input-group-text">/Kg</div>
                            </div>
                            <label 
                            @error('harga') 
                            class="text-danger"
                            @enderror>
                            @error('harga')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>

                          <button class="btn btn-primary" type="submit">Simpan</button>
                          <button class="btn btn-secondary" type="reset">Reset</button>
                        
                        </form>
                  </div>
            </div>
         </div>

    </div>
@stop



@push('scripts')

@endpush