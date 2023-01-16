<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Register | Simple Blog</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
   </head>
   <body class="hold-transition register-page">
      <div class="register-box">
         <div class="card card-outline card-primary">
            <div class="card-header text-center">
               <a href="#" class="h1"><b>Simple</b> Blog</a>
            </div>
            <div class="card-body">
               <p class="login-box-msg">Register a new membership</p>

               <form action="/register" method="post">
                  @csrf

                  @error('name')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" name="name" id="name" value="{{ old('name') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-id-card"></span>
                        </div>
                     </div>
                  </div>
                  @error('name')
                  <small class="form-text text-danger">{{ $message }}</small>
                  <div class="mb-3"></div>
                  @enderror


                  @error('username')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" id="username" value="{{ old('username') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-user"></span>
                        </div>
                     </div>
                  </div>
                  @error('username')
                  <small class="form-text text-danger">{{ $message }}</small>
                  <div class="mb-3"></div>
                  @enderror

                  @error('email')
                     <div class="input-group">
                  @else
                     <div class="input-group mb-3">
                  @enderror
                     <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
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
                     <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" value="{{ old('password') }}">
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
                     <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Retype password" value="{{ old('password_confirmation') }}">
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
                     <div class="col-8">
                        <div class="icheck-primary">
                           <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                           <label for="agreeTerms">
                              I agree to the <a href="#">terms</a>
                           </label>
                        </div>
                     </div>
                     <!-- /.col -->
                     <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                     </div>
                     <!-- /.col -->
                  </div>

               </form>

               <a href="/login" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
         </div><!-- /.card -->
      </div>
      <!-- /.register-box -->

      <!-- jQuery -->
      <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
   </body>
</html>