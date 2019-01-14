@extends('admin.master')
@section('title','Thêm khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.workload.index')}}">Quản lý khối lượng công việc</a></li>
                <li class="active">Thêm khối lượng công việc</li>
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
    <div style="padding-top:20px">
        <div class="cm-fix-height"  id="parent_content">
            <form id="add-workload" class="form-horizontal" action="{{route('admin.workload.add')}}" method="post">
                <div class=" col-sm-9">

                    <div class="panel panel-default">
                        <div class="panel-heading">Thêm Khối Lượng Công Việc</div>
                        <div class="panel-body">

                            {{csrf_field()}}

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Mã nhân viên</label>
                                    <input {{$pi != null ? 'readonly' : ''}} type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{$pi != null ? $pi->employee_code : ''}}">
                                </div>
                                <div class="col-sm-6">
                                    <label>Khoa</label>
                                    @if($pi != null)
                                        <input readonly type="text" class="form-control" name="unit_id"  value="{{$pi != null ? $pi->unit->name : ''}}">
                                    @else

                                        <select  class="form-control" selected name="unit_id">
                                            <option value="">Chọn Khoa</option>
                                            @foreach($unit as $uni)
                                                <option  value="{{$uni->id}}">{{$uni->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Năm học</label>
                                    <div class="radio">
                                        <label class="col-sm-6">
                                            <input  type="radio" checked name="session_new" value="0">Chọn từ danh sách
                                        </label>
                                        <label class="col-sm-6">
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
                                                   value="">

                                        </div>

                                        <div class="col-sm-6 form-horizontal-none-pl">
                                            <input type="text" class="form-control" name="end_year" placeholder="Nhập năm Kết thúc"
                                                   value="">

                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                    <div id="block">
                        <div class="panel-append">
                            <div class="count-panel">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        Thông Tin Môn Học
                                        <button type="button" class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Mã Môn Học</label>
                                                <input  type="text" class="form-control" name="subject_code[]" placeholder="Nhập mã môn học"
                                                       value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Tên Môn Học</label>
                                                <input required type="text" maxlength="60" class="form-control" name="subject_name[]" placeholder="Nhập Tên môn học"
                                                       value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Số tiết học</label>
                                                <input type="text" class="form-control" name="number_of_lessons[]" placeholder="Nhập số tiết học trong năm"
                                                       value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Mã Lớp</label>
                                                <input type="text" maxlength="100" class="form-control" name="class_code[]" placeholder="Nhập mã Lớp"
                                                       value="">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Số Sinh Viên</label>
                                                <input  type="text" maxlength="100" class="form-control" name="number_of_students[]"
                                                       placeholder="Nhập số sinh viên" value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Tổng Khối Lượng công việc</label>
                                                <input type="text" maxlength="100" class="form-control" name="total_workload[]" placeholder="Nhập địa chỉ liên lạc"
                                                       value="">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Số Giờ Lý Thuyết</label>
                                                <input required type="text" class="form-control" name="theoretical_hours[]" placeholder="Nhập số giờ lý thuyết"
                                                       value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Số Giờ Thực Hành</label>
                                                <input type="text" class="form-control" name="practice_hours[]" placeholder="Nhập số giờ thực hành"
                                                       value="">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label>Học kỳ </label>
                                                <select name="semester[]" class="form-control">
                                                    <div class="session_list col-sm-6">
                                                        <option value="">Chọn Học Kì</option>
                                                        @foreach($se as $semester)
                                                            <option value="{{$semester->id}}">{{$semester->name}}</option>
                                                        @endforeach
                                                    </div>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Ghi Chú</label>
                                                <input type="text" class="form-control" name="note[]" placeholder="Nhập Ghi chú nếu có" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class=" col-sm-3 " id="sticky">
                    <div class="panel panel-default"  >
                        <div class="panel-heading">Thao tác</div>
                        <div class="panel-body">
                            <div class="form-group col-sm-12">
                                <button type="button" class="btn_append btn btn-success btn-block">Thêm Môn Học</button>
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="{{asset('js/scrollfix.js')}}"></script>


    <script>
        $("#sticky").scrollFix({
            topPosition: 71,

        });
        $(document).ready(function(){
            $('input[type=radio][name=session_new]').change(function() {
                if (this.value == 0) {
                    $('.session_list').removeClass('hide');
                    $('.session_new').addClass('hide');
                }
                else if (this.value == 1) {
                    $('.session_list').addClass('hide');
                    $('.session_list select').val('');

                    $('.session_new').removeClass('hide');
                }
            });

            $('.btn_append').on('click', function() {
                var form = $('.panel-append').html();
                $('#block').append(form);
                $('button[class=close]').on('click',function () {
                    if($('.count-panel').length != 1){

                        ($(this).parent().parent().parent().remove());
                    }
                });

            });

        });
    </script>
@endsection
