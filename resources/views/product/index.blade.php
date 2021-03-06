@extends('layouts.admin.app')
@section('title', trans('product.title.list'))
@section('content-header', trans('product.title.list'))

@section('content')
    <div class="row">
        {{-- <div class="col-12">
            <div class="card card-default card-primary card-outline">
                <div class="card-header">
                    <span class="card-title text-lg-left font-weight-bold">
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;@lang('common.title.filter')
                    </span>
                    <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse" aria-expanded="true"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>@lang('common.title.title')</label>
                                <select class="select2 form-control" name="category_id"  data-placeholder="Select an option" data-allow-clear="true">
                                    <option value=""></option>
                                    @foreach ($categoryList as $key => $name)
                                        <option value="{{ $key }}" {{ old('category_id') == $key ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>@lang('common.title.active')</label>
                                <select class="custom-select" name="active">
                                    <option value="">All</option>
                                    @foreach (config('constants.status') as $statusValue)
                                        <option value="{{$statusValue}}" {{ $statusValue == old('active') ? "selected" : "" }}>@lang('common.switch.'.$statusValue)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-md-3 mb-3 d-flex align-items-end">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </div>
                    </form>                      
                </div>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <a data-url="{{ route('admin.categories.create') }}" href="{{ route('admin.products.create') }}" role="button" class="btn btn-primary modal-trigger" title="{{trans('common.button.create')}}">
                                <i class="fas fa-plus-circle"></i>&nbsp;@lang('common.button.create')
                            </a>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <select name="limit" class="form-control form-control-sm" id="limit">
                                    <option value="15" {{ old('limit') == 15 ? 'selected' : '' }}>15</option>
                                    <option value="50" {{ old('limit') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ old('limit') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <span class="text-secondary">{{trans_choice('common.title.total', $total)}}</span>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" style="width: 15%;">#</th>
                                <th class="text-center align-middle" style="width: 45%;">@lang('common.title.title')</th>
                                <th class="text-center align-middle" style="width: 20%;">@lang('common.title.active')</th>
                                <th class="text-center align-middle" style="width: 20%;">@lang('common.title.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center align-middle">{{$product->id}}</td>
                                    <td class="align-middle">{{$product->title}}</td>
                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" {{$product->active ? "checked=checked" : ''}} class="custom-control-input" id="customSwitch_{{$product->id}}" onclick="updateStatus(this)" >
                                            <label class="custom-control-label" for="customSwitch_{{$product->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="{{ route('admin.products.edit', ['product' => $product]) }}" href="" role="button" class="btn btn-default btn-sm modal-trigger" title="{{ trans('common.button.edit') }}" style="width: 33px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-delete" title="{{ trans('common.button.delete') }}" onclick="document.getElementById('form-delete').setAttribute('action', '{{ route('admin.products.destroy', ['product' => $product]) }}')" style="width: 33px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="pagination-sm m-0 float-right">
                        {{ $products->appends($params)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#limit').change(function (e) { 
            e.preventDefault();
            let limit = $(this).val();
            let link = replaceUrl(document.URL, "page", 1);
            link = replaceUrl(link, "limit", limit);
            location.href = link;
        });
    </script>
@endsection