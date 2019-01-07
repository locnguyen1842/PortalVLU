@extends('employee.master')
@section('title','Cập nhật khối lượng công việc')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="#">Quản lý khối lượng công việc</a></li>
                <li class="active">Cập nhật khối lượng công việc</li>
            </ol>
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
    <div class="panel panel-default">
        <div class="panel-heading">Cập nhật khối lượng công việc</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('employee.workload.update',$workload->id)}}" method="post">
                {{csrf_field()}}
                
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã Môn Học</label>
                        <input required type="text" maxlength="60" class="form-control" name="subject_code" placeholder="Nhập mã môn học" value="{{$workload->subject_code}}">
                    </div>

                    <div class="col-sm-6">
                        <label>Tên Môn Học</label>
                        <input required type="text" maxlength="60" class="form-control" name="subject_name" placeholder="Nhập tên môn học" value="{{$workload->subject_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số tiết học</label>
                        <input required type="text" maxlength="60" class="form-control" name="number_of_lessons" placeholder="Nhập số tiết học trong năm" value="{{$workload->number_of_lessons}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Mã Lớp</label>
                        <input required type="text" maxlength="100" class="form-control" name="class_code" placeholder="Nhập mã Lớp" value="{{$workload->class_code}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số Sinh Viên</label>
                        <input required type="text" maxlength="100" class="form-control" name="number_of_students" placeholder="Nhập số sinh viên" value="{{$workload->number_of_students}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Tổng Khối Lượng công việc</label>
                        <input required type="text" maxlength="100" class="form-control" name="total_workload" placeholder="Nhập địa chỉ liên lạc" value="{{$workload->total_workload}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số Giờ Lý Thuyết</label>
                        <input required type="text" class="form-control" name="theoretical_hours" placeholder="Nhập số gời lý thuyết" value="{{$workload->theoretical_hours}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Số Giờ Thực Hành</label>
                        <input required type="text" class="form-control" name="practice_hours" placeholder="Nhập số giờ thực hành" value="{{$workload->practice_hours}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ghi Chú</label>
                        <input required type="text" class="form-control" name="note" placeholder="Nhập Ghi chú nếu có" value="{{$workload->note}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Đơn Vị</label>
                        <select required class="form-control" name="unit_id">
                            <option value="">Chọn Khoa</option>
                            @foreach($unit as $uni)
                            <option {{$pi->unit_id == $uni->id ? 'selected':''}} value="{{$uni->id}}">{{$uni->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Học kỳ </label>
                        <select required name="semester" class="form-control">
                            <option value="">Chọn Học Kỳ</option>
                            <option value="1" {{$workload->semester ==1 ? "selected":""}}>1</option>
                            <option value="2" {{$workload->semester ==2 ? "selected":""}}>2</option>
                            <option value="3" {{$workload->semester ==3 ? "selected":""}}>3</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Niên Khóa</label>
                        <select required class="form-control" name="session_id">
                            <option value="">Chọn Niên Khóa</option>
                            @foreach($ws as $session)
                            <option {{$workload->session_id == $session->id ? 'selected':''}} value="{{$session->id}}">{{$session->start_year}} - {{$session->end_year}}</option>
                            @endforeach
                        </select>
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
    @endsection
