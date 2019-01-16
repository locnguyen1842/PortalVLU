@extends('admin.master')
@section('title','Thêm khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
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
    <form id="add-workload" class="form-horizontal" action="{{route('admin.workload.add')}}" method="post">
        <div class="cm-fix-height" id="parent_content">

            <div class=" col-sm-9">

                <div class="panel panel-default">
                    <div class="panel-heading">Thêm Khối Lượng Công Việc</div>
                    <div class="panel-body">

                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Mã nhân viên <span style="color: red">*</span> </label>
                                <input id="employee_code" required {{$pi != null ? 'readonly' : ''}} type="text" class="form-control" name="employee_code"
                                   autocomplete="off" placeholder="Nhập mã nhân viên" value="{{$pi != null ? $pi->employee_code : old('employee_code')}}">
                            </div>


                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Năm học <span style="color: red">*</span></label>
                                <div class="radio">
                                    <label class="col-sm-6">
                                        <input {{old('session_new') == '0' ? 'checked' : ''}} checked required type="radio"
                                            name="session_new" value="0">Chọn từ danh sách
                                    </label>
                                    <label class="col-sm-6">
                                        <input required type="radio" {{old('session_new') == '1' ? 'checked' : ''}}
                                            name="session_new" value="1">Tạo mới năm học
                                    </label>
                                </div>
                            </div>
                            <div class="session_list col-sm-6">
                                <label>Năm học <span style="color: red">*</span></label>
                                <select class="form-control" name="session_id">
                                    <option value="">Chọn Năm Học</option>
                                    @foreach($ws as $session)
                                    <option {{old('session_id') == $session->id ? 'selected' : ''}} value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="session_new col-sm-6 hide">
                                <label>Tạo mới năm học <span style="color: red">*</span></label>
                                <div class="form-horizontal">
                                    <div class="col-sm-6 form-horizontal-none-pl">
                                        <input type="text" class="form-control" name="start_year" placeholder="Nhập năm bắt đầu"
                                            value="{{old('start_year')}}">

                                    </div>

                                    <div class="col-sm-6 form-horizontal-none-pl">
                                        <input type="text" class="form-control" name="end_year" placeholder="Nhập năm Kết thúc"
                                            value="{{old('end_year')}}">

                                    </div>

                                </div>
                            </div>


                        </div>


                    </div>
                </div>

                <div id="block">
                    <div class="panel-append" id="panel-append">
                        @if( old('count_panel') !=null)
                        @for ($i = 0; $i < old('count_panel'); $i++)
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
                                                    <label>Mã Môn Học <span style="color: red">*</span></label>
                                                    <input required type="text" class="form-control" name="subject_code[]" placeholder="Nhập mã môn học"
                                                        value="{{old('subject_code.'.$i)}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Tên Môn Học <span style="color: red">*</span></label>
                                                    <input required type="text" maxlength="60" class="form-control" name="subject_name[]"
                                                        placeholder="Nhập Tên môn học" value="{{old('subject_name.'.$i)}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Số tiết học <span style="color: red">*</span></label>
                                                    <input required type="text" class="form-control" name="number_of_lessons[]"
                                                        placeholder="Nhập số tiết học trong năm" value="{{old('number_of_lessons.'.$i)}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Mã Lớp <span style="color: red">*</span></label>
                                                    <input required type="text" maxlength="100" class="form-control" name="class_code[]"
                                                        placeholder="Nhập mã Lớp" value="{{old('class_code.'.$i)}}">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Số Sinh Viên <span style="color: red">*</span></label>
                                                    <input required type="text" maxlength="100" class="form-control" name="number_of_students[]"
                                                        placeholder="Nhập số sinh viên" value="{{old('number_of_students.'.$i)}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Tổng Khối Lượng công việc <span style="color: red">*</span></label>
                                                    <input required type="text" maxlength="100" class="form-control" name="total_workload[]"
                                                        placeholder="Nhập địa chỉ liên lạc" value="{{old('total_workload.'.$i)}}">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Số Giờ Lý Thuyết <span style="color: red">*</span></label>
                                                    <input required type="text" class="form-control" name="theoretical_hours[]"
                                                        placeholder="Nhập số giờ lý thuyết" value="{{old('theoretical_hours.'.$i)}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Số Giờ Thực Hành <span style="color: red">*</span></label>
                                                    <input required type="text" class="form-control" name="practice_hours[]" placeholder="Nhập số giờ thực hành"
                                                        value="{{old('practice_hours.'.$i)}}">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Học kỳ <span style="color: red">*</span></label>
                                                    <select required name="semester[]" class="form-control">
                                                        <div class="session_list col-sm-6">
                                                            <option value="">Chọn Học Kì</option>
                                                            @foreach($se as $semester)
                                                            <option {{old('semester.'.$i) == $semester->id ? 'selected' : ''}}
                                                                value="{{$semester->id}}">{{$semester->name}}</option>
                                                            @endforeach
                                                        </div>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Ghi Chú</label>
                                                    <input type="text" class="form-control" name="note[]" placeholder="Nhập Ghi chú nếu có"
                                                        value="{{old('note.'.$i)}}">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        @endfor

                        @else
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
                                            <label>Học kỳ <span style="color: red">*</span></label>
                                            <select required name="semester[]" class="form-control">
                                                <div class="session_list col-sm-6">
                                                    <option value="">Chọn Học Kì</option>
                                                    @foreach($se as $semester)
                                                        <option value="{{$semester->id}}">{{$semester->name}}</option>
                                                    @endforeach
                                                </div>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Khoa <span style="color: red">*</span></label>

                                            <select  required class="form-control" name="unit_id">
                                                <option value="">Chọn Khoa</option>
                                                @foreach($unit as $uni)
                                                    <option  value="{{$uni->id}}">{{$uni->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Mã Môn Học <span style="color: red">*</span></label>
                                            <input required type="text" class="form-control" name="subject_code[]" placeholder="Nhập mã môn học"
                                                value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Tên Môn Học <span style="color: red">*</span></label>
                                            <input required type="text" maxlength="60" class="form-control" name="subject_name[]"
                                                placeholder="Nhập Tên môn học" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Số tiết học <span style="color: red">*</span></label>
                                            <input required type="text" class="form-control" name="number_of_lessons[]" placeholder="Nhập số tiết học trong năm"
                                                value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Mã Lớp <span style="color: red">*</span></label>
                                            <input required type="text" maxlength="100" class="form-control" name="class_code[]"
                                                placeholder="Nhập mã Lớp" value="">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Số Sinh Viên <span style="color: red">*</span></label>
                                            <input required type="text" maxlength="100" class="form-control" name="number_of_students[]"
                                                placeholder="Nhập số sinh viên" value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Tổng Khối Lượng công việc <span style="color: red">*</span></label>
                                            <input required type="text" maxlength="100" class="form-control" name="total_workload[]"
                                                placeholder="Nhập địa chỉ liên lạc" value="">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Số Giờ Lý Thuyết <span style="color: red">*</span></label>
                                            <input required type="text" class="form-control" name="theoretical_hours[]"
                                                placeholder="Nhập số giờ lý thuyết" value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Số Giờ Thực Hành <span style="color: red">*</span></label>
                                            <input required type="text" class="form-control" name="practice_hours[]" placeholder="Nhập số giờ thực hành"
                                                value="">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Ghi Chú</label>
                                            <input type="text" class="form-control" name="note[]" placeholder="Nhập Ghi chú nếu có"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class=" col-sm-3 " id="sticky">
                <div class="panel panel-default">
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
        </div>
        <input type="hidden" name="count_panel" id="count_panel">
    </form>
</div>

    <script src="{{asset('js/scrollfix.js')}}"></script>
    <script src="{{asset('js/typeahead.bundle.min.js')}}"></script>
    <script>

        $(document).ready(function(){
            var engine = new Bloodhound({
                identify : function(obj) { return  obj.employee_code; },
                limit: 5,
                remote: {
                    url: '{{route('admin.workload.fetch.employee_code')}}'+'?query=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            $('#employee_code').typeahead({
                hint:true,
                highlight:true,
                minLength:4,

            },[
                {
                    source: engine.ttAdapter(),
                    name: 'employee_code',
                    display: function(data) {

                        return data.employee_code;
                    },
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">Không tìm thấy mã nhân viên này</div></div>'
                        ],
                        header: [
                            '<div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.employee_code +' - '+ data.full_name + '</div></div>';
                        }
                    }
                }
            ]);
            if ($('input[type=radio][name=session_new]:checked').val() == 0) {
                $("select[name=session_id]").prop("required", true);
                $("input[name=start_year]").prop("required", false);
                $("input[name=end_year]").prop("required", false);
                $('.session_list').removeClass('hide');
                $('.session_new').addClass('hide');
            }
            else if ($('input[type=radio][name=session_new]:checked').val() == 1) {
                $('.session_list').addClass('hide');
                $("select[name=session_id]").prop("required", false);
                $("input[name=start_year]").prop("required", true);
                $("input[name=end_year]").prop("required", true);
                $('.session_new').removeClass('hide');
            }
            $('#add-workload').on('submit',function(e){
                $('input[name=count_panel]').val($('.count-panel').length);

            });
            //sticky panel
            $("#sticky").scrollFix({
                topPosition: 71,

            });

            $('input[type=radio][name=session_new]').change(function() {
                if (this.value == 0) {
                    $('.session_list').removeClass('hide');

                    $('input[name=start_year]').val('');
                    $('input[name=end_year]').val('');
                    $("select[name=session_id]").prop("required", true);
                    $("input[name=start_year]").prop("required", false);
                    $("input[name=end_year]").prop("required", false);
                    $('.session_new').addClass('hide');
                }
                else if (this.value == 1) {
                    $('.session_list').addClass('hide');
                    $('.session_list select').val('');

                    $("select[name=session_id]").prop("required", false);
                    $("input[name=start_year]").prop("required", true);
                    $("input[name=end_year]").prop("required", true);
                    $('.session_new').removeClass('hide');
                }
            });
            var form = $('#block').find('.panel-append').first().html();
            $('.btn_append').on('click', function() {

                console.log(form);
                $('#block').find('.panel-append').last().append(form);
                $('button[class=close]').on('click',function () {
                    if($('.count-panel').length != 1){

                        ($(this).parent().parent().parent().remove());
                    }
                });

            });

        });
    </script>
@endsection
