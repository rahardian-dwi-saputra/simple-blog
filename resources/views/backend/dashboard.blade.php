@extends('backend/template/main')
@section('title','Dashboard')
@section('container')

<style type="text/css">
   #table-post th, #table-post td:nth-child(1), #table-post td:nth-child(4), #table-post td:nth-child(5), #table-post td:nth-child(6){
        text-align: center;
   }
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
      <div class="container-fluid">

         <div class="row">

            <div class="col-12 col-sm-6 col-md-4">
               <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1">
                     <i class="fas fa-edit"></i>
                  </span>

                  <div class="info-box-content">
                     <span class="info-box-text">Postingan dibuat</span>
                     <span class="info-box-number">
                        {{ $total_post }}
                        <small>postingan</small>
                     </span>
                  </div>
               </div>
            </div>
        
            <div class="col-12 col-sm-6 col-md-4">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1">
                     <i class="fas fa-upload"></i>
                  </span>

                  <div class="info-box-content">
                     <span class="info-box-text">Postingan ditampilkan</span>
                     <span class="info-box-number">
                        {{ $publish_post }}
                        <small>postingan</small>
                     </span>
                  </div>
               </div>
            </div>
   
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-4">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-secondary elevation-1">
                     <i class="fas fa-chart-line"></i>
                  </span>

                  <div class="info-box-content">
                     <span class="info-box-text">Total traffic</span>
                     <span class="info-box-number">
                        {{ $total_traffic }}
                        <small>dilihat</small>
                     </span>
                  </div>
               </div>
            </div>
         
         </div>

         @if($popular_posts->count())

         <div class="row">
            <div class="col-md-12">

               <div class="card">
                  <div class="card-header">
                     <h5 class="card-title">Postingan Populer</h5>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">

                     <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" id="table-post">
                                 <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Judul</th>
                                       <th>Kategori</th>
                                       <th>Dilihat</th>
                                       <th>Waktu Posting</th>
                                       <th>Action</th>          
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($popular_posts as $post)
                                    <tr>
                                       <td>{{ $loop->iteration }}</td>
                                       <td>{{ $post->title }}</td>
                                       <td>{{ $post->name }}</td>
                                       <td>{{ $post->view }}</td>
                                       <td>{{ date('d-m-Y H:i:s', strtotime($post->created_at)) }}</td>
                                       <td>
                                          <a href="/post/{{ $post->slug }}" class="btn btn-primary" title="Detail">
                                             <i class="fa fa-eye"></i>
                                          </a>
                                       </td>
                                    </tr>
                                    @endforeach         
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         @endif

      </div>
   </section>
</div>

@endsection