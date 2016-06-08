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

    <table class="table table-condensed the-tables" id="transaction-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Kategori</th>
                <th>Berat</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
                <th>Tanggal</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>
@endsection

@section('javascript')
    <script>
        $(function() {
            $('#transaction-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('dashboard.protected.transactions.getSavings') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user.name', name: 'user.name' },
                    { data: 'type.name', name: 'type.name', defaultContent: '-' },
                    { data: 'category.name', name: 'category.name', defaultContent: '-'  },
                    { data: 'items_amount', name: 'items_amount', defaultContent: '-' },
                    { data: 'debit', name: 'debit' },
                    { data: 'credit', name: 'credit' },
                    { data: 'balance', name: 'balance' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, width: '200px' }
                ]
            });
        });
    </script>
@endsection
