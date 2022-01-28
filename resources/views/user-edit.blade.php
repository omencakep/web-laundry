@extends('layouts.master')
@section('link') 
<li class="menu-header">Dashboard</li>
<li class="active"><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif

@stop
@section('content')
  <!-- Main Content -->
 
    <section class="section">
      <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      <div class="section-body">
    <h2 class="section-title">Hi, {{Auth::user()->name}}</h2>
        <p class="section-lead">
          Rubah profile anda di halaman ini.
        </p>

        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{route ('update-user', Auth::user()->id)}}" method="POST">
              @csrf
              @method('put')
            <div class="card">
              <div class="card-header"> 
                <h4>Edit Profile</h4>
                {{-- message update data --}}
                @if (session('message-update'))
                <div class="alert alert-info alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-update'))}}
                  </div>
                </div>
                @endif
                
              </div>
                
                
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name"
                        @if (old('name'))
                        value="{{old('name')}}" 
                        @else
                        value="{{$user->name}}" 
                        @endif
                        required="">
                        <div class="invalid-feedback">
                          Please fill in the first name
                        </div>
                      </div>

                    </div> 
                    <div class="row">
                      <div class="form-group col-md-6 col-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"
                         @if (old('email'))
                        value="{{old('email')}}" 
                        @else
                        value="{{$user->email}}" 
                        @endif
                         required="">
                        <div class="invalid-feedback">
                          Harap isi email
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-6">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password"

                        value="{{old('password')}}" 

                         >
                        <div class="invalid-feedback">
                          Harap isi password
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-md-5 col-12">
                        <label>Role</label>
                        <input type="text" class="form-control" name="role"
                        @if (old('role'))
                        value="{{old('role')}}" 
                        @else
                        value="{{$user->role}}" 
                        @endif
                        disabled>
                      </div>
                    </div>
                  </div>

                    
                    
                    <div class="card-footer text-left">
                      <a href="{{url('/dashboard')}}" class="btn btn-primary">Back</a>
                      <button class="btn btn-info" type="submit">Simpan</button>
                    </form>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
@stop



@push('scripts')

@endpush