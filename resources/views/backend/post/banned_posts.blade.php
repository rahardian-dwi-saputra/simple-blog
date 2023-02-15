@extends('backend/template/main')
@section('title','Postingan Saya')
@section('container')

@if($cek_banned > 0)
<style type="text/css">
    #table-post th, #table-post td{
        text-align: center;
    }
    #table-post td:nth-child(7){
        white-space: nowrap;
    }
    #table-post td:nth-child(2), #table-post td:nth-child(3){
        text-align: left;
    }
</style>

<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endif

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
                        <li class="breadcrumb-item">Postingan Saya</li>
                        <li class="breadcrumb-item active">Banned</li>
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
                            <h3 class="card-title">Daftar Postingan Yang Dibanned</h3>
                        </div>
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-lg-12">

                                    @if($cek_banned > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="table-post">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Kategori</th>
                                                    <th>Dilihat</th>
                                                    <th>Tanggal Posting</th>
                                                    <th>Waktu Banned</th>
                                                    <th>Action</th>          
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p>Tidak ada postingan yang dibanned</p>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@if($cek_banned > 0)
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(function (){ 

        var table = $('#table-post').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/banned-post",
            columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
               {data: 'title', name: 'title'},
               {data: 'category', name: 'category'},
               {data: 'view', name: 'view'},
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

    });
</script>
@endif
@endsection