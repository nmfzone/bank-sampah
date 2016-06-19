@extends('dashboard.admin.savings.credits._credit_form')

@section('input_user')
    <input type="text" class="form-control" id="user-au" name="name" value="{{ $savingTemp->user->name }}">
    <input type="hidden" class="form-control user_id" name="user_id" value="{{ $savingTemp->user->id }}">
@endsection

@section('input_credit')
    <input type="number" class="form-control" name="credit" value="{{ $savingTemp->credit }}">
@endsection

@section('input_date')
    <input type="text" class="form-control input-date" name="created_at" value="{{ $savingTemp->created_at }}" readonly>
@endsection

@section('input_note')
    <textarea class="form-control" name="note" rows="3">{{ $savingTemp->note }}</textarea>
@endsection

@section('submit_message')
    Perbaharui Transaksi Kredit
@endsection
