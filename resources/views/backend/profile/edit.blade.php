@extends('backend/template/main')
@section('title','Profile')
@section('container')


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
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
                            <h3 class="card-title">Edit Data Profil</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <form class="form-horizontal" method="post" action="/myprofil/edit">
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama" value="{{ old('name', auth()->user()->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="slug" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username', auth()->user()->username) }}">
                                                @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="slug" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info">Simpan</button>&nbsp;&nbsp;
                                        <a href="/myprofil" class="btn btn-default">Kembali</a>
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