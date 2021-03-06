@extends('admin.master')
@section('title','Cập nhật khối lượng giảng dạy')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class=""><a href="{{route('admin.workload.index')}}">Quản lý khối lượng giảng dạy</a></li>
                 <li class="active">Cập nhật khối lượng giảng dạy - {{$workload->pi->employee_code}}</li>
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
    <div class="panel-heading">Cập Nhật Khối Lượng Giảng Dạy</div>
    <div class="panel-body">
        <form class="form-horizontal" action="{{route('admin.workload.update',$workload->id)}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Mã nhân viên <span style="color: red">*</span> </label>
                    <input type="text" readonly class="form-control" name="employee_code" value="{{$pi->employee_code}}">
                </div>
                <div class="col-sm-6">
                    <label>Học kỳ <span style="color: red">*</span> </label>
                    <select required name="semester" class="form-control">
                        <option value="">Chọn Học Kì</option>
                        @foreach($se as $semester)
                        @if(old('semester'))
                        <option {{old('semester') == $semester->id ? 'selected' : ''}} value="{{$semester->id}}">{{$semester->name}}</option>
                        @else
                        <option {{$workload->semester_id == $semester->id ? 'selected' : ''}} value="{{$semester->id}}">{{$semester->name}}</option>

                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Năm học <span style="color: red">*</span> </label>
                    <div class="radio">
                        @if(!is_null(old('session_new')))
                        <label class="col-sm-6">
                                <input required type="radio" {{old('session_new') == 0 ? "checked":""}} name="session_new" value="0">Chọn từ danh sách
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" {{old('session_new') == 1 ? "checked":""}} name="session_new" value="1">Tạo mới năm học
                            </label>
                        @else
                        <label class="col-sm-6">
                                <input required type="radio" checked name="session_new" value="0">Chọn từ danh sách
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="session_new" value="1">Tạo mới năm học
                            </label>
                        @endif
                        
                    </div>
                </div>
                <div class="session_list col-sm-6">
                    <label>Năm học <span style="color: red">*</span> </label>
                    <select class="form-control" name="session_id">
                        <option value="">Chọn Năm Học</option>
                        @foreach($ws as $session)
                        @if(old('session_id'))
                        <option {{old('session_id') == $session->id ? "selected":""}} value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}</option>

                        @else
                        <option {{$workload->session_id == $session->id ? "selected":""}} value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}</option>

                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="session_new col-sm-6 hide">
                    <label>Tạo mới năm học <span style="color: red">*</span></label>
                    <div class="form-horizontal">
                        <div class="col-sm-6 form-horizontal-none-pl">
                            <input type="number" class="form-control" name="start_year" placeholder="Nhập năm bắt đầu"
                                value="{{old('start_year')}}">

                        </div>

                        <div class="col-sm-6 form-horizontal-none-pl">
                            <input type="number" class="form-control" name="end_year" placeholder="Nhập năm Kết thúc"
                                value="{{old('end_year')}}">

                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Mã môn học <span style="color: red">*</span> </label>
                    <input required type="text" maxlength="60" class="form-control" name="subject_code" placeholder="Nhập mã môn học"
                        value="{{old('subject_code',$workload->subject_code)}}">
                </div>

                <div class="col-sm-6">
                    <label>Tên môn học <span style="color: red">*</span> </label>
                    <input required type="text" maxlength="60" class="form-control" name="subject_name" placeholder="Nhập tên môn học"
                        value="{{old('subject_name',$workload->subject_name)}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số tiết/giờ <span style="color: red">*</span> </label>
                    <input required type="text" maxlength="60" class="form-control" name="number_of_lessons"
                        placeholder="Nhập số tiết/giờ" value="{{old('number_of_lessons',$workload->number_of_lessons)}}">
                </div>
                <div class="col-sm-6">
                    <label>Mã lớp <span style="color: red">*</span> </label>
                    <input required type="text" maxlength="100" class="form-control" name="class_code" placeholder="Nhập mã lớp"
                        value="{{old('class_code',$workload->class_code)}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số sinh viên <span style="color: red">*</span> </label>
                    <input required type="number" min="0" max="100000" class="form-control" name="number_of_students"
                        placeholder="Nhập số sinh viên" value="{{old('number_of_students',$workload->number_of_students)}}">
                </div>
                <div class="col-sm-6">
                    <label>Quy đổi giờ chuẩn<span style="color: red">*</span> </label>
                    <input required type="number" min="0" max="100000" class="form-control" name="total_workload" placeholder="Nhập quy đổi giờ chuẩn"
                        value="{{old('total_workload',$workload->total_workload)}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Số giờ lý thuyết <span style="color: red">*</span> </label>
                    <input required type="number" step="0.1" min="0" max="100000" class="form-control" name="theoretical_hours" placeholder="Nhập số giờ lý thuyết"
                        value="{{old('theoretical_hours',$workload->theoretical_hours)}}">
                </div>
                <div class="col-sm-6">
                    <label>Số giờ thực hành <span style="color: red">*</span> </label>
                    <input required type="number" step="0.1" min="0" max="100000" class="form-control" name="practice_hours" placeholder="Nhập số giờ thực hành"
                        value="{{old('practice_hours',$workload->practice_hours)}}">
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label>Khoa <span style="color: red">*</span> </label>
                    <select required class="form-control" name="unit_id">
                        <option value="">Chọn Khoa</option>
                        @foreach($unit as $uni)
                        @if(old('unit_id'))
                        <option {{old('unit_id')== $uni->id ? 'selected':''}} value="{{$uni->id}}">{{$uni->name}}</option>
                        @else
                        <option {{$pi->unit_id == $uni->id ? 'selected':''}} value="{{$uni->id}}">{{$uni->name}}</option>

                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control" name="note" placeholder="Nhập Ghi chú nếu có" value="{{old('note',$workload->note)}}">
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
                if ($('input[type=radio][name=session_new]:checked').val() == 0) {
                        $('.session_list').removeClass('hide');
                        $('.session_new').addClass('hide');
                    }
                    else if ($('input[type=radio][name=session_new]:checked').val() == 1) {
                        $('.session_list').addClass('hide');
                        $('.session_list ').val('');
                        $('.session_new').removeClass('hide');
                    }
            });
        </script>
    @endsection
