@extends('dashboard.admin.savings._saving_form')

@section('input_user')
    <input type="text" class="form-control" id="user-au" name="name" value="{{ $saving->user->name }}">
    <input type="hidden" class="form-control user_id" name="user_id" value="{{ $saving->user->id }}">
@endsection

@section('input_type')
    @foreach($types as $type)
        <option value="{{ $type->id }}" {{ $type->id==$saving->type_id?'selected':'' }}>{{ $type->name }}</option>
    @endforeach
@endsection

@section('input_category')
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id==$saving->category_id?'selected':'' }}>{{ $category->name }}</option>
    @endforeach
@endsection

@section('input_items_amount')
    <input type="text" class="form-control" name="items_amount" value="{{ $saving->items_amount }}">
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
    Perbaharui Transaksi
@endsection
