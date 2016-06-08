@extends('layouts.admin_dashboard')

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
    <table class="table table-striped the-tables">
        <tr>
            <th>#</th>
            <th>Nama Tipe Sampah</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
        @foreach($types as $key => $type)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $type->name }}</td>
                <td class="text-center"><a href="{{ url('/dashboard/protected/types/' . $type->id . '/edit') }}" class="btn btn-warning">Edit</a></td>
                <td class="text-center"><a href="{{ url('/dashboard/protected/types/' . $type->id) }}" class="btn btn-danger delete-this">Delete</a></td>
            </tr>
        @endforeach
    </table>

    {!! $types->render() !!}
</div>
@endsection
