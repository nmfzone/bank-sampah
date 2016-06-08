<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css">

    @yield('stylesheets')

    <link rel="icon" type="image/x-icon" href="{{ asset(Site::get('favicon')) }}">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
@section('bodyTag')
<body>
@show

    @yield('content')

    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/script.min.js') }}" type="text/javascript"></script>

    @yield('javascript')

    @include('sweet::alert')

</body>
</html>
