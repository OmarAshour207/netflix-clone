<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title> Netflix </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/main.css') }}">
    {{--    Jquery  --}}
    <script src="{{ asset('dashboard_files/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('dashboard_files/css/lib/noty.css') }}" rel="stylesheet">
    <script src="{{ asset('dashboard_files/js/plugins/noty.js') }}" type="text/javascript"></script>
    <style>
        label {
            font-weight: bold;
        }
    </style>

    @stack('styles')

</head>
<body class="app sidebar-mini">

<!-- Navbar-->
@include('layouts.dashboard._header')

<!-- Sidebar menu-->
@include('layouts.dashboard._aside')

<main class="app-content">
    @include('dashboard.partials.session')
    @yield('content')
</main>
<!-- Essential javascripts for application to work-->

<script src="{{ asset('dashboard_files/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard_files/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('dashboard_files/js/plugins/pace.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{ asset('dashboard_files/js/plugins/select2.min.js') }}"></script>
{{-- Movie --}}
<script src="{{ asset('dashboard_files/js/custom/movie.js') }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $(document).on('click', '.delete', function (e) {
            var that = $(this);
            e.preventDefault();
            var n = new Noty({
                text: "Confirm deleting record",
                killer: true,
                buttons: [
                    Noty.button('Yes', 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),
                    Noty.button('No', 'btn btn-danger', function () {
                        n.close();
                    })
                ]
            });
            n.show();
        });
    });
    // select 2
    $('.select2').select2({
        width: '100%'
    });
</script>
</body>
</html>
