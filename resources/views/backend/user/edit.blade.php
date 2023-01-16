@extends('backend/template/main')
@section('title','User')
@section('container')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>User</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">User</li>
               </ol>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <form class="form-horizontal" method="post" action="/user/{{ $data->id }}">
                                        @csrf
                                        @method('put')

                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ old('name', $data->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username', $data->username) }}">
                                                @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="role" class="col-sm-2 col-form-label">Role User</label>
                                            <div class="col-sm-5">
                                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                                                    <option value="">Pilih</option>
                                                    <option value="1" @if(old('role', $data->is_admin) == 1) selected @endif>Admin</option>
                                                    <option value="0" @if(old('role', $data->is_admin) == 0) selected @endif>User</option>
                                                </select>
                                                @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                       
                                        <button type="submit" class="btn btn-info">Simpan</button>&nbsp;&nbsp;
                                        <a href="/user" class="btn btn-default">Kembali</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection