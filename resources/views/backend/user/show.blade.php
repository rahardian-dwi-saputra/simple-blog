@extends('backend/template/main')
@section('title','User')
@section('container')
<style type="text/css">
    table.borderless td,table.borderless th{
        border: none !important;
    }
</style>
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
                     <h3 class="card-title">Detail Data User</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="table-responsive">
                              <table class="table borderless">
                                 <tr>
                                    <td width="14%">
                                       <strong>Nama</strong>
                                    </td>
                                    <td width="1%">:</td>
                                    <td width="85%">
                                       {{ $data->name }}
                                    </td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Username</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->username }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Email</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->email }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Verifikasi Email</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                       @if($data->email_verified_at == null)
                                          Belum diverifikasi
                                       @else
                                          {{ date('d-m-Y H:i:s', strtotime($data->email_verified_at)) }}
                                       @endif
                                    </td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Role</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                       @if($data->is_admin)
                                          Admin
                                       @else
                                          User
                                       @endif
                                    </td> 
                                 </tr>        
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                              <a href="/user" class="btn btn-info">Kembali</a>
                           </div>
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