@extends('layouts.admin_dashboard')

@section('stylesheets')
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="row row-centered">
        <div class="col-lg-3 col-md-6 col-centered">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getUsersTotal() }}</div>
                            <div>Total Pelanggan!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-centered">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getThisDayIncome() }} g</div>
                            <div>Pemasukan hari ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-centered">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">Rp {{ UserMan::getThisDaySpend() }},00</div>
                            <div>Pengeluaran hari ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-centered">
        <div class="col-lg-3 col-md-6 col-centered">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getMostActiveUser() != null ? UserMan::getMostActiveUser()->name : '-' }}</div>
                            <div>Pelanggan teraktif bulan ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-centered">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getThisMonthIncome() }} g</div>
                            <div>Pemasukan bulan ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-centered">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">Rp {{ UserMan::getThisMonthSpend() }},00</div>
                            <div>Pengeluaran bulan ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
