@extends('dashboard.admin.users._user_form')

@section('input_username')
    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
@endsection

@section('input_identity')
    <input type="text" class="form-control" name="id_card_number" value="{{ old('id_card_number') }}">
@endsection

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
@endsection

@section('input_email')
    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
@endsection

@section('input_address')
    <textarea class="form-control" name="address">{{ old('address') }}</textarea>
@endsection

@section('input_phone')
    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
@endsection

@section('input_date')
    <input class="form-control input-date" name="created_at" value="{{ old('created_at') }}" readonly>
@endsection

@section('submit_message')
    Tambah User
@endsection
