@extends('employee.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
                <li class=""><a href="{{route('employee.faculty.index')}}">Quản lý khoa</a></li>
             <li class=""><a href="{{route('employee.faculty.detail',$srworkload->pi->id)}}">Thông tin cá nhân - {{App\PI::find($srworkload->pi->id)->employee_code}}</a></li>
             <li class=""><a href="{{ route('employee.faculty.srworkload.index',$srworkload->pi->id)}}">Khối lượng NCKH</a></li>
            <li class="active">Chi tiết khối lượng NCKH</li>
        </ol>
    </div>
</div>

@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="nav-tabs-container  table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('employee.faculty.detail',$srworkload->pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.detail',$srworkload->pi->id) }}">Thông tin cá nhân</a></li>
                <li class="{{url()->current() == route('employee.faculty.workload',$srworkload->pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.workload',$srworkload->pi->id)}}">khối lượng giảng dạy</a></li>
                <li class="{{url()->current() == route('employee.faculty.srworkload.index',$srworkload->pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.srworkload.index',$srworkload->pi->id)}}">khối lượng NCKH</a></li>
                <li class="{{url()->current() == route('employee.faculty.sb',$srworkload->pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.sb',$srworkload->pi->id) }}">lý lịch khoa học</a></li>
            </ul>
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
<div style="padding-top: 71px">
        <div class="">
                <div class=" cm-fix-height">
                    <div class="col-sm-7">
                        <div class="col-sm-12 form-horizontal">
                            <div class="panel panel-default">
                                <div class="panel-heading">Thông tin nghiên cứu khoa học<br>
                                    {{--  <a href="{{route('employee.srworkload.update',$srworkload->id)}}">
                                        <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                                    </a>  --}}
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5">Niên khóa</label>
                                        <span for=""
                                            class="col-sm-7 text-truncate">{{$srworkload->session->start_year}}-{{$srworkload->session->end_year}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-5">Công việc</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->name_of_work}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5">Chi tiết</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->detail_of_work}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Diễn giải</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->explain_of_work}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Đơn vị</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->unit_of_work}}
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Số lượng</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->quantity_of_work}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Quy đổi giờ chuẩn</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->converted_standard_time}}
                                            giờ</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Số tiết/giờ quy đổi</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->converted_time}} giờ</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Chú thích</label>
                                        <span for="" class="col-sm-7 text-truncate">{{$srworkload->note}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">

                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Thông tin CBGV/NV<br>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4">Mã nv</label>
                                            <div class="col-sm-8">
                                                <a href="{{route('employee.pi.detail',$srworkload->pi->id)}}" data-toggle="tooltip"
                                                    data-placement="right" title="" data-original-title="Chi tiết"
                                                    href="javascript:" class="search_tag tooltip-test">
                                                    <span for="" class="text-truncate">{{$srworkload->pi->employee_code}}</span>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4">Họ tên</label>
                                            <span for="" class="col-sm-8 text-truncate">{{$srworkload->pi->full_name}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4  ">Khoa</label>
                                            <span for="" class="col-sm-8 text-truncate">{{$srworkload->pi->unit->name}}</span>
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
