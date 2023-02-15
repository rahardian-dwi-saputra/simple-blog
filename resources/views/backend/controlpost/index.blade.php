@extends('backend/template/main')
@section('title','Kelola Daftar Postingan')
@section('container')

<style type="text/css">
   
   #table-post th, #table-banned th, #table-post td:nth-child(1), #table-banned td:nth-child(1){
      text-align: center;
   }
   #table-post td:nth-child(6), #table-banned td:nth-child(5), #table-banned td:nth-child(6){
      text-align: center;
   }
   #table-post td:nth-child(7), #table-banned td:nth-child(7){
      text-align: center;
      white-space: nowrap;
   }
   
</style>

<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}" rel="stylesheet">

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

               <div class="card card-info card-tabs">
                  <div class="card-header p-0 pt-1">
                     <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Aktif</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Banned</a>
                        </li>
                     </ul>
                  </div>
                  <div class="card-body">
                     <div class="tab-content" id="custom-tabs-one-tabContent">

                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                           <br>
                           <div class="row">
                              <div class="col-md-6">
                                 <form id="table-filter" class="form-horizontal">
                                    <div class="form-group row">
                                       <label for="filter_kategori" class="col-sm-3 col-form-label">
                                          Kategori
                                       </label>
                                       <div class="col-sm-7">
                                          <select class="form-control" id="filter_kategori">
                                             <option value="">Semua Kategori</option>
                                             @foreach($categories as $category)
                                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="filter_tampil" class="col-sm-3 col-form-label">
                                          Ditampilkan?
                                       </label>
                                       <div class="col-sm-3">
                                          <select class="form-control" id="filter_tampil">
                                             <option value="">Pilih</option>
                                             <option value="Ya">Ya</option>
                                             <option value="Tidak">Tidak</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="filter_tanggal" class="col-sm-3 col-form-label">
                                          Tanggal Posting
                                       </label>
                                       <div class="col-sm-4">
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                             </div>
                                             <input id="tanggal_awal" type="text" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
                                          </div>
                                       </div>
                                       <label for="filter_tanggal" class="col-sm-1 col-form-label text-center">
                                          s.d
                                       </label>
                                       <div class="col-sm-4">
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                             </div>
                                             <input id="tanggal_akhir" type="text" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                       Filter
                                    </button>&nbsp;
                                    <button type="reset" class="btn btn-default">
                                       Reset
                                    </button>
                                 </form>

                              </div>
                           </div>
                           <br>
                           <br>
                           <div class="row">
                              <div class="col-lg-12">

                                 @if(session()->has('success'))
                                 <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 @endif

                                 <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="table-post">
                                       <thead>
                                          <tr>
                                             <th>No</th>
                                             <th>Judul</th>
                                             <th>Penulis</th>
                                             <th>Kategori</th>
                                             <th>Tampilkan</th>
                                             <th>Tanggal Posting</th>
                                             <th>Action</th>          
                                          </tr>
                                       </thead>
                                       <tbody>
                                              
                                       </tbody>
                                    </table>
                                 </div>

                              </div>
                           </div>
        
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                           
                           <br>
                           <div class="row">
                              <div class="col-md-6">
                                 <form id="table-filter-banned" class="form-horizontal">
                                    <div class="form-group row">
                                       <label for="filter_kategori2" class="col-sm-3 col-form-label">
                                          Kategori
                                       </label>
                                       <div class="col-sm-7">
                                          <select class="form-control" id="filter_kategori2">
                                             <option value="">Semua Kategori</option>
                                             @foreach($categories as $category)
                                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="filter_tanggal2" class="col-sm-3 col-form-label">
                                          Tanggal Posting
                                       </label>
                                       <div class="col-sm-4">
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                             </div>
                                             <input id="tanggal_awal2" type="text" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
                                          </div>
                                       </div>
                                       <label for="filter_tanggal" class="col-sm-1 col-form-label text-center">
                                          s.d
                                       </label>
                                       <div class="col-sm-4">
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                             </div>
                                             <input id="tanggal_akhir2" type="text" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                       Filter
                                    </button>&nbsp;
                                    <button type="reset" class="btn btn-default">
                                       Reset
                                    </button>
                                 </form>

                              </div>
                           </div>
                           <br>
                           <br>
                           <div class="row">
                              <div class="col-lg-12">

                                 <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="table-banned">
                                       <thead>
                                          <tr>
                                             <th>No</th>
                                             <th>Judul</th>
                                             <th>Penulis</th>
                                             <th>Kategori</th>
                                             <th>Tanggal Posting</th>
                                             <th>Waktu Banned</th>
                                             <th>Action</th>          
                                          </tr>
                                       </thead>
                                       <tbody>
                                              
                                       </tbody>
                                    </table>
                                 </div>

                              </div>
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

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
   $(function (){ 

      $('.date-picker').datepicker({
         dateFormat:"dd-mm-yy"
      });

      var table = $('#table-post').DataTable({
         processing: true,
         serverSide: true,
         autoWidth: false,
         responsive: true,
         ajax: {
            url: "/controlpost",
            data: function (d) {
                    d.category = $('#filter_kategori').val(),
                    d.tampil = $('#filter_tampil').val(),
                    d.tanggal_awal = $('#tanggal_awal').val(),
                    d.tanggal_akhir = $('#tanggal_akhir').val()
                  }
            },
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'title'},
            {data: 'penulis', name: 'penulis'},
            {data: 'category', name: 'category'},
            {data: 'publish', name: 'publish'},
            {data: 'published_at', name: 'published_at'},
            {
               data: 'action', 
               name: 'action', 
               orderable: true, 
               searchable: true
            },
         ]
      });

      var table2 = $('#table-banned').DataTable({
         processing: true,
         serverSide: true,
         autoWidth: false,
         responsive: true,
         ajax: {
            url: "/controlpost/list",
            data: function (d) {
                    d.category = $('#filter_kategori2').val(),
                    d.tanggal_awal = $('#tanggal_awal2').val(),
                    d.tanggal_akhir = $('#tanggal_akhir2').val()
                  }
         },
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'title'},
            {data: 'penulis', name: 'penulis'},
            {data: 'category', name: 'category'},
            {data: 'published_at', name: 'published_at'},
            {data: 'blocked_at', name: 'blocked_at'},
            {
               data: 'action', 
               name: 'action', 
               orderable: true, 
               searchable: true
            },
         ]
      });

      $('#table-filter').submit(function(e){
         e.preventDefault();
         table.draw();
      });

      $('#table-filter-banned').submit(function(e){
         e.preventDefault();
         table2.draw();
      });

      $('button[type=reset]').click(function(){ 
         var parent_id = $(this).parent().attr('id');

         if(parent_id == 'table-filter'){
            $("#filter_kategori").val('').trigger('change');
            $("#filter_tampil").val('').trigger('change');
            $('#tanggal_awal').val('');
            $('#tanggal_akhir').val('');
            table.draw();
         }else if(parent_id == 'table-filter-banned'){
            $("#filter_kategori2").val('').trigger('change');
            $('#tanggal_awal2').val('');
            $('#tanggal_akhir2').val('');
            table2.draw();
         }

      });
        
   });
</script>

@endsection