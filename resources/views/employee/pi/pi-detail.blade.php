@extends('admin.master')
@section('title','Xem chi tiết thông tin cá nhân')
@section('breadcrumb')
    @include('employee.layouts.breadcrumb')
@endsection
@section('content')
    @include('employee.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div id="" style="padding-top: 20px">
        <div class="">
            <div class=" cm-fix-height">
                <div class="col-sm-7">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin cá nhân <br>
                                <a href="{{route('employee.pi.update')}}">
                                    <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                                </a>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('employee.pi.detail')}}" method="get">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3  ">Mã nhân viên</label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->employee_code}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Họ và tên</label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->full_name}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Ngày sinh </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{date('d-m-Y', strtotime($pi->date_of_birth))}}</span>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Nơi sinh </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->place_of_birth}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Giới tính </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->gender ==0 ? "Nam":""}}{{$pi->gender ==1 ? "Nữ":""}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Dân tộc </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->nation}}</span>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin liên hệ</div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('employee.pi.detail')}}" method="get">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Địa chỉ Email </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->email_address}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Số điện thoại </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->phone_number}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Địa chỉ liên lạc </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->contact_address}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Địa chỉ thường trú </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->permanent_address}}</span>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin xác thực</div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('employee.pi.detail')}}" method="get">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3  ">CMND </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->identity_card}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Ngày cấp </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{date('d-m-Y', strtotime($pi->date_of_issue))}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Nơi cấp </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->place_of_issue}}</span>
                                    </div>
                                    {{-- <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3  ">Bằng Cấp </label>


                                                </div>
                                            </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-sm-5">

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin bằng cấp <br>
                                <a href="{{route('employee.pi.update.degree')}}">
                                    <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
                                </a>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4  ">Số bằng đại học </label>
                                        <span for="" class="col-sm-3 text-nowrap">2</span>
                                        <span class="col-sm-5 text-nowrap"><a href="#"><small>Chi tiết</small></a> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Số bằng thạc sĩ </label>
                                        <span for="" class="col-sm-3 text-nowrap">2</span>
                                        <span class="col-sm-5 text-nowrap"><a href="#"><small>Chi tiết</small></a> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4  ">Số bằng tiến sĩ </label>
                                        <span for="" class="col-sm-3 text-nowrap">0</span>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin tài khoản</div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('employee.pi.detail')}}" method="get">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Tên tài khoản</label>
                                        <span for="" class="col-sm-8 text-nowrap">{{$pi->employee_code}}</span>

                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Mật khẩu </label>
                                        <span for="" class="col-sm-8 text-nowrap"><a href="{{route('employee.pi.change.pass')}}">Thay đổi</a></span>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin nghề nghiệp</div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('employee.pi.detail')}}" method="get">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Chức vụ </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->position}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Chức danh chuyên môn </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->professional_title}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Ngày tuyển dụng </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{date('d-m-Y', strtotime($pi->date_of_recruiment))}}</span>
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
