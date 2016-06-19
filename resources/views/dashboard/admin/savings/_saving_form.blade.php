<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Nama</label>

    <div class="col-md-6">
        @yield('input_user')

        @if ($errors->has('user_id'))
            <span class="help-block">
                <strong>{{ $errors->first('user_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Tipe Sampah</label>

    <div class="col-md-6">
        <select class="form-control" name="type_id">
            @yield('input_type')
        </select>

        @if ($errors->has('type_id'))
            <span class="help-block">
                <strong>{{ $errors->first('type_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Kategori Sampah</label>

    <div class="col-md-6">
        <select class="form-control" name="category_id">
            @yield('input_category')
        </select>

        @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('items_amount') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Jumlah Sampah</label>

    <div class="col-md-6">
        @yield('input_items_amount')
        <p style="margin-top:10px">Note : dalam gram</p>

        @if ($errors->has('items_amount'))
            <span class="help-block">
                <strong>{{ $errors->first('items_amount') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Catatan</label>

    <div class="col-md-6">
        @yield('input_note')

        @if ($errors->has('note'))
            <span class="help-block">
                <strong>{{ $errors->first('note') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Tanggal</label>

    <div class="col-md-6">
        @yield('input_date')

        @if ($errors->has('created_at'))
            <span class="help-block">
                <strong>{{ $errors->first('created_at') }}</strong>
            </span>
        @endif
    </div>
</div>

{!! csrf_field() !!}

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> @yield('submit_message')
        </button>
    </div>
</div>

@section('javascript')
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
