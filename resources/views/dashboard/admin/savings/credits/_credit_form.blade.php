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

<div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Jumlah Kredit</label>

    <div class="col-md-6">
        @yield('input_credit')

        @if ($errors->has('credit'))
            <span class="help-block">
                <strong>{{ $errors->first('credit') }}</strong>
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

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Status</label>

    <div class="col-md-6">
        <select class="form-control" name="status">
            @yield('input_status')
        </select>

        @if ($errors->has('status'))
            <span class="help-block">
                <strong>{{ $errors->first('status') }}</strong>
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
