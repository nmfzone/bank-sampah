@extends('dashboard.admin.types._type_form')

@section('input_name')
    <input type="text" class="form-control" name="name" value="{!! $type->name !!}">
@endsection

@section('submit_message')
    Edit Tipe Sampah
@endsection
