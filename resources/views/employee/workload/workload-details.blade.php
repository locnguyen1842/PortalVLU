@extends('employee.master')
@section('title','Chi tiết khối lượng giảng dạy')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                <li class=""><a href="{{route('employee.workload.index')}}">Khối lượng giảng dạy</a></li>
                <li class="active">Chi tiết khối lượng giảng dạy</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
<div id="" style="padding-top: 20px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-7">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin môn học <br>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="{{route('employee.workload.detail',$workload->id)}}" method="get">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-5  ">Mã môn học</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->subject_code}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Tên môn học</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->subject_name}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Khối lớp</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->class_code}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số lượng sinh viên</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->number_of_students}} sinh viên</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số tiết học</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->number_of_lessons}} tiết</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Tổng khối lượng công việc</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->total_workload}} giờ</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số giờ lý thuyết</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->theoretical_hours}} giờ</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số giờ thực hành</label>
                                    <span for="" class="col-sm-7 text-truncate">{{$workload->practice_hours}} giờ</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin giảng viên<br>
                        </div>
                        <div class="panel-body">
                                <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4">Mã nv</label>
                                            <span for="" class="col-sm-8 text-truncate">{{$workload->pi->employee_code}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4">Họ tên</label>
                                            <span for="" class="col-sm-8 text-truncate">{{$workload->pi->full_name}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4">Khoa</label>
                                            <span for="" class="col-sm-8 text-truncate">{{$workload->pi->unit->name}}</span>
                                        </div>
                                        </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin khai giảng <br>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4">Học kỳ</label>
                                  <span for="" class="col-sm-8 text-truncate">{{$workload->semester->alias}}</span>
                              </div>
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4">Niên khóa</label>
                                  <span for="" class="col-sm-8 text-truncate">{{$workload->workloadsession->start_year}}-{{$workload->workloadsession->end_year}}</span>
                              </div>
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-4">Khoa</label>
                                  <span for="" class="col-sm-8 text-truncate">{{$workload->unit->name}}</span>
                              </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
