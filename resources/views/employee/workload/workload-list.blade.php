@extends('employee.master')
@section('title','khối lượng giảng dạy')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li class="active">Khối lượng giảng dạy</li>
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
                    <div class="panel-heading">Khối lượng giảng dạy<br>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('employee.workload.index',$pi->id)}}" method="get">
                            <div class="form-group col-sm-6">

                                <div class="col-sm-12">
                                        <div class="col-sm-3">
                                                <label class="control-label">Năm học</label>
                                            </div>
                                            <div class="col-sm-9">
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
                                            </div>
                                </div>


                            </div>
                            <div class="form-group col-sm-6">
                                <div class="col-sm-12">
                                    <label class="control-label col-sm-4">Học kỳ
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                        <select class="form-control semester" name="semester">
                                            <option value="4" selected>Cả năm</option>
                                            @foreach($semester as $item)
                                            <option {{$semester_filter == $item->alias ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>

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
                                <th>Học Kỳ</th>
                                <th>STT</th>
                                <th>Môn Học</th>
                                <th>Khối lớp</th>
                                <th>Số tiết</th>
                                <th>Ghi Chú</th>
                            </thead>
                            @if($workloads->where('semester_id',1)->count() > 0)
                            <tbody>
                                <tr>
                                    <td rowspan="{{$workloads->where('semester_id',1)->count() + 1}}" class="table-rowspan">HK I</td>

                                </tr>
                                @foreach($workloads->where('semester_id',1) as $workload)
                                <tr>

                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$workload->subject_name}}</td>
                                    <td>{{$workload->class_code}}</td>
                                    <td>{{$workload->number_of_lessons}}</td>
                                    <td>{{$workload->note}}</td>
                                </tr>
                                @endforeach



                            </tbody>
                            {{-- @else
                            <tbody>
                                    <tr>
                                            <td class="table-rowspan">Hoc kỳ 1</td>
                                            <td colspan="5" class="text-ac">Không có dữ liệu nào được tìm thấy</td>

                                        </tr>
                                <tr>

                                </tr>
                            </tbody> --}}
                            @endif
                            @if($workloads->where('semester_id',2)->count() > 0)
                            <tbody>
                                <tr>
                                    <td rowspan="{{$workloads->where('semester_id',2)->count() + 1}}" class="table-rowspan">HK II</td>

                                </tr>
                                @foreach($workloads->where('semester_id',2) as $key=>$workload)
                                <tr>

                                    <td>{{($loop->iteration)}}</td>
                                    <td>{{$workload->subject_name}}</td>
                                    <td>{{$workload->class_code}}</td>
                                    <td>{{$workload->number_of_lessons}}</td>
                                    <td>{{$workload->note}}</td>
                                </tr>
                                @endforeach


                            </tbody>


                            @endif
                            @if($workloads->where('semester_id',3)->count() > 0)
                            <tbody>
                                    <tr>
                                        <td rowspan="{{$workloads->where('semester_id',3)->count() + 1}}" class="table-rowspan">HK III</td>

                                    </tr>
                                    @foreach($workloads->where('semester_id',3) as $key=>$workload)
                                    <tr>

                                        <td>{{($loop->iteration)}}</td>
                                        <td>{{$workload->subject_name}}</td>
                                        <td>{{$workload->class_code}}</td>
                                        <td>{{$workload->number_of_lessons}}</td>
                                        <td>{{$workload->note}}</td>
                                    </tr>
                                    @endforeach


                                </tbody>

                            @endif
                            <tfoot>
                                <tr>
                                <td colspan="4" class="text-ac font-weight-bold">Tổng số tiết giảng dạy năm học {{$year_workload == null ?$workload_session_current->start_year : App\WorkloadSession::find($year_workload)->start_year}} - {{$year_workload == null ?$workload_session_current->end_year : App\WorkloadSession::find($year_workload)->end_year}}</td>
                                    <td class="font-weight-bold">{{$workloads->sum('number_of_lessons')}}</td>
                                    <td></td>
                                </tr>

                            </tfoot>

                        </table>


                    </div>
                    <div class="panel-footer">

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
