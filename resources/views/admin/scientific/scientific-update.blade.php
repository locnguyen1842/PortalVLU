@extends('admin.master')
@section('title','Cập nhật khối nghiên cứu khoa học')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('admin.srworkload.index')}}">Quản lý khối lượng NCKH</a></li>
            <li class="active">Cập nhật khối lượng NCKH</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="col-sm-12">
    @include('admin.layouts.Error')

    @if(session()->has('message'))
    <div class="alert alert-success mt-10">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div style="padding-top:20px">
    <form id="add-workload" class="form-horizontal" action="{{route('admin.srworkload.update',$srworkload->id)}}" method="post">
        <div class="cm-fix-height" id="parent_content">

            <div class=" col-sm-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Cập Nhật Khối Lượng Nghiên Cứu Khoa Học</div>
                    <div class="panel-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Mã nhân viên <span style="color: red">*</span> </label>
                                <input id="employee_code" required {{$pi != null ? 'readonly' : ''}} type="text"
                                    class="form-control" name="employee_code" autocomplete="off"
                                    placeholder="Nhập mã nhân viên"
                                    value="{{$pi != null ? $pi->employee_code : old('employee_code')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Năm học <span style="color: red">*</span> </label>
                                <div class="radio">
                                    @if(!is_null(old('session_new')))
                                    <label class="col-sm-6">
                                            <input required type="radio" {{old('session_new') == 0 ? "checked":""}} name="session_new" value="0">Chọn từ danh
                                            sách
                                        </label>
                                        <label class="col-sm-4">
                                            <input required type="radio" {{old('session_new') == 1 ? "checked":""}} name="session_new" value="1">Tạo mới năm học
                                        </label>
                                    @else
                                    <label class="col-sm-6">
                                            <input required type="radio" checked name="session_new" value="0">Chọn từ danh
                                            sách
                                        </label>
                                        <label class="col-sm-4">
                                            <input required type="radio" name="session_new" value="1">Tạo mới năm học
                                        </label>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="session_list col-sm-6">
                                <label>Năm học 1<span style="color: red">*</span> </label>
                                <select class="form-control" name="session_id">
                                    <option value="">Chọn Năm Học</option>
                                    @foreach($ws as $session)
                                    @if(old('session_id'))
                                    <option {{old('session_id') == $session->id ? "selected":""}}
                                            value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}
                                        </option>
                                    @else
                                    <option {{$srworkload->session_id == $session->id ? "selected":""}}
                                            value="{{$session->id}}">{{$session->start_year}}-{{$session->end_year}}
                                        </option>
                                    @endif
                                    
                                    @endforeach
                                </select>
                            </div>
                            <div class="session_new col-sm-6 hide">
                                <label>Tạo mới năm học <span style="color: red">*</span></label>
                                <div class="form-horizontal">
                                    <div class="col-sm-6 form-horizontal-none-pl">
                                        <input type="number" class="form-control" name="start_year"
                                            placeholder="Nhập năm bắt đầu" value="{{old('start_year')}}">
                                    </div>
                                    <div class="col-sm-6 form-horizontal-none-pl">
                                        <input type="number" class="form-control" name="end_year"
                                            placeholder="Nhập năm Kết thúc" value="{{old('end_year')}}">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Công việc <span style="color: red">*</span> </label>
                                <textarea required rows="4" style="overflow:auto;resize:none" type="text" class="form-control" name="name_of_work"
                                    placeholder="Nhập tên công việc" >{{old('name_of_work',$srworkload->name_of_work)}}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label>Chi tiết <span style="color: red">*</span></label>
                                <textarea required rows="4" style="overflow:auto;resize:none" type="text"
                                    class="form-control" name="detail_of_work"
                                    placeholder="Nhập chi tiết công việc">{{old('detail_of_work',$srworkload->detail_of_work)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Diễn giải (tên cụ thể của hoạt động NCKH, …) <span style="color: red">*</span>
                                </label>
                                <textarea required rows="4" style="overflow:auto;resize:none" type="text"
                                    class="form-control" name="explain_of_work"
                                    placeholder="Nhập diễn giải">{{old('explain_of_work',$srworkload->explain_of_work)}}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label>Đơn vị (đề tài, bài báo, tài liệu, giáo trình...) <span
                                        style="color: red">*</span></label>
                                <textarea required rows="4" style="overflow:auto;resize:none" type="text"
                                    class="form-control" name="unit_of_work"
                                    placeholder="Nhập đơn vị">{{old('unit_of_work',$srworkload->unit_of_work)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Số lượng <span style="color: red">*</span> </label>
                                <input required type="number" step="0.1" min="0" max="100000" class="form-control" name="quantity_of_work"
                                    placeholder="Nhập số lượng" value="{{old('quantity_of_work',$srworkload->quantity_of_work)}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Quy đổi giờ chuẩn <span style="color: red">*</span></label>
                                <input required type="number" step="0.1" min="0" max="100000" class="form-control"
                                    name="converted_standard_time" placeholder="Nhập quy đổi giờ chuẩn"
                                    value="{{old('converted_standard_time',$srworkload->converted_standard_time)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Số tiết/giờ quy đổi <span style="color: red">*</span></label>
                                <input required type="number" step="1" min="0" max="100000" class="form-control" name="converted_time"
                                    placeholder="Nhập số tiết/giờ quy đổi" value="{{old('converted_time',$srworkload->converted_time)}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Chú thích </label>
                                <input type="text" class="form-control" name="note" placeholder="Nhập chú thích"
                                    value="{{old('note',$srworkload->note)}}">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <div class="col-sm-offset-2 col-sm-10 text-right">
                                <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
                $('input[type=radio][name=session_new]').change(function() {
                    if ($(this).val() == 0) {
                        $('.session_list').removeClass('hide');
                        $('.session_new').addClass('hide');
                    }
                    else if ($(this).val() == 1) {
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
