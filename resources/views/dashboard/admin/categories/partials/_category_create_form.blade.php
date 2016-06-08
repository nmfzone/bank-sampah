@extends('dashboard.admin.categories._category_form')

@section('input_name')
    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
@endsection

@section('input_price')
    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
@endsection

@section('submit_message')
    Tambah Kategori
@endsection
