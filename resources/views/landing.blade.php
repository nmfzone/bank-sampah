<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Site::get('site_name') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">

    <link rel="icon" type="image/x-icon" href="{{ asset(Site::get('favicon')) }}">

</head>
<body class="landing">

    <div class="center-everywhere">
        <div class="content">
            <div class="clock">
                <div class="app-name">{{ Site::get('site_name') }}</div>
                <ul>
                    <li id="hours"></li>
                    <li id="point">:</li>
                    <li id="min"></li>
                </ul>
                <a href="{{ url('auth/login') }}" class="btn btn-primary">Logging In</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/script.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        var newDate = new Date();
        newDate.setDate(newDate.getDate());

        setInterval( function() {
            var minutes = new Date().getMinutes();
            $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
        },1000);

        setInterval( function() {
            var hours = new Date().getHours();
            $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
        }, 1000);
    });
    </script>

</body>
</html>
