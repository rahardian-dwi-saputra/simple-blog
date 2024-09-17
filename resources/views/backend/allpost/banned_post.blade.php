@extends('backend/template/main')
@section('title','Kelola Daftar Postingan')
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
               <h1>Kelola Daftar Postingan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Kelola Daftar Postingan</li>
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

                  @if($data->blocked_at == null && $data->is_publish == 1)
                  <div class="card-header">
                     <h3 class="card-title">
                        Banned Postingan
                     </h3>
                  </div>
                  <div class="card-body">

                     <div class="row">
                        <div class="col-lg-8">
                           <form class="form-horizontal" method="post" action="/controlpost/banned/{{ $data->slug }}">
                              @csrf
                              <div class="form-group row">
                                 <label for="slug" class="col-sm-3 col-form-label">
                                    Alasan
                                 </label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Tulis Alasan"></textarea>
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-primary offset-md-3">Simpan</button>
                           </form>
                        </div>
                     </div>

                  </div>
                  @endif
                  
                  <div class="card-header @if($data->blocked_at == null) rounded-0 @endif">
                     <h3 class="card-title">Detail Postingan</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
  
                           @isset($block)

                           <div class="row">
                              <div class="col-md-12">

                                 <form method="post" action="/controlpost/unbanned/{{ $data->slug }}">
                                    @csrf
                                    <button class="btn btn-success" type="submit">
                                       <i class="fa fa-reply"></i> Restore
                                    </button>&nbsp;
                                    <a href="/controlpost" class="btn btn-info">Kembali</a>
                                 </form>

                              </div>
                           </div>
                           <br>
                           

                           <div class="alert alert-danger" role="alert">
                              Postingan ini telah dibanned oleh Admin pada {{ $carbon::parse($block->added_at)->format('d-m-Y H:i:s') }} dikarenakan " {{ $block->reason }} "
                           </div>
                           @endisset

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
                                    <td>{{ $data->published_at }}</td> 
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
                     @if($data->blocked_at == null)
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                              <a href="/controlpost" class="btn btn-info">Kembali</a>
                           </div>
                        </div>
                     </div>
                     @endif


                  </div>
               </div>

            </div>
         </div>
      </div>
   </section>
</div>
@endsection