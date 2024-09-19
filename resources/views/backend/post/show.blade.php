@extends('backend/template/main')
@section('title','Postingan Saya')
@section('container')
@inject('carbon', 'Carbon\Carbon')
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
               <h1>Postingan Saya</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Postingan Saya</li>
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
                     <h3 class="card-title">Detail Postingan</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          
                           <div class="table-responsive">
                              <table class="table borderless">
                                 @if($data->image)
                                 <tr>
                                    <td colspan="3" style="text-align: center;">
                                       <img src="{{ asset('storage/'.$data->image) }}" width="500" height="300" />
                                    </td>
                                 </tr>
                                 @endif
                                 <tr>
                                    <td width="14%">
                                       <strong>Judul</strong>
                                    </td>
                                    <td width="1%">:</td>
                                    <td width="85%">
                                       {{ $data->title }}
                                    </td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Kategori</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->category->name }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Penulis</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->user->name }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Dilihat</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->view }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Tampilkan?</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                       @if($data->is_publish)
                                          Ya
                                       @else
                                          Tidak
                                       @endif
                                    </td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Tanggal Posting</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->created_at }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Excerpt</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{{ $data->excerpt }}</td> 
                                 </tr>
                                 <tr>
                                    <td>
                                       <strong>Isi</strong>
                                    </td>
                                    <td>:</td>
                                    <td>{!! $data->body !!}</td> 
                                 </tr>
                                     
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                              @if(request()->is('allpost*'))
                              <a href="/allpost" class="btn btn-info">Kembali</a>
                              @else
                              <a href="/post" class="btn btn-info">Kembali</a>
                              @endif
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