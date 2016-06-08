@if (Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ implode('<br />', (array) Session::get('success')) }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-error alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ implode('<br />', (array) Session::get('error')) }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ implode('<br />', (array) Session::get('warning')) }}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>Please review the form below and fix errors before submitting again.</p>
        <br/>
        <ol>
            {!! implode('', $errors->all("<li>:message</li>")) !!}
        </ol>
    </div>
@endif