@extends('backend/template/main')
@section('title','Kelola Daftar Postingan')
@section('container')


<style type="text/css">
    #table-post th, #table-post td:nth-child(1), #table-post td:nth-child(7){
        text-align: center;
    }
    #table-post td:nth-child(7){
        white-space: nowrap;
    }
</style>

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

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
                        <div class="card-header">
                            <h3 class="card-title">Daftar Postingan</h3>
                        </div>
                        <div class="card-body">
                            
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
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function (){ 
        var table = $('#table-post').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/controlpost",
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
    });
</script>

@endsection