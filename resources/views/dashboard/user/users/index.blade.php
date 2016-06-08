@extends('layouts.user_dashboard')

@section('meta')
    <meta name="token" content="{{ csrf_token() }}">
@endsection

@section('stylesheets')
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('page_header')
    <h1 class="page-header">{{ $pageTitle }}</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2 detail-team">
        <form class="form-horizontal" role="form" method="POST" action="#">

            @include('dashboard.user.users._user_details_form')

        </form>
    </div>
</div>
@endsection
