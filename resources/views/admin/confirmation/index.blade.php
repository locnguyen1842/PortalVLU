@extends('admin.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class="active">Quản lý năm học</li>
            </ol>
        </div>
    </div>
@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup" >
    <div class="cm-flex">
        <div class="nav-tabs-container  table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('admin.workload.index') ? 'active':''}}"><a href="{{route('admin.workload.index')}}">Quản lý khối lượng công việc</a></li>
                <li class="{{url()->current() == route('admin.schoolyear.index') ? 'active':''}}"><a href="{{route('admin.schoolyear.index')}}">Quản lý năm học</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')


<div  style="padding-top:51px">
    @include('admin.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default mt-20">
        <div class="waiting">
            <img src="{{asset('img/loader.gif')}}" alt="Đang tải">
        </div>
        <div class="panel-heading">Danh sách xác nhận yêu cầu<br>
            @can('cud',App\PI::first())
            <a href="{{route('admin.schoolyear.add')}}" methods="post">
                <button type="button" name="button" class="btn btn-xs btn-secondary">Thiết lập</button>
            </a>
            @endcan
        </div>


        <div class="table-responsive">
            <table class="table table-hover" style="margin-bottom:0">
                <thead>
                    <tr>
                        <th>Năm bắt đầu</th>
                        <th>Năm kết thúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($yearlist->count() >0)
                    @foreach ($yearlist as $item)
                    <tr>
                        <td class="col-sm-6">{{$item->start_year}}</td>
                        <td class="col-sm-5">{{$item->end_year}}</td>
            @can('cud',App\PI::first())

                        <td class="col-sm-1">
                            <a href="{{route('admin.schoolyear.update',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test">
                                <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                            <a href="{{route('admin.schoolyear.delete',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Xóa" class="delete_workload tooltip-test ml-10">
                                <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                        </td>
                        @else
                        <td></td>
                        @endcan

                    </tr>
                    {{--modal delete workload--}}
                    @can('cud',App\PI::first())

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
                        id="pi-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa năm học này ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                    <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endcan

                    @endforeach
                    @else
                    <tr>
                        <td colspan="3" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>
        <div class="panel-footer">
                {{$yearlist->links()}}

        </div>
    </div>
</div>


@endsection
