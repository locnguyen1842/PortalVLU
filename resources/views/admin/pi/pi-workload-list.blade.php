@extends('admin.master')
@section('title','Xem chi tiết thông tin cá nhân')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
             <li class=""><a href="{{route('admin.pi.detail',$pi_id)}}">Chi tiết nhân viên - {{App\PI::find($pi_id)->employee_code}}</a></li>
            <li class="active">Danh sách khối lượng công việc</li>
        </ol>
    </div>
</div>

@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup" >
    <div class="cm-flex">
        <div class="nav-tabs-container">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('admin.pi.detail',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.detail',$pi_id)}}">Thông tin cá nhân</a></li>
                <li class="{{url()->current() == route('admin.pi.workload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.workload.index',$pi_id)}}">Khối lượng công việc</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')
@include('admin.layouts.Error')
@if(session()->has('message'))
    <div class="alert alert-success mt-10">
        {{ session()->get('message') }}
    </div>
@endif
<div style="padding-top: 71px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Khối lượng công việc<br>
                        <a href="{{route('admin.pi.update',$pi_id)}}">
                            <button type="button" name="button" class="btn btn-xs btn-success">Thêm</button>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-sm-6">
                            <form class="form-horizontal" action="{{route('admin.pi.workload.index',$pi_id)}}" method="get">
                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <label class="control-label">Tìm kiếm</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="search" placeholder="Nhập mã hoặc tên nv/khoa/môn.">


                                    </div>
                                </div>
                                @if($search !="")
                                <div class="col-sm-12 mt-10">
                                    <div class="col-sm-3">
                                        <label class="control-label">Tìm theo </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="control-label text-al">
                                            <a data-toggle="tooltip" data-placement="right" title=""
                                                data-original-title="Xóa" href="javascript:" class="search_tag tooltip-test">
                                                <span class="badge badge-primary">{{$search}}
                                                    <span class="mdi mdi-close"></span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @endif

                                <div class="col-sm-12 mt-10">
                                    <div class="col-sm-3">
                                        <label class="control-label">Năm học</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="form-control year_workload" name="year_workload">
                                                @foreach($workload_session as $item)
                                                @if($year_workload == null)
                                                @if($item->id == $workload_session_current->id)
                                                <option selected value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}} ( Hiện tại ) </option>

                                                @else
                                                <option value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}}</option>
                                                @endif
                                                @else
                                                @if($item->id == $workload_session_current->id)
                                                <option selected value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}} ( Hiện tại ) </option>

                                                @else
                                                @if($item->id == $year_workload)
                                                <option selected value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}}</option>
                                                @else
                                                <option value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}}</option>

                                                @endif
                                                @endif
                                                @endif

                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">Tìm</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="form-group col-sm-4">

{{--
                            <form class="form-horizontal" action="{{route('admin.pi.import')}}" id="pi-import-form"
                                method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-sm-12">
                                    <label for="import_file" class="control-label col-sm-4">
                                        <a href="{{route('admin.pi.template.download')}}" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Tải file mẫu" class="tooltip-test">
                                            Import
                                        </a>
                                    </label>
                                    <div class="col-sm-8">

                                        <input required type="file" id="excel-import" name="import_file" class="custom-file-input excel-default col-sm-4">
                                        <button type="submit" id="btn-import-submit" class="btn btn-danger col-sm-6">Xác
                                            nhận</button>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        {{-- Loading Div --}}

                        {{-- Modal Import --}}
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                            aria-hidden="true" id="pi-import-modal">

                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="header-modal"></h4>
                                        <br>
                                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab"
                                                    data-toggle="tab" aria-controls="home" aria-expanded="false">Sheet1</a></li>
                                            <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab"
                                                    data-toggle="tab" aria-controls="profile" aria-expanded="true">Sheet2</a></li>

                                        </ul>
                                    </div>
                                    <div class="modal-body">
                                        <div id="myTabContent" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in" id="home"
                                                aria-labelledby="home-tab">
                                                <div class="table-responsive table-wrapper-scroll-y">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr class="heading-table">

                                                            </tr>
                                                        </thead>
                                                        <tbody class="row-table">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                                <div class="table-responsive table-wrapper-scroll-y">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr class="heading-table-2">

                                                            </tr>
                                                        </thead>
                                                        <tbody class="row-table-2">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="btn-pi-yes">Tải lên</button>
                                        <button type="button" class="btn btn-default" id="btn-pi-no">Hủy bỏ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" style="margin-bottom:0">
                            <thead>
                                <tr>

                                    <th>Mã NV</th>
                                    <th>Họ Tên</th>
                                    <th>Khoa</th>
                                    <th>Mã - Tên môn học</th>
                                    <th>Số tiết</th>
                                    <th>Học kỳ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($workloads->count() >0)
                                @foreach ($workloads as $item)
                                <tr>
                                    <td class="col-sm-1">

                                        <a href="{{route('admin.workload.list',$item->id)}}" data-toggle="tooltip"
                                            data-placement="right" title="" data-original-title="Chi tiết" href="javascript:"
                                            class="search_tag tooltip-test">
                                            <span class="badge badge-danger">{{$item->pi->employee_code}}
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="col-sm-2">{{$item->pi->full_name}}</td>
                                    <td class="col-sm-1">{{$item->unit->unit_code}}</td>
                                    <td class="col-sm-3">{{$item->subject_code}} - {{$item->subject_name }}</td>
                                    <td class="col-sm-2">{{$item->number_of_lessons}}</td>
                                    <td class="col-sm-1">{{$item->semester}}</td>
                                    <td class="col-sm-1">
                                        <a href="{{route('admin.workload.update',$item->id)}}" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Cập nhật" href="javascript:"
                                            class="tooltip-test">
                                            <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                        <a href="{{route('admin.workload.delete',$item->id)}}" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Xóa" class="delete_workload tooltip-test ml-10">
                                            <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>

                                </tr>
                                {{--modal delete workload--}}

                                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                    aria-hidden="true" id="pi-delete-modal">

                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa workload
                                                    này ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                                <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">

                        {{$workloads->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
