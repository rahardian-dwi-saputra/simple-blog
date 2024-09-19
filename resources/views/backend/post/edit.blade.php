@extends('backend/template/main')
@section('title','Postingan Saya')
@section('container')

<link href="{{ asset('assets/plugins/bootstrap4-toggle/bootstrap4-toggle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/trixeditor/trix.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}" rel="stylesheet">
<style type="text/css">
    trix-editor {
        height: 180px !important;
        width: 100% !important;
        max-height: 180px !important;
        overflow-y: auto !important;
    }
    trix-toolbar [data-trix-button-group="file-tools"]{
        display:none;
    }
    trix-toolbar{
        width: 100%; 
    }
</style>
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
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">

                                    <form class="form-horizontal" method="post" action="/post/{{ $data->slug }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 col-form-label">Judul</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Judul" value="{{ old('title', $data->title) }}">
                                                @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="Slug" value="{{ old('slug', $data->slug) }}">
                                                @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Gambar</label>
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="image">
                                                        @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row @if(!$data->image) d-none @endif" id="field-image">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-5">
                                                @if($data->image)
                                                <img src="{{ asset('storage/'.$data->image) }}" id="imagepreview" class="img-fluid" style="max-height: 200px; overflow-y: auto;" />
                                                @else
                                                <img id="imagepreview" class="img-fluid" style="max-height: 200px; overflow-y: auto;" />
                                                @endif
                                                
                                                <div></div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                                            <div class="col-sm-4">
                                                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                                                    <option value="">Pilih</option>
                                                    @foreach($categories as $category)
                                                        @if(old('category', $data->category->slug) == $category->slug)
                                                        <option value="{{ $category->slug }}" selected>{{ $category->name }}</option>
                                                        @else
                                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="is_publish" class="col-sm-2 col-form-label">Tampilkan?</label>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="publish" id="publish" @if(old('publish', $data->is_publish) == 1) checked @endif value="1" data-toggle="toggle" data-on="Ya" data-off="Tidak" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label">Isi</label>
                                            <div class="col-sm-10">
                                                <input id="body" type="hidden" name="body" value="{{ old('body', $data->body) }}">
                                                <trix-editor input="body"></trix-editor>
                                                @error('body')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info">Simpan</button>&nbsp;&nbsp;
                                        <a href="/post" class="btn btn-default">Kembali</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
<script src="{{ asset('assets/plugins/bootstrap4-toggle/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/trixeditor/trix.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>
<script>
    function readURL(input){
        $('#field-image').removeClass('d-none');
        
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e){
                $('#field-image div div').html('');
                $('#imagepreview').removeClass('d-none');
                $('#imagepreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('#imagepreview').addClass('d-none');
            $('#field-image div div').html('<p class="text-danger">File yang anda pilih bukan gambar</p>');
        }
    }   

    $(function(){ 
        $('#tanggal_posting').datepicker({
            dateFormat:"dd-mm-yy"
        });

        $("#image").change(function(){
            readURL(this);
        });

    });
</script>
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/post/checkSlug?title='+title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug);
    });

    document.addEventListener('trix-file-accept', function(e){
      e.preventDefault();
    });

</script>
@endsection