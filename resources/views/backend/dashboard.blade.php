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

            <div class="col-12 col-sm-6 col-md-3">
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
        
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1">
                     <i class="fas fa-upload"></i>
                  </span>

                  <div class="info-box-content">
                     <span class="info-box-text">Postingan dipublish</span>
                     <span class="info-box-number">
                        {{ $publish_post }}
                        <small>postingan</small>
                     </span>
                  </div>
               </div>
            </div>
   
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
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
         
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1">
                     <i class="fas fa-exclamation-triangle"></i>
                  </span>

                  <div class="info-box-content">
                     <span class="info-box-text">Pelanggaran</span>
                     <span class="info-box-number">
                        {{ $total_pelanggaran }}
                        <small>postingan</small>
                     </span>
                  </div>
               </div>
            </div>

         </div>
         <div class="row">
            <div class="col-md-12">

               <div class="card">
                  <div class="card-header">
                     <h5 class="card-title">Analisis Traffic</h5>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">

                     <div class="row">
                        <div class="col-md-5">

                           <form id="chart-filter" class="form-horizontal">
                              <div class="form-group row">
                                 <div class="col-sm-5">
                                    <select class="form-control" id="filter_bulan">
                                       <option value="">Pilih Bulan</option>
                                       <option value="1">Januari</option>
                                       <option value="2">Februari</option>
                                       <option value="3">Maret</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-5">
                                    <select class="form-control" id="filter_tahun">
                                       <option value="">Pilih Tahun</option>
                                       
                                    </select>
                                 </div>
                                 <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success">
                                       Lihat
                                    </button>
                                 </div>
                              </div>
                           </form>

                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">

                           <canvas id="visitors-chart" height="200"></canvas>
                        </div>
                     </div>

                  </div>
               </div>

            </div>
         </div>
      </div>

   </section>
</div>
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script>
   $(function(){ 

      var myChart = new Chart(document.getElementById("visitors-chart"), {
         type : 'line',
         data : {
            labels : [ 1500, 1600, 1700, 1750, 1800, 1850,
                  1900, 1950, 1999, 2050 ],
            datasets : [
                  {
                     data : [ 186, 205, 1321, 1516, 2107,
                           2191, 3133, 3221, 4783, 5478 ],
                     label : "America",
                     borderColor : "#3cba9f",
                     fill : false
                  },
                  {
                     data : [ 1282, 1350, 2411, 2502, 2635,
                           2809, 3947, 4402, 3700, 5267 ],
                     label : "Europe",
                     borderColor : "#e43202",
                     fill : false
                  } ]
         },
         options : {
            title : {
               display : true,
               text : 'Chart JS Multiple Lines Example'
            }
         }
      });


      


   });
</script>
@endsection