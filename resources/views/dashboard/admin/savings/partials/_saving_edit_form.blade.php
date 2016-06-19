@extends('dashboard.admin.savings._saving_form')

@section('input_user')
    <input type="text" class="form-control" id="user-au" name="name" value="{{ $savingTemp->user->name }}">
    <input type="hidden" class="form-control user_id" name="user_id" value="{{ $savingTemp->user->id }}">
@endsection

@section('input_type')
    @foreach($types as $type)
        <option value="{{ $type->id }}" {{ $type->id==$savingTemp->type_id ? 'selected':'' }}>{{ $type->name }}</option>
    @endforeach
@endsection

@section('input_category')
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id==$savingTemp->category_id ? 'selected':'' }}>{{ $category->name }}</option>
    @endforeach
@endsection

@section('input_items_amount')
    <input type="text" class="form-control" name="items_amount" value="{{ $savingTemp->items_amount }}">
@endsection

@section('input_note')
    <textarea class="form-control" name="note" rows="3">{{ $savingTemp->note }}</textarea>
@endsection

@section('input_date')
    <input type="text" class="form-control input-date" name="created_at" value="{{ $savingTemp->created_at }}" readonly>
@endsection

@section('submit_message')
    Perbaharui Transaksi
@endsection
