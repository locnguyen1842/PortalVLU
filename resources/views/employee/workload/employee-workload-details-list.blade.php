@extends('employee.master')
@section('title','Danh sách công việc')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('employee.workload.index')}}">Quản lý khối lượng công việc</a></li>
                <li class="active">Danh sách khối lượng công việc</li>
            </ol>
        </div>
    </div>
</nav>
@endsection
@section('content')
<div id="" style="padding-top: 20px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-7">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin môn học <br>
                            {{-- <a href="{{route('employee.workload.update',$workload->id)}}">
                                <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                            </a> --}}
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="{{route('employee.workload.detail',$workload->id)}}" method="get">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3  ">Mã môn học</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->subject_code}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Tên môn học</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->subject_name}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Số tiết học</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->number_of_lessons}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Mã lớp học</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->class_code}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Số lượng sinh viên</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->number_of_students}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Tổng khối lượng công việc</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->total_workload}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Số giờ lý thuyết</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->theoretical_hours}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3  ">Số giờ thực hành</label>
                                    <span for="" class="col-sm-9 text-nowrap">{{$workload->practice_hours}}</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin thêm <br>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-3  ">Học kỳ</label>
                                  <span for="" class="col-sm-9 text-nowrap">{{$workload->semester}}</span>
                              </div>
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-3  ">Niên khóa</label>
                                  <span for="" class="col-sm-9 text-nowrap">{{$workload->workloadsession->start_year}}-{{$workload->workloadsession->end_year}}</span>
                              </div>
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-3  ">Đơn vị</label>
                                  <span for="" class="col-sm-9 text-nowrap">{{$workload->unit->name}}</span>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".delete_degree").on('click', function(e) {
            e.preventDefault(); //huy bo thao tac mac dinh.
            $("#degree-delete-modal").modal('show'); //show cai div co id pi-delete-modal
            var delete_pi_form = $(this).attr('href'); //lay gia tri href cua class delete_degree
            var modalConfirm = function(callback) {
                //khi nhan nut yes
                $("#btn-pd-yes").on("click", function() {
                    callback(true);
                    $("#degree-delete-modal").modal('hide');
                });
                //khi nhan nut no
                $("#btn-pd-no").on("click", function() {
                    callback(false);
                    $("#degree-delete-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm) {
                if (confirm) {
                    //khi nhan nut yes
                    //thuc hien chuyen tiep den url delete_pi_form = $(this).attr('href');
                    window.location.href = delete_pi_form;

                } else {

                }
            });
        });
    });
</script>
@endsection
