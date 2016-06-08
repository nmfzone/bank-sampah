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

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Nama Team</label>

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
    <label class="col-md-4 control-label">E-Mail Address</label>

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

<div class="form-group{{ $errors->has('institution_name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Nama Perguruan Tinggi</label>

    <div class="col-md-6">
        @yield('input_institution_name')

        @if ($errors->has('institution_name'))
            <span class="help-block">
                <strong>{{ $errors->first('institution_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('institution_address') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Alamat Perguruan Tinggi</label>

    <div class="col-md-6">
        @yield('input_institution_address')

        @if ($errors->has('institution_address'))
            <span class="help-block">
                <strong>{{ $errors->first('institution_address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('competition') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Kompetisi</label>

    <div class="col-md-6">
        @yield('input_category')

        @if ($errors->has('competition'))
            <span class="help-block">
                <strong>{{ $errors->first('competition') }}</strong>
            </span>
        @endif
    </div>
</div>

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
