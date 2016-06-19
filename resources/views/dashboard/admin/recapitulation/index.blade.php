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

        <table class="table table-condensed the-tables" id="recapitulation-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Berat Total</th>
                    <th>Saldo Akhir</th>
                </tr>
            </thead>
        </table>

    </div>
@endsection

@section('javascript')
    <script>
$(function() {
    $('#recapitulation-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.protected.recapitulations.getRecapitulation') !!}',
        columns: [
            { data: 'id', name: 'id', visible: false },
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address', visible: false },
            { data: 'items_amount_total', name: 'items_amount_total', searchable: false,
                render: function ( data, type, full, meta ) {
                    if (data >= 1000) {
                        return (data/1000) + ' kg';
                    }

                    return data + ' g';
                }
            },
            { data: 'balance_total', name: 'balance_total', searchable: false,
                render: function ( data, type, full, meta ) {
                    return 'Rp ' + data.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ',00';
                }
            }
        ]
    });
});
    </script>
@endsection
