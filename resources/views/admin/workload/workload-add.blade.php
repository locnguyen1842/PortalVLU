@extends('admin.master')
@section('title','Thêm khối lượng công việc')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.workload.index')}}">Quản lý khối lượng công việc</a></li>
                <li class="active">Thêm khối lượng công việc</li>
            </ol>
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
<div class="panel panel-default">
    <div class="panel-heading">Thêm Khối Lượng Công Việc</div>
    <div class="panel-body">
        <form class="form-horizontal" action="{{route('admin.workload.add')}}" method="post">
            {{csrf_field()}}

            <div class="form-group">
                <div class="col-sm-6">
                    <label>Mã nhân viên</label>
                    <input type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{old('employee_code')}}">
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Học kỳ </label>
                        <select name="semester" class="form-control">
                            <option value="">Chọn Học Kỳ</option>
                            <option value="1">
                                Học kỳ 1
                            </option>
                            <option value="2">
                                Học kỳ 2
                            </option>
                            <option value="3">
                                Học Kỳ 3
                            </option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Năm học</label>
                    <div class="radio">
                        <label class="col-sm-6">
                            <input required type="radio" checked name="session_new" value="0">Chọn từ danh sách
                        </label>
                        <label class="col-sm-4">
                            <input required type="radio" name="session_new" value="1">Tạo mới năm học
                        </label>
                    </div>
                </div>
                <div class="session_list col-sm-6">
                    <label>Năm học</label>
                    <select class="form-control" name="session_id">
                        <option value="">Chọn Năm Học</option>
                        @foreach($ws as $session)
                        <option value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="session_new col-sm-6 hide">
                    <label>Tạo mới năm học</label>
                    <div class="form-horizontal">
                        <div class="col-sm-6 form-horizontal-none-pl">
                            <input type="text" class="form-control" name="start_year" placeholder="Nhập năm bắt đầu"
                                value="{{old('start_year')}}">

                        </div>

                        <div class="col-sm-6 form-horizontal-none-pl">
                            <input type="text" class="form-control" name="end_year" placeholder="Nhập năm Kết thúc"
                                value="{{old('start_year')}}">

                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Mã Môn Học</label>
                    <input required type="text" class="form-control" name="subject_code" placeholder="Nhập mã môn học"
                        value="{{old('subject_code')}}">
                </div>
                <div class="col-sm-6">
                    <label>Tên Môn Học</label>
                    <input required type="text" maxlength="60" class="form-control" name="subject_name" placeholder="Nhập Tên môn học"
                        value="{{old('subject_name')}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số tiết học</label>
                    <input required type="text" class="form-control" name="number_of_lessons" placeholder="Nhập số tiết học trong năm"
                        value="{{old('number_of_lessons')}}">
                </div>
                <div class="col-sm-6">
                    <label>Mã Lớp</label>
                    <input required type="text" maxlength="100" class="form-control" name="class_code" placeholder="Nhập mã Lớp"
                        value="{{old('class_code')}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số Sinh Viên</label>
                    <input required type="text" maxlength="100" class="form-control" name="number_of_students"
                        placeholder="Nhập số sinh viên" value="{{old('number_of_students')}}">
                </div>
                <div class="col-sm-6">
                    <label>Tổng Khối Lượng công việc</label>
                    <input required type="text" maxlength="100" class="form-control" name="total_workload" placeholder="Nhập địa chỉ liên lạc"
                        value="{{old('total_workload')}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số Giờ Lý Thuyết</label>
                    <input required type="text" class="form-control" name="theoretical_hours" placeholder="Nhập số gời lý thuyết"
                        value="{{old('theoretical_hours')}}">
                </div>
                <div class="col-sm-6">
                    <label>Số Giờ Thực Hành</label>
                    <input required type="text" class="form-control" name="practice_hours" placeholder="Nhập số giờ thực hành"
                        value="{{old('practice_hours')}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Ghi Chú</label>
                    <input type="text" class="form-control" name="note" placeholder="Nhập Ghi chú nếu có" value="{{old('note')}}">
                </div>
                <div class="col-sm-6">
                    <label>Đơn Vị</label>
                    <select required class="form-control" name="unit_id">
                        <option value="">Chọn Khoa</option>
                        @foreach($unit as $uni)
                        <option value="{{$uni->id}}">{{$uni->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group" style="margin-bottom:0">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                    <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('input[type=radio][name=session_new]').change(function() {
            if (this.value == 0) {
                $('.session_list').removeClass('hide');
                $('.session_new').addClass('hide');
            }
            else if (this.value == 1) {
                $('.session_list').addClass('hide');
                $('.session_new').removeClass('hide');
            }
        });
    });
</script>
@endsection
