<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Forgot Password | Simple Blog</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
   </head>
   <body class="hold-transition login-page">

      <div class="login-box">
         <div class="card card-outline card-primary">
            <div class="card-header text-center">
               
               <h3>Verify Your Email Address</h3>
            </div>
            <div class="card-body">

               <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

               @if(session()->has('message'))
               <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif

               <form action="/forgot-password" method="post">
                  @csrf

                  @error('email')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" autocomplete="off">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                  </div>
                  @error('email')
                  <small class="form-text text-danger">{{ $message }}</small>
                  <div class="mb-3"></div>
                  @enderror

                  <div class="row">
                     <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
              
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->

      <!-- jQuery -->
      <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
   </body>
</html>