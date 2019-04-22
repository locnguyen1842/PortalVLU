@extends('employee.master')
@section('title','Thêm khối nghiên cứu khoa học')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('employee.srworkload.index')}}">Quản lý khối lượng NCKH</a></li>
            <li class="active">Thêm khối lượng NCKH</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="col-sm-12">
    @include('employee.layouts.Error')

    @if(session()->has('message'))
    <div class="alert alert-success mt-10">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div style="padding-top:20px">
    <form id="add-workload" class="form-horizontal" action="{{route('employee.srworkload.add')}}" method="post">
        <div class="cm-fix-height" id="parent_content">

            <div class=" col-sm-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Thêm Khối Lượng Nghiên Cứu Khoa Học</div>
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
                                <label>Niên Khóa <span style="color: red">*</span></label>
                                <div class="radio">
                                    <label class="col-sm-6">
                                        <input {{old('session_new') == '0' ? 'checked' : ''}} checked required type="radio"
                                            name="session_new" value="0">Chọn từ danh sách
                                    </label>
                                    <label class="col-sm-6">
                                        <input required type="radio" {{old('session_new') == '1' ? 'checked' : ''}}
                                            name="session_new" value="1">Tạo mới niên khóa
                                    </label>
                                </div>
                            </div>
                            <div class="session_list col-sm-6">
                                <label>Niên khóa <span style="color: red">*</span></label>
                                <select class="form-control" name="session_id">
                                    <option value="">Chọn Niên Khóa</option>
                                    @foreach($ws as $session)
                                    <option {{old('session_id') == $session->id ? 'selected' : ''}} value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="session_new col-sm-6 hide">
                                <label>Tạo mới niên khóa <span style="color: red">*</span></label>
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
                                <label>Công việc <span style="color: red">*</span> </label>
                                <input required type="text" class="form-control" name="name_of_work"
                                    placeholder="Nhập tên công việc" value="{{old('name_of_work')}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Chi tiết <span style="color: red">*</span></label>
                                <textarea required rows="1" style="overflow:auto;resize:none" type="text" class="form-control" name="detail_of_work"
                                    placeholder="Nhập chi tiết công việc" value="{{old('detail_of_work')}}"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Diễn giải (tên cụ thể của hoạt động NCKH, …) <span style="color: red">*</span>
                                </label>
                                <textarea required rows="1" style="overflow:auto;resize:none" type="text" class="form-control" name="explain_of_work"
                                    placeholder="Nhập diễn giải" value="{{old('explain_of_work')}}"></textarea>
                            </div>
                            <div class="col-sm-6">
                                <label>Đơn vị (đề tài, bài báo, tài liệu, giáo trình...) <span
                                        style="color: red">*</span></label>
                                <textarea required rows="1" style="overflow:auto;resize:none" type="text" class="form-control" name="unit_of_work"
                                    placeholder="Nhập đơn vị" value="{{old('unit_of_work')}}"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Số lượng <span style="color: red">*</span> </label>
                                <input required type="number" step="0.1" class="form-control" name="quantity_of_work"
                                    placeholder="Nhập số lượng" value="{{old('quantity_of_work')}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Quy đổi giờ chuẩn <span style="color: red">*</span></label>
                                <input required type="text" step="0.1" class="form-control" name="converted_standard_time"
                                    placeholder="Nhập quy đổi giờ chuẩn" value="{{old('converted_standard_time')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Số tiết/giờ quy đổi <span style="color: red">*</span></label>
                                <input required type="text" step="0.1" class="form-control" name="converted_time"
                                    placeholder="Nhập số tiết/giờ quy đổi" value="{{old('converted_time')}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Chú thích </label>
                                <input type="text" class="form-control" name="note"
                                    placeholder="Nhập chú thích" value="{{old('note')}}">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <div class="col-sm-offset-2 col-sm-10 text-right">
                                <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
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
                    url: '{{route('employee.workload.fetch.employee_code')}}'+'?query=%QUERY%',
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
