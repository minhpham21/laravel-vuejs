@extends('layouts.admin.app')
@section('title', trans('product.title.edit'))
@section('content-header', trans('product.title.edit'))

@section('content')
    <product
        :product-data = "{{json_encode($productData) }}"
        :form-action = "{{json_encode($formAction)}}"
        :category-list = "{{json_encode($categoryList)}}"
        :is-edit = 'true'
        :trans-product = "{{ json_encode(trans('product')) }}"
        :trans-btn = "{{ json_encode(trans('common.button')) }}"
        :trans-title = "{{ json_encode(trans('common.title')) }}"
    >
    </product>
@endsection

@section('script')
    <script src="{{ asset('js/vue.js') }}"></script>
@endsection