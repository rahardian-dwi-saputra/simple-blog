<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Verify Email | Simple Blog</title>

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
   <body class="hold-transition login-page">

      <div class="login-box">
         <div class="card card-outline card-primary">
            <div class="card-header text-center">
               <h3>Verify Your Email Address</h3>
            </div>
            <div class="card-body">

               @if(session()->has('message'))
               <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif

               <p class="login-box-msg">Before proceeding, please check your email for a verification link.</p>

               <form action="{{ route('verification.send') }}" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Resend Email Verification</button>
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