@extends('layouts.admin_dashboard')

@section('stylesheets')
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('page_header')
    <h1 class="page-header">{{ $pageTitle }}</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/protected/transactions/credit') }}">

            <input type="hidden" name="type" value="out">
            @include('dashboard.admin.savings.credits.partials._credit_create_form')

        </form>
    </div>
</div>
@endsection
