@extends('backend/template/main')
@section('title','Profile')
@section('container')


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
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
                            <h3 class="card-title">Ubah Sandi</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7">

                                    <form class="form-horizontal" method="post" action="/ubahsandi">
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <label for="old_password" class="col-sm-5 col-form-label">Password Saat Ini <span style="color:red;">*</span></label>
                                            <div class="input-group col-sm-6 field-password">
                                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password">
                                                <div class="input-group-append">  
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                                @error('old_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="new_password" class="col-sm-5 col-form-label">Password Baru <span style="color:red;">*</span></label>
                                            <div class="input-group col-sm-6 field-password">
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password">
                                                <div class="input-group-append">  
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                                @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="new_password_confirmation" class="col-sm-5 col-form-label">Konfirmasi Password Baru <span style="color:red;">*</span></label>
                                            <div class="input-group col-sm-6 field-password">
                                                <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation">
                                                <div class="input-group-append">  
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                                @error('new_password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                      
                                        <button type="submit" class="btn btn-info">Simpan</button>&nbsp;&nbsp;
                                        <a href="/myprofil" class="btn btn-default">Kembali</a>
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
    $(document).ready(function(){ 
        $('.field-password span').on('click', function(event){ 
            event.preventDefault();
            var element = $(this).parent().parent().find('input');

            if(element.attr('type') == 'text'){
                element.attr('type', 'password');
                $(this).find('i').removeClass("fa-eye");
                $(this).find('i').addClass("fa-eye-slash");
            }else{
                element.attr('type', 'text');
                $(this).find('i').removeClass("fa-eye-slash");
                $(this).find('i').addClass("fa-eye");
            }

        });
    });
</script>
@endsection