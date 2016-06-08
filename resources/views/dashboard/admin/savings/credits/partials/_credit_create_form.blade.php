@extends('dashboard.admin.savings.credits._credit_form')

@section('input_user')
    <input type="text" class="form-control" id="user-au" name="name" value="{{ old('name') }}">
    <input type="hidden" class="form-control user_id" name="user_id" value="{{ old('user_id') }}">
@endsection

@section('input_credit')
    <input type="text" class="form-control" name="credit" value="{{ old('credit') }}">
@endsection

@section('input_note')
    <textarea class="form-control" name="note" rows="3">{{ old('note') }}</textarea>
@endsection

@section('input_status')
    <option value="0" selected>Diterima</option>
    <option value="1">Ditangguhkan</option>
    <option value="2">Dibatalkan</option>
@endsection

@section('submit_message')
    Tambah Transaksi Kredit
@endsection
