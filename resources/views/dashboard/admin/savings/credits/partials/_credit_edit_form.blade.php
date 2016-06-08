@extends('dashboard.admin.savings.credits._credit_form')

@section('input_user')
    <input type="text" class="form-control" id="user-au" name="name" value="{{ $saving->user->name }}">
    <input type="hidden" class="form-control user_id" name="user_id" value="{{ $saving->user->id }}">
@endsection

@section('input_credit')
    <input type="text" class="form-control" name="credit" value="{{ $saving->credit }}">
@endsection

@section('input_note')
    <textarea class="form-control" name="note" rows="3">{{ $saving->note }}</textarea>
@endsection

@section('input_status')
    <option value="0" {{ $saving->status==0?'selected':'' }}>Diterima</option>
    <option value="1" {{ $saving->status==1?'selected':'' }}>Ditangguhkan</option>
    <option value="2" {{ $saving->status==2?'selected':'' }}>Dibatalkan</option>
@endsection

@section('submit_message')
    Perbaharui Transaksi Kredit
@endsection
