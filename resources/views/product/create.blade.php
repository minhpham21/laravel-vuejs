@extends('layouts.admin.app')
@section('title', trans('product.title.create'))
@section('content-header', trans('product.title.create'))

@section('content')
    <product 
        :category-list = "{{ json_encode($categoryList) }}"
        :form-action = " {{ json_encode(route('admin.products.store')) }}"
        :trans-product = "{{ json_encode(trans('product')) }}"
        :trans-btn = "{{ json_encode(trans('common.button')) }}"
        :trans-title = "{{ json_encode(trans('common.title')) }}"
    >
    </product>
@endsection

@section('script')
    <script src="{{ asset('js/vue.js') }}"></script>
@endsection