@extends('employee.master')
@section('title','khối lượng NCKH')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li class="active">Khối lượng NCKH</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
@include('employee.layouts.Error')
@if(session()->has('message'))
<div class="alert alert-success mt-10">
    {{ session()->get('message') }}
</div>
@endif
<div style="padding-top: 21px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Khối lượng NCKH<br>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('employee.srworkload.index',$pi->id)}}" method="get">
                            <div class="form-group col-sm-6">

                                <div class="col-sm-12">
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
                    </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover" style="margin-bottom:0">
                            <thead>
                                <th>Công việc</th>
                                <th>Chi tiết</th>
                                <th>Diễn giải (tên cụ thể của hoạt động NCKH, …)</th>
                                <th>Đơn vị (đề tài, bài báo, tài liệu, giáo trình...)</th>
                                <th>Số lượng</th>
                                <th>Quy đổi giờ chuẩn</th>
                                <th>Số tiết/giờ quy đổi</th>
                                <th>Ghi chú</th>
                            </thead>

                            <tbody>
                                @if($workloads->count() >0)
                                <tr>
                                    @foreach ($workloads as $item)
                                    <td>

                                        <a href="{{route('employee.srworkload.detail',$item->id)}}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Chi tiết" href="javascript:" class="search_tag tooltip-test">
                                            <span class="badge badge-danger">{{$item->name_of_work}}
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{$item->detail_of_work}}</td>
                                    <td>{{$item->explain_of_work}}</td>
                                    <td>{{$item->unit_of_work}}</td>
                                    <td>{{$item->quantity_of_work}}</td>
                                    <td>{{$item->converted_standard_time}}</td>
                                    <td>{{$item->converted_time}}</td>
                                    <td>{{$item->note}}</td>
                                    @endforeach

                                </tr>
                                @else
                                <tr>
                                        <td colspan="8" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
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
