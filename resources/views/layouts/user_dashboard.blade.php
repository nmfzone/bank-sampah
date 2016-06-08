<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <title>{{ auth()->user()->role->name }} Dashboard</title>

    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dashboard.min.css') }}" rel="stylesheet" type="text/css">

    @yield('stylesheets')

    <link rel="icon" type="image/x-icon" href="{{ asset(Site::get('favicon')) }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="userDashboard">

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('dashboard/') }}">{{ Site::get('site_name') }} Dashboard</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown custom">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {!! auth()->user()->getProfilImg() !!} {{ auth()->user()->username }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ url('/dashboard/users/settings') }}"><i class="fa fa-user fa-fw"></i> Edit Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="expand-top">
                            <div class="company-logo">
                                {!! Site::displayCompanyLogo(200, 0) !!}
                            </div>
                        </li>
                        <li>
                            <a href="{{ url('dashboard/competitions/register') }}"><i class="fa fa-rocket fa-fw"></i> Daftar Kompetisi</a>
                        </li>
                        @if (auth()->user()->category()->first() != null)
                        <li>
                            <a href="{{ url('dashboard/competitions/requirements') }}"><i class="fa fa-briefcase fa-fw"></i> Lengkapi Persyaratan</a>
                        </li>
                        @if (UserMan::onlyGrantedCompetitions())
                        <li>
                            <a href="{{ url('dashboard/competitions/product/upload') }}"><i class="fa fa-upload fa-fw"></i> Upload Karya</a>
                        </li>
                        @endif
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Team<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('dashboard/users') }}">Detail Team</a>
                                </li>
                                <li>
                                    <a href="{{ url('dashboard/members/create') }}">Tambah Anggota</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    @section('page_header')
                        <div class="dashboard-message text-center">
                            Selamat Datang <br> <div class="user-name">{{ auth()->user()->username }}</div>
                        </div>
                    @show
                </div>
            </div>

            <section class="contents">
                @yield('content')
            </section>

        </div>
    </div>

    <script src="{{ asset('assets/js/script.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script>

    @yield('javascript')

    @include('sweet::alert')

</body>
</html>
