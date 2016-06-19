<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Username</label>

    <div class="col-md-6">
        @yield('input_username')

        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
    </div>
</div>

@if(!$setting)
    <div class="form-group{{ $errors->has('id_card_number') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">No Identitas</label>

        <div class="col-md-6">
            @yield('input_identity')

            @if ($errors->has('id_card_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_card_number') }}</strong>
                </span>
            @endif
        </div>
    </div>
@endif

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Nama</label>

    <div class="col-md-6">
        @yield('input_name')

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">E-Mail</label>

    <div class="col-md-6">
        @yield('input_email')

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Password</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Konfirmasi Password</label>

    <div class="col-md-6">
        <input type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
</div>

@if(!$setting)
    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Alamat</label>

        <div class="col-md-6">
            @yield('input_address')

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">No. Telp</label>

        <div class="col-md-6">
            @yield('input_phone')

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>

    @if($edit)
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
    @endif

    <div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Tanggal Bergabung</label>

        <div class="col-md-6">
            @yield('input_date')

            @if ($errors->has('created_at'))
                <span class="help-block">
                    <strong>{{ $errors->first('created_at') }}</strong>
                </span>
            @endif
        </div>
    </div>
@endif

{!! csrf_field() !!}

@yield('optional')

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> @yield('submit_message')
        </button>
    </div>
</div>
