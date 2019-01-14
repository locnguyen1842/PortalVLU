@extends('admin.master')
@section('title','Cập nhật khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.workload.index')}}">Quản lý khối lượng công việc</a></li>
                 <li class="active">Cập nhật khối lượng công việc - {{$workload->pi->employee_code}}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
@include('admin.layouts.Error')
@if(session()->has('message'))
<div class="alert alert-success mt-10">
    {{ session()->get('message') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">Cập Nhật Khối Lượng Công Việc</div>
    <div class="panel-body">
        <form class="form-horizontal" action="{{route('admin.workload.update',$workload->id)}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Mã nhân viên</label>
                    <input type="text" readonly class="form-control" name="Mã nhân viên" value="{{$pi->employee_code}}">
                </div>
                <div class="col-sm-6">
                    <label>Học kỳ </label>
                    <select required name="semester" class="form-control">
                        <option value="">Chọn Học Kì</option>
                        @foreach($se as $semester)
                            <option {{$workload->semester_id == $semester->id ? 'selected' : ''}} value="{{$semester->id}}">{{$semester->name}}</option>
                        @endforeach
                    </select>
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
                        <option {{$workload->session_id == $session->id ? "selected":""}} value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}</option>
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
                    <label>Mã môn học</label>
                    <input required type="text" maxlength="60" class="form-control" name="subject_code" placeholder="Nhập mã môn học"
                        value="{{$workload->subject_code}}">
                </div>

                <div class="col-sm-6">
                    <label>Tên môn học</label>
                    <input required type="text" maxlength="60" class="form-control" name="subject_name" placeholder="Nhập tên môn học"
                        value="{{$workload->subject_name}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số tiết học</label>
                    <input required type="text" maxlength="60" class="form-control" name="number_of_lessons"
                        placeholder="Nhập số tiết học trong năm" value="{{$workload->number_of_lessons}}">
                </div>
                <div class="col-sm-6">
                    <label>Mã lớp</label>
                    <input required type="text" maxlength="100" class="form-control" name="class_code" placeholder="Nhập mã Lớp"
                        value="{{$workload->class_code}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số sinh viên</label>
                    <input required type="text" maxlength="100" class="form-control" name="number_of_students"
                        placeholder="Nhập số sinh viên" value="{{$workload->number_of_students}}">
                </div>
                <div class="col-sm-6">
                    <label>Tổng số giờ</label>
                    <input required type="text" maxlength="100" class="form-control" name="total_workload" placeholder="Nhập địa chỉ liên lạc"
                        value="{{$workload->total_workload}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số giờ lý thuyết</label>
                    <input required type="text" class="form-control" name="theoretical_hours" placeholder="Nhập số gời lý thuyết"
                        value="{{$workload->theoretical_hours}}">
                </div>
                <div class="col-sm-6">
                    <label>Số giờ thực hành</label>
                    <input required type="text" class="form-control" name="practice_hours" placeholder="Nhập số giờ thực hành"
                        value="{{$workload->practice_hours}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Đơn vị</label>
                    <select required class="form-control" name="unit_id">
                        <option value="">Chọn Khoa</option>
                        @foreach($unit as $uni)
                        <option {{$pi->unit_id == $uni->id ? 'selected':''}} value="{{$uni->id}}">{{$uni->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control" name="note" placeholder="Nhập Ghi chú nếu có" value="{{$workload->note}}">
                </div>

            </div>

            <div class="form-group" style="margin-bottom:0">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                    <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
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
                        $('.session_list ').val('');
                        $('.session_new').removeClass('hide');
                    }
                });
            });
        </script>
    @endsection
