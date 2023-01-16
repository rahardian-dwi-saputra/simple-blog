@extends('backend/template/main')
@section('title','Kategori')
@section('container')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                                <div class="col-lg-6">

                                    <form class="form-horizontal" method="post" action="/category">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Nama Kategori</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Kategori" value="{{ old('name') }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="slug" class="col-sm-3 col-form-label">Slug</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="Slug" value="{{ old('slug') }}">
                                                @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info">Simpan</button>&nbsp;&nbsp;
                                        <a href="/category" class="btn btn-default">Kembali</a>
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
<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
        fetch('/category/checkSlug?name='+name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug);
    });
</script>
@endsection