@extends('backend/template/main')
@section('title','User')
@section('container')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

<style type="text/css">
   #data-user th, #data-user td:nth-child(1), #data-user td:nth-child(6){
      text-align: center;
   }
   #data-user td:nth-child(6){
      white-space: nowrap;
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
                     <h3 class="card-title">Daftar User</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <a href="/user/create" class="btn btn-info">
                              <i class="fa fa-user-plus"></i> Tambah User
                           </a>
                        </div>
                     </div>
                     <br>
                     <br>
                     <div class="row">
                        <div class="col-md-6">
                           <form id="table-filter" class="form-horizontal">

                              <div class="form-group row">
                                 <label for="filter_role" class="col-sm-3 col-form-label">
                                    Role User
                                 </label>
                                 <div class="col-sm-5">
                                    <select class="form-control" id="filter_role">
                                       <option value="">Semua</option>
                                       <option value="Admin">Admin</option>
                                       <option value="User">User</option>                  
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="filter_verifikasi" class="col-sm-3 col-form-label">
                                    Verifikasi Email
                                 </label>
                                 <div class="col-sm-5">
                                    <select class="form-control" id="filter_verifikasi">
                                       <option value="">Semua Status</option>
                                       <option value="Verified">Sudah Verifikasi</option>
                                       <option value="Unverified">Belum Verifikasi</option>                  
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="filter_status" class="col-sm-3 col-form-label">
                                    Status
                                 </label>
                                 <div class="col-sm-5">
                                    <select class="form-control" id="filter_status">
                                       <option value="">Semua</option>
                                       <option value="Aktif">Aktif</option>
                                       <option value="Banned">Banned</option>                  
                                    </select>
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

                           <div class="alert alert-success alert-dismissible" style="display:none;">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <p style="display:inline">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>     
                           </div>

                           <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" id="data-user">
                                 <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Nama</th>
                                       <th>Username</th>
                                       <th>Email</th>
                                       <th>Role User</th>
                                       <th>Action</th>          
                                    </tr>
                                 </thead>
                                 <tbody></tbody>
                              </table>
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

<div class="modal fade" id="modal-konfirmasi">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <form id="form-hapus">
            <input type="hidden" name="link" id="link" />
            <div class="modal-body">
               @csrf
               @method('DELETE')
               Apakah anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Ya</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
         </form>

      </div>
   </div>
</div>

<div class="modal fade" id="modal-konfirmasi-suspent">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <form id="form-suspend">
            <input type="hidden" name="link_suspend" id="link_suspend" />
            <div class="modal-body">
               @csrf
               Apakah anda yakin ingin suspent user ini?
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Ya</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
         </form>

      </div>
   </div>
</div>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
   $(function (){ 

      var table = $('#data-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
               url: "/user",
               data: function (d) {
                  d.role = $('#filter_role').val(),
                  d.verifikasi = $('#filter_verifikasi').val(),
                  d.status = $('#filter_status').val()
               }
            },
            columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
               {data: 'name', name: 'name'},
               {data: 'username', name: 'username'},
               {data: 'email', name: 'email'},
               {data: 'role', name: 'role'},
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

      $('button[type=reset]').click(function(){ 
         $("#filter_role").val('').trigger('change');
         $("#filter_verifikasi").val('').trigger('change');
         $("#filter_status").val('').trigger('change');
         table.draw();
      });

      $(document).on('click', 'a#hapus', function(e){ 
         e.preventDefault();
         $('#link').val($(this).attr('href'));
         $('#modal-konfirmasi').modal('show');
      });

      $('#form-hapus').submit(function(e){
         e.preventDefault();
         $.ajax({
            url: "/user/"+$('#link').val(),
            type: "POST",
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
               $('#modal-konfirmasi').modal('hide'); 
               if(response.success == true){
                  $('div.alert').addClass('alert-success');
                  $('div.alert').removeClass('alert-danger');
               }else{
                  $('div.alert').addClass('alert-danger');
                  $('div.alert').removeClass('alert-success');
               }
               $('#link').val('');
               $('div.alert').show();
               $('div.alert p').text(response.message);
               table.ajax.reload(null, false);
               $('div.alert').fadeOut(10000);
            }
         });
      });

      $(document).on('click', 'a#btn-suspent', function(e){ 
         e.preventDefault();
         $('#link_suspend').val($(this).attr('href'));
         $('#modal-konfirmasi-suspent').modal('show');
      });

      $('#form-suspend').submit(function(e){ 
         e.preventDefault();
         $.ajax({ 
            url: "/user/suspent/"+$('#link_suspend').val(),
            type: "POST",
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
               $('#modal-konfirmasi-suspent').modal('hide'); 
               if(response.success == true){
                  $('div.alert').addClass('alert-success');
                  $('div.alert').removeClass('alert-danger');
               }else{
                  $('div.alert').addClass('alert-danger');
                  $('div.alert').removeClass('alert-success');
               }
               $('#link_suspend').val('');
               $('div.alert').show();
               $('div.alert p').text(response.message);
               table.ajax.reload(null, false);
               $('div.alert').fadeOut(10000);
            }
         });
      });

   });
</script>
@endsection