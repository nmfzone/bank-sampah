@extends('dashboard.admin.categories._category_form')

@section('input_name')
    <input type="text" class="form-control" name="name" value="{!! $category->name !!}">
@endsection

@section('input_price')
    <input type="text" class="form-control" name="price" value="{!! $category->price !!}">
@endsection

@section('submit_message')
    Simpan Perubahan
@endsection
