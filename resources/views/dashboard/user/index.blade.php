@extends('layouts.user_dashboard')

@section('stylesheets')
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row row-centered homepage">
        <div class="col-md-10 col-centered">
            @if($competition == null)
                <div class="col-md-12 row-centered">
                    <div class="col-md-8 alert alert-warning col-centered messages">
                        Kamu belum terdaftar di kompetisi manapun.<br>
                        Silahkan klik <a href="{{ url('dashboard/competitions/register') }}">disini</a> untuk melakukan registrasi kompetisi.
                    </div>
                </div>
            @else
                <h4>Detail Kompetisi</h4>
                {{--*/ $total_price = 0 /*--}}
                {{--*/ $price = 0 /*--}}
                @foreach($competition_details as $detail)
                    <div class="col-md-12 row-centered user-comp-detail">
                        <div class="col-md-5">
                            {{ $category->find($detail->category_id)->name }}
                        </div>
                        <div class="col-md-2">
                            @if ($detail->verified == 0)
                                {{--*/ $price = $category->find($detail->category_id)->price /*--}}
                                Rp {{ $price }},00
                                {{--*/ $total_price += $price /*--}}
                            @else
                                <b>Lunas</b>
                            @endif
                        </div>
                        <div class="col-md-2">
                            @if ($detail->verified == 1)
                                <span class="btn btn-xs btn-success"><i class="glyphicon glyphicon-ok"></i> Terverifikasi</span>
                            @else
                                <span class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-remove"></i> Belum Terverifikasi</span>
                            @endif
                        </div>
                    </div>
                @endforeach
                    @if ($total_price > 0)
                        <div class="col-md-12 row-centered user-comp-detail">
                            <div class="col-md-5">
                                <b>Total</b>
                            </div>
                            <div class="col-md-2">
                                Rp {{ $total_price }},00
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    @endif
            @endif
        </div>
    </div>

@endsection
