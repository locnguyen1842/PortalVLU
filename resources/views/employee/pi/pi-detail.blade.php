@extends('employee.master')
@section('title','Xem chi tiết thông tin cá nhân')
@section('breadcrumb')
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    {{-- <li><a href="#">Home</a></li> --}}
                    <li class="active">Thông tin cá nhân</li>
                </ol>
            </div>
        </div>
@endsection
{{-- @section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="nav-tabs-container">
                <ul class="nav nav-tabs">
                    <li class="{{url()->current() == route('employee.pi.detail') ? 'active':''}}"><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                    <li class="{{url()->current() == route('employee.workload.index') ? 'active':''}}"><a href="{{route('employee.workload.index')}}">Khối lượng công việc</a></li>
                </ul>
            </div>
        </div>
</nav>
@endsection --}}
@section('content')

    <div class="col-sm-12">
            <div class="col-sm-12">
                    @include('employee.layouts.Error')
                    @if(session()->has('message'))
                        <div class="alert alert-success mt-10">
                            {{ session()->get('message') }}
                        </div>
                    @endif
            </div>
    </div>

    <div id="" style="padding-top: 21px">
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
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->nation->name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Địa chỉ Email </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->email_address}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Số điện thoại </label>
                                        <span for="" class="col-sm-9 text-nowrap">{{$pi->phone_number}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Địa chỉ thường trú </label>
                                        <span for="" class="col-sm-9 text-truncate">{{$pi->permanent_address()->exists() && $pi->permanent_address->address_content != null ? $pi->permanent_address->address_content .', ' :''}}{{$pi->permanent_address()->exists() ? $pi->permanent_address->ward->path_with_type :''}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3  ">Địa chỉ tạm trú </label>
                                        <span for="" class="col-sm-9 text-truncate">{{$pi->contact_address()->exists() && $pi->contact_address->address_content != null ? $pi->contact_address->address_content .', ' :''}}{{$pi->contact_address()->exists() ? $pi->contact_address->ward->path_with_type :''}}</span>
                                    </div>
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

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin nghề nghiệp</div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('admin.pi.detail',$pi->id)}}" method="get">
                                    {{csrf_field()}}
                                    @if($pi->officer()->exists())
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Loại cán bộ </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->officer->type->name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Chức vụ</label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->officer->position->name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Kiêm nhiệm giảng dạy</label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->officer->is_concurrently == 1 ? 'Có':'Không'}}</span>
                                    </div>
                                    @endif
                                    @if($pi->teacher()->exists())
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Loại giảng viên </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->teacher->type->note}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Chức danh nghề nghiệp </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->teacher->title->name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Danh hiệu</label>
                                        <span for="" class="col-sm-7 text-nowrap">
                                            {{(($pi->teacher->is_excellent_teacher == 1 ? 'Nhà giáo ưu tú': ''))}}

                                            {{(($pi->teacher->is_national_teacher == 1 &&$pi->teacher->is_excellent_teacher == 1 ) ? ',': '')}}

                                            {{($pi->teacher->is_national_teacher == 1 ? 'Nhà giáo nhân dân': '')}}

                                        </span>
                                    </div>
                                    @if($pi->teacher->is_retired == 1)
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Nghĩ hưu</label>
                                        <span for="" class="col-sm-7 text-nowrap">Đã nghĩ hưu</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Ngày nghĩ hưu</label>
                                        <span for="" class="col-sm-7 text-nowrap">{{date('d-m-Y',strtotime($pi->teacher->date_of_retirement))}}</span>
                                    </div>

                                    @endif
                                    @endif

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Đơn vị</label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$pi->unit->name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Ngày tuyển dụng </label>
                                        <span for="" class="col-sm-7 text-nowrap">{{date('d-m-Y',strtotime($pi->date_of_recruitment))}}</span>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin bằng cấp <br>
                                <a href="{{route('employee.pi.degree.create')}}">
                                    <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
                                </a>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4  ">Số bằng đại học </label>
                                        <span for="" class="col-sm-3 text-nowrap">{{$dh_count}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Số bằng thạc sĩ </label>
                                        <span for="" class="col-sm-3 text-nowrap">{{$ths_count}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4  ">Số bằng tiến sĩ </label>
                                        <span for="" class="col-sm-3 text-nowrap">{{$ts_count}}</span>

                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer text-center">
                              <label><a href="{{route('employee.pi.degree.index')}}">Chi tiết</a> </label>

                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin học hàm<br>
                                @if($pi->academic_rank()->exists())
                                <a href="{{route('employee.academic.update')}}">
                                    <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                                </a>
                                @else
                                <a href="{{route('employee.academic.create')}}">
                                        <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
                                    </a>
                                @endif
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4  ">Học hàm </label>
                                        <span for="" class="col-sm-3 text-nowrap">{{$pi->academic_rank()->exists() ? $pi->academic_rank->type->name : 'Chưa có'}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Chuyên ngành</label>
                                        <span for="" class="col-sm-3 text-nowrap">{{$pi->academic_rank()->exists() ? $pi->academic_rank->specialized : 'Chưa có'}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4  ">Ngày công nhận </label>
                                        <span for="" class="col-sm-3 text-nowrap">{{$pi->academic_rank()->exists() ? date('d-m-Y', strtotime($pi->academic_rank->date_of_recognition)) : 'Chưa có'}}</span>

                                    </div>
                                </form>
                            </div>
                            @if($pi->academic_rank()->exists())
                            <div class="panel-footer text-center">
                                <label><a class="text-danger" href="{{ route('employee.academic.delete')}}">Xóa</a> </label>

                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin tài khoản</div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{route('employee.pi.detail',$employee->id)}}" method="get">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Tên tài khoản</label>
                                        <span for="" class="col-sm-8 text-nowrap">{{$employee->username}}</span>

                                    </div>
                                    <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 ">Vai trò</label>
                                            <span for="" class="col-sm-8 text-nowrap">{{$employee->is_leader ==1 ? 'Trưởng khoa':'CBGV/NV'}}</span>

                                        </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 ">Mật khẩu </label>
                                        <span for="" class="col-sm-8 text-nowrap"><a href="{{route('employee.pi.change.pass')}}">Thay đổi</a></span>


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
