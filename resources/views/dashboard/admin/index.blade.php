@extends('layouts.admin_dashboard')

@section('stylesheets')
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-6 col-centered">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getUsersTotal() >= 1000 ? UserMan::getUsersTotal()/1000 . ' k' : UserMan::getUsersTotal() }}</div>
                            <div>Total Pelanggan!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-3 col-sm-12 col-md-6 col-centered">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getThisDayIncome() >= 1000 ? UserMan::getThisDayIncome()/1000 . ' kg' : UserMan::getThisDayIncome() . ' g' }} </div>
                            <div>Pemasukan hari ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 col-centered">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">Rp {{ number_format( UserMan::getThisDaySpend(), 0 , '' , '.' ) }},00</div>
                            <div>Pengeluaran hari ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-6 col-centered">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">
                                @if(UserMan::getMostActiveUser() != null)
                                    <a href="{{ url('dashboard/protected/users/' . UserMan::getMostActiveUser()->id) }}">{{ substr(UserMan::getMostActiveUser()->name,0,7) }}</a>
                                @else
                                    -
                                @endif
                            </div>
                            <div>Pelanggan teraktif bulan ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-6 col-centered">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">{{ UserMan::getThisMonthIncome() >= 1000 ? UserMan::getThisMonthIncome()/1000 . ' kg': UserMan::getThisMonthIncome() . ' g' }}</div>
                            <div>Pemasukan bulan ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-6 col-md-12 col-centered">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div class="huge">Rp {{ number_format( UserMan::getThisMonthSpend(), 0 , '' , '.' ) }},00</div>
                            <div>Pengeluaran bulan ini!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
