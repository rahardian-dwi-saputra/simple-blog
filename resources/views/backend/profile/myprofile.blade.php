@extends('backend/template/main')
@section('title','My Profile')
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
            <div class="col-md-3">

               <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                     <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('assets/dist/img/default-profil.png') }}"
                       alt="User profile picture">
                     </div>

                     <h3 class="profile-username text-center">{{ auth()->user()->username }}</h3>

                     <a href="/ubahsandi" class="btn btn-success btn-block">
                        <b><i class="fa fa-key"></i> Ubah Sandi</b>
                     </a>

                  </div>
               </div>

            </div>
            <div class="col-md-9">

               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Tentang Saya</h3>
                  </div>
              
                  <div class="card-body">

                     @if(session()->has('success'))
                     <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     @endif

                     <strong><i class="fas fa-id-card mr-1"></i> Nama</strong>
                     <p class="text-muted">
                        {{ auth()->user()->name }}
                     </p>
                     <hr>

                     <strong><i class="fas fa-user mr-1"></i> Username</strong>
                     <p class="text-muted">
                        {{ auth()->user()->username }}
                     </p>
                     <hr>

                     <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                     <p class="text-muted">
                        {{ auth()->user()->email }}
                     </p>
                     
                     @if(auth()->user()->created_at)
                     <hr>
                     <strong><i class="far fa-calendar mr-1"></i> Tanggal bergabung</strong>
                     <p class="text-muted">{{ auth()->user()->created_at }}</p>
                     @endif
                     <br>

                     <a href="/myprofil/edit" class="btn btn-info">
                        <b><i class="fa fa-edit"></i> Edit Data Profil</b>
                     </a>
              </div>
              <!-- /.card-body -->
            </div>

            </div>


         </div>
      </div>

   </section>
</div>

@endsection