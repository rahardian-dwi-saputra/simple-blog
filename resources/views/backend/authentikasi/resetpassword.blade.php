<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Password Reset | Simple Blog</title>

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
               <a href="#" class="h1"><b>Simple</b>Blog</a>
            </div>
            <div class="card-body">

               <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

               @if(session()->has('message'))
               <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
              
               <form action="/reset-password" method="post">
                  @csrf

                  <input type="hidden" name="token" value="{{ $token }}">

                  @error('email')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
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

                  @error('password')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" autocomplete="off">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  @error('password')
                  <small class="form-text text-danger">{{ $message }}</small>
                  <div class="mb-3"></div>
                  @enderror


                  @error('password_confirmation')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" autocomplete="off">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  @error('password_confirmation')
                  <small class="form-text text-danger">{{ $message }}</small>
                  <div class="mb-3"></div>
                  @enderror

                  <div class="row">
                     <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>


      <!-- jQuery -->
      <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
   </body>
</html>