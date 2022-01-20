@extends('layouts.app')
@section('title', trans('category.title.list'))
@section('content-header', trans('category.title.list'))

@section('content')
    <div class="row">
        <div class="col-12">
            {{-- iframe --}}
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <iframe src="" frameborder="0" width="100%" style="border-radius: inherit" class="iframe-full-height" ></iframe>
                    </div>
                </div>
            </div>
            {{-- ./iframe --}}

            <!-- filter -->
            <div class="card card-default card-primary card-outline collapsed-card">
                <div class="card-header">
                    <span class="card-title text-lg-left font-weight-bold">
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;@lang('common.title.filter')
                    </span>
                    <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse" aria-expanded="true"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
            <!-- ./filter -->

            <!-- list -->
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <a data-url="{{ route('admin.categories.create') }}" href="" role="button" class="btn btn-primary modal-trigger" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>&nbsp;@lang('common.button.create')
                            </a>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">@lang('common.title.title')</th>
                                <th class="text-center align-middle">@lang('common.title.active')</th>
                                <th class="text-center align-middle">@lang('common.title.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center align-middle">{{$category->id}}</td>
                                    <td class="align-middle">{{$category->title}}</td>
                                    <td class="text-center align-middle">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" {{$category->active ? "checked=checked" : ''}} class="custom-control-input" id="customSwitch_{{$category->id}}" onclick="updateStatus(this)"  data-url="{{ route('admin.categories.updateActive', ['category'=> $category] ) }}">
                                            <label class="custom-control-label" for="customSwitch_{{$category->id}}"></label>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                      </ul>
                </div>
            </div>
            <!-- ./list -->
            
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateStatus(e) {
            axios({
                method: "PUT",
                url: e.dataset.url,
            })
            .then((result) => {
                Toast.fire({
                    icon: 'success',
                    title: '{{Session::get('success')}}',
                    color: '#28a745',
                });
            })
            .catch((err) => {
                alert("Can't update status");
                console.log(err);
            });
        }
    </script>
@endsection
