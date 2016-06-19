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
        <div class="col-md-12 sync-navigation">
            <div class="col-md-6">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/protected/transactions/synchronize-specific') }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama Nasabah</label>

                        <div class="col-md-6">
                            <input type="text" name="user_name" value="" id="user-au" required>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="" class="user_id">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Sinkronisasi Nasabah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-centered">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/protected/transactions/synchronize-all') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Sinkronisasi Seluruh Nasabah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-condensed the-tables" id="transaction-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Berat</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
$(function() {
    $('#transaction-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.protected.transactions.temporaries.getSavingsTemp') !!}',
        columns: [
        { data: 'id', name: 'id' },
        { data: 'user.name', name: 'user.name' },
        { data: 'user.address', name: 'user.address', visible: false },
        { data: 'type.name', name: 'type.name', defaultContent: '-' },
        { data: 'category.name', name: 'category.name', defaultContent: '-'  },
        { data: 'items_amount', name: 'items_amount', defaultContent: '-',
            render: function ( data, type, full, meta ) {
                if (data >= 1000) {
                    return (data/1000) + ' kg';
                }
                if (null == data) return "-";
                return data + ' g';
            }
        },
        { data: 'debit', name: 'debit',
            render: function ( data, type, full, meta ) {
                return 'Rp ' + data.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ',00';
            }
        },
        { data: 'credit', name: 'credit',
            render: function ( data, type, full, meta ) {
                return 'Rp ' + data.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ',00';
            }
        },
        { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action', orderable: false, searchable: false, width: '200px' }
        ]
    });
});
    </script>
    <script type="text/javascript">
$(function() {
    $( "#user-au" ).autocomplete({
        source: "{{ route('dashboard.protected.users.autocomplete') }}",
        minLength: 3,
        select: function(event, ui) {
            $('#user-au').val(ui.item.value);
            $('.user_id').val(ui.item.id);
        }
    });
});
    </script>
@endsection
