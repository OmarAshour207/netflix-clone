<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Netflix </title>

    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Vendor Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.min.css') }}">
    {{--  Easy Auto Complete  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/plugins/easyautocomplete/easy-autocomplete.min.css') }}">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500,700&display=swap" rel="stylesheet">
    <!-- main styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.min.css') }}">

    <style>
        .fw-900 {
            font-weight: 900;
        }

        .easy-autocomplete {
            width: 90%;
        }

        .easy-autocomplete input {
            color: #FFF !important;
        }

        .easy-autocomplete .eac-item img {
            max-height: 80px !important;
        }
    </style>
</head>
<body>

@yield('content')

@include('layouts._footer')

<!-- Jquery -->
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!-- bootstrap -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- popper -->
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<!-- Vendor Plugins -->
<script type="text/javascript" src="{{ asset('js/vendor.min.js') }}"></script>
{{-- Easy Auto Complete --}}
<script type="text/javascript" src="{{ asset('dashboard_files/plugins/easyautocomplete/jquery.easy-autocomplete.min.js') }}"></script>
<!-- JS Scripts -->
<script type="text/javascript" src="{{ asset('js/main.min.js') }}"></script>
{{--Player Js--}}
<script type="text/javascript" src="{{ asset('js/playerjs.js') }}"></script>
{{-- custom movies--}}
<script src="{{ asset('js/custom/movie.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    var options = {
        url: function (search) {
            return "/movies?search=" + search;
        },
        getValue: "name",

        template: {
            type: "iconLeft",
            fields: {
                iconSrc: "poster_path"
            }
        },
        list: {
            onChooseEvent: function () {
                var movie = $('.form-control[type="search"]').getSelectedItemData();
                var url = window.location.origin + '/movies/' + movie.id;
                window.location.replace(url);
            }
        }
    };
    $('.form-control[type="search"]').easyAutocomplete(options);

    $(document).ready(function(){

        $('#banner .movies').owlCarousel({
            loop: true,
            navigation: false,
            items: 1,
            dots: false
        });

        $('.listing .movies').owlCarousel({
            loop: true,
            navigation: false,
            dots: false,
            margin: 15,
            stagePadding: 50,
            responsive: {
                0: {
                    items: 1
                }, 600: {
                    items: 3
                }, 900: {
                    items: 3
                }, 1000: {
                    items: 4
                }
            },
        });
    });
</script>

@stack('scripts')
</body>
</html>
