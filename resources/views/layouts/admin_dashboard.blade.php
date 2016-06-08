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
    <body class="adminDashboard">

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('dashboard/protected') }}">{{ Site::get('site_name') }} Dashboard</a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown custom">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {!! auth()->user()->getProfilImg() !!} {{ auth()->user()->name }} <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="{{ url('/dashboard/protected/users/settings') }}"><i class="fa fa-user fa-fw"></i> Edit Profile</a>
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
                                    {!! Site::displayCompanyLogo(250, 0) !!}
                                </div>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('dashboard/protected/users/create') }}">Tambah User</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('dashboard/protected/users') }}">Daftar User</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Kategori Sampah<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('dashboard/protected/categories/create') }}">Tambah Kategori Sampah</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('dashboard/protected/categories') }}">Daftar Kategori Sampah</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Tipe Sampah<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('dashboard/protected/types/create') }}">Tambah Tipe Sampah</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('dashboard/protected/types') }}">Daftar Tipe Sampah</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Transaksi<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('dashboard/protected/transactions/create') }}">Tambah Transaksi Masuk</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('dashboard/protected/transactions/credit') }}">Tambah Transaksi Keluar</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('dashboard/protected/transactions') }}">Daftar Transaksi</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        @section('page_header')
                            <div class="dashboard-message text-center">
                                Selamat Datang <br> <div class="user-name">{{ auth()->user()->name }}</div>
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
        <script src="{{ asset('assets/js/custom.min.js') }}" type="text/javascript"></script>

        @yield('javascript')

        @include('sweet::alert')

    </body>
</html>
