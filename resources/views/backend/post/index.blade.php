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

<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}" rel="stylesheet">

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
                        <li class="breadcrumb-item active">Aktif</li>
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
                                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
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
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
    $(function (){ 

        $('.date-picker').datepicker({
            dateFormat:"dd-mm-yy"
        });

        var table = $('#table-post').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/post",
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
               {data: 'category', name: 'category'},
               {data: 'publish', name: 'publish'},
               {data: 'view', name: 'view'},
               {data: 'created_at', name: 'created_at'},
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
            $("#filter_kategori").val('').trigger('change');
            $("#filter_tampil").val('').trigger('change');
            $('#tanggal_awal').val('');
            $('#tanggal_akhir').val('');
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