@extends('backend/template/main')
@section('title','Dashboard')
@section('container')

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
         <div class="row">
            <div class="col-md-12">

               <div class="card">
                  <div class="card-header">
                     <h5 class="card-title">tes</h5>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">

                    
                     <div class="row">
                        <div class="col-md-12">

                           
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