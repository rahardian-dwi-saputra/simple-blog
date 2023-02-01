<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Register | Simple Blog</title>

      <link rel="icon" href="{{ asset('assets/dist/img/blogicon.png') }}">

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
               <p class="login-box-msg">Buat Akun Baru</p>

               @if(session()->has('error'))
               <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif

               <form action="/register" method="post">
                  @csrf

                  <div class="input-group mb-3 has-validation">
                     <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" name="name" id="name" value="{{ old('name') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-id-card"></span>
                        </div>
                     </div>
                     @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="input-group mb-3 has-validation">
                     <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" id="username" value="{{ old('username') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-user"></span>
                        </div>
                     </div>
                     @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="input-group mb-3 has-validation">
                     <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                     @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="input-group mb-3 has-validation">
                     <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" value="{{ old('password') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                     @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
            
                  <div class="input-group mb-3 has-validation">  
                     <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Retype password" value="{{ old('password_confirmation') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                     @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="row">
                     <div class="col-8">
                        <div class="icheck-primary">
                           <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                           <label for="agreeTerms">
                              I agree to the <a href="#">terms</a>
                           </label>
                        </div>
                     </div>
                     
                     <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                     </div>
                    
                  </div>

               </form>

               <a href="/login" class="text-center">Saya sudah punya akun</a>
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