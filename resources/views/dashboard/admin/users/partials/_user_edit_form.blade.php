@extends('dashboard.admin.users._user_form')

@section('input_username')
    <input type="text" class="form-control" name="username" value="{{ $user->username }}">
@endsection

@section('input_identity')
    <input type="text" class="form-control" name="id_card_number" value="{{ $user->id_card_number }}">
@endsection

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
@endsection

@section('input_email')
    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
@endsection

@section('input_address')
    <textarea class="form-control" name="address">{{ $user->address }}</textarea>
@endsection

@section('input_status')
    <input type="text" class="form-control" name="status" value="{{ $user->status }}">
@endsection

@section('optional')
    <input type="hidden" name="setting" value="{{ $setting }}">
@endsection

@section('submit_message')
    Edit User
@endsection
