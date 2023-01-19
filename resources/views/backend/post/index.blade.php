@extends('backend/template/main')
@section('title','Postingan Saya')
@section('container')

<style type="text/css">
    #table-post th, #table-post td:nth-child(1), #table-post td:nth-child(6), #table-post td:nth-child(7){
        text-align: center;
    }
    #table-post td:nth-child(7){
        white-space: nowrap;
    }
</style>

<link href="{{ asset('assets/plugins/bootstrap4-toggle/bootstrap4-toggle.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

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
                            <h3 class="card-title">Daftar Postingan Saya</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="/post/create" class="btn btn-info">
                                        <i class="fa fa-plus-circle"></i> Buat Postingan
                                    </a>
                                </div>
                            </div>
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
                                        <table class="table table-striped table-bordered table-hover" id="table-post">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Kategori</th>
                                                    <th>Tampilkan</th>
                                                    <th>Dilihat</th>
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

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap4-toggle/bootstrap4-toggle.min.js') }}"></script>
<script>
    $(function (){ 
        var table = $('#table-post').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/post",
            columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
               {data: 'title', name: 'title'},
               {data: 'category', name: 'category'},
               {data: 'publish', name: 'publish'},
               {data: 'view', name: 'view'},
               {data: 'published_at', name: 'published_at'},
               {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
               },
            ]
        });

        $(document).on('click', 'a#hapus', function(e){ 
            e.preventDefault();
            $('#link').val($(this).attr('href'));
            $('#modal-konfirmasi').modal('show');
        });

        $('#form-hapus').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "/post/"+$('#link').val(),
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

    });
</script>
@endsection