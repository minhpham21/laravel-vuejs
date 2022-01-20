@extends('layouts.iframe')
@section('title', trans('category.title.create'))
@section('content-header', trans('category.title.create'))

@section('cssloader')
    <style>
        .slow .toggle-group { 
            transition: left 0.7s;
            -webkit-transition: left 0.7s; 
        }
    </style>
@endsection

@section('content')
    <div class="modal-header">
        <h4 class="modal-title">@lang('category.title.create')</h4>
        <button type="button" class="close btn-cancel" data-dismiss="modal" id="btn-cancel" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('admin.categories.store') }}" role="form" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="title">@lang('common.title.title')&nbsp;<span class="required"></span></label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title" placeholder="{{ trans('common.title.title') }}">
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>@lang('common.title.description')</label>
                <textarea name="description" class="form-control" rows="3" placeholder="{{ trans('common.title.description') }} ..." style="height: 100px; resize: none"></textarea>
                @if ($errors->has('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-3">@lang('common.title.active')</label>
                <div class="col-9">
                    <input id="active" name='active' type="checkbox" checked data-toggle="toggle"  data-width="80px" data-on="{{ trans('common.switch.1') }}" data-off="{{ trans('common.switch.0') }}" data-size="sm">
                </div>
                @if ($errors->has('active'))
                    <span class="text-danger">{{$errors->first('active')}}</span>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn bg-primary text-white">@lang('common.button.create')</button>
        </div>
    </form>
@endsection