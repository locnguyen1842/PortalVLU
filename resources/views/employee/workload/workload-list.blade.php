@extends('employee.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                <li class="active">Khối lượng công việc</li>
            </ol>
        </div>
    </div>
@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="nav-tabs-container">
                <ul class="nav nav-tabs">
                    <li class="{{url()->current() == route('employee.pi.detail') ? 'active':''}}"><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                    <li class="{{url()->current() == route('employee.workload.index') ? 'active':''}}"><a href="{{route('employee.workload.index')}}">Khối lượng công việc</a></li>
                </ul>
            </div>
        </div>
</nav>
@endsection
@section('content')
@include('employee.layouts.Error')
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
                    </div>
                    <div class="panel-body">
                    <form class="form-horizontal" action="{{route('employee.workload.index',$pi->id)}}" method="get">
                        <div class="form-group col-sm-6">

                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <label class="control-label">Tìm kiếm</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="search" placeholder="Nhập mã hoặc tên khoa/môn.">


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


                        </div>
                        <div class="form-group col-sm-6">
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Học kỳ
                                    </label>
                                    <div class="col-sm-8">
                                            <select class="form-control semester" name="semester">
                                                <option value="4" selected>Cả năm</option>
                                                @foreach($semester as $item)
                                                <option {{$semester_filter == $item->alias ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>

                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
                    <div class="table-responsive">
                        <table class="table table-hover" style="margin-bottom:0">
                            <thead>
                                <tr>

                                    <th></th>
                                    <th>Khoa</th>
                                    <th>Mã - Tên môn học</th>
                                    <th>Khối lớp</th>
                                    <th>Số tiết</th>
                                    <th>Học kỳ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($workloads->count() >0)
                                @foreach ($workloads as $item)
                                <tr>
                                    <td class="col-sm-1">

                                        <a href="{{route('employee.workload.detail',$item->id)}}" data-toggle="tooltip"
                                            data-placement="right" title="" data-original-title="Chi tiết" href="javascript:"
                                            class="search_tag tooltip-test">
                                            <span class="badge badge-danger">Chi tiết
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="col-sm-1">{{$item->unit->unit_code}}</td>
                                    <td class="col-sm-3">{{$item->subject_code}} - {{$item->subject_name }}</td>
                                    <td class="col-sm-1">{{$item->class_code}}</td>

                                    <td class="col-sm-1">{{$item->number_of_lessons}}</td>
                                    <td class="col-sm-1">{{$item->semester->alias}}</td>


                                </tr>



                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm
                                        thấy</td>
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
    <script type="text/javascript">
        $(document).ready(function() {

            $(".search_tag").on('click', function() {
                var url = {!!json_encode(route('employee.workload.index'), JSON_UNESCAPED_SLASHES) !!};
                var session_id = $('.year_workload').val();
                var semester = $('.semester').val();
                var search = "";
                window.location.href = url + '?year_workload=' + session_id+'&semester='+semester;
            });
        });
    </script>
    @endsection
