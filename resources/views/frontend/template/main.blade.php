<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('title') | Simple Blog</title>

        <link rel="icon" href="{{ asset('assets/dist/img/blogicon.png') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    </head>
    <body>
        <div class="container">
            @include('frontend/template/header')
            @yield('container')
           
            <footer class="page-footer font-small bg-secondary">
                <div class="footer-copyright text-center py-3">
                    Simple Blog Application<br>
                    <b>Copyright &copy; 2023 - Rahardian Dwi Saputra</b>
                </div>
            </footer>
        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery.slim.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    </body>
</html>