@extends('admin.master')
@section('title','Xem chi tiết thông tin cá nhân')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
            <li class="active">Chi tiết nhân viên - {{$pi->employee_code}}</li>
        </ol>
    </div>
</div>

@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="nav-tabs-container  table-responsive">
                <ul class="nav nav-tabs">
                    <li class="{{url()->current() == route('admin.pi.detail',$pi->id) ? 'active':''}}"><a href="{{route('admin.pi.detail',$pi->id)}}">Thông tin cá nhân</a></li>
                    <li class="{{url()->current() == route('admin.pi.workload.index',$pi->id) ? 'active':''}}"><a href="{{route('admin.pi.workload.index',$pi->id)}}">Khối lượng công việc</a></li>
                    <li class="{{url()->current() == route('admin.sb.detail',$pi->id) ? 'active':''}}"><a href="{{route('admin.sb.detail',$pi->id)}}">Lý lịch khoa học</a></li>

                </ul>
            </div>
        </div>
</nav>
@endsection
@section('content')

<div style="padding-top: 71px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                            @include('admin.layouts.Error')
                            @if(session()->has('message'))
                                <div class="alert alert-success mt-10">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                    </div>

                </div>

                    <div class="col-sm-7">
                            <div class="col-sm-12">

                                <div class="panel panel-default">
                                    <div class="panel-heading">Thông tin cá nhân <br>
                                        @can('cud', $pi)

                                        <a href="{{route('admin.pi.update',$pi->id)}}">
                                            <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                                        </a>
                                        @endcan
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" action="{{route('admin.pi.detail',$pi->id)}}" method="get">
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
                                                <span for="" class="col-sm-9 text-nowrap">{{date('d-m-Y',
                                                    strtotime($pi->date_of_birth))}}</span>
                                            </div>


                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3  ">Nơi sinh </label>
                                                <span for="" class="col-sm-9 text-nowrap">{{$pi->place_of_birth}}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3  ">Giới tính </label>
                                                <span for="" class="col-sm-9 text-nowrap">{{$pi->gender ==0 ?
                                                    "Nam":""}}{{$pi->gender ==1 ? "Nữ":""}}</span>
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
                                                <span for="" class="col-sm-9 text-nowrap">{{date('d-m-Y',
                                                    strtotime($pi->date_of_issue))}}</span>
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
                                        @can('cud', $pi)

                                        <a href="{{route('admin.pi.degree.create',$pi->id)}}">
                                            <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
                                        </a>
                                        @endcan
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
                                        <label><a href="{{route('admin.pi.degree.index',$pi->id)}}">Chi tiết</a> </label>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Thông tin học hàm<br>
                                        @can('cud', $pi)
                                        @if($pi->academic_rank()->exists())
                                        <a href="{{route('admin.academic.update',$pi->id)}}">
                                            <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                                        </a>
                                        @else
                                        <a href="{{route('admin.academic.create',$pi->id)}}">
                                                <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
                                            </a>
                                        @endif
                                        @endcan
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
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4  ">Khối ngành </label>
                                                <span for="" class="col-sm-3 text-nowrap">{{$pi->academic_rank()->exists() ? $pi->academic_rank->industry->name : 'Chưa có'}}</span>

                                            </div>


                                        </form>
                                    </div>
                                    @if($pi->academic_rank()->exists())
                                    <div class="panel-footer text-center">
                                        <label><a class="text-danger" href="{{ route('admin.academic.delete',$pi->id)}}">Xóa</a> </label>

                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Thông tin tài khoản</div>
                                    <div class="panel-body">

                                        <div class="form-horizontal">

                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4  ">Tài khoản </label>
                                                <span for="" class="col-sm-3 text-nowrap">{{$pi->employee_code}}</span>

                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 ">Loại tài khoản</label>
                                                <span for="" class="col-sm-3 text-nowrap">{{$pi->admin =='' ? 'Người
                                                    dùng':'Quản trị viên' }} </span>

                                            </div>
                                            <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 ">Vai trò</label>
                                                    @if($pi->admin != '')
                                                        <span for="" class="col-sm-4 text-nowrap">
                                                            {{$pi->admin->is_supervisor == 1 ? 'Ban quản trị':'Phòng tổng hợp' }}
                                                        </span>

                                                    @else
                                                        <span for="" class="col-sm-4 text-nowrap">
                                                            {{$pi->employee->is_leader == 1 ? 'Trưởng khoa':'CBGV/NV' }}
                                                        </span>
                                                    @endif


                                                    @can('cud', $pi)
                                                    <span class="col-sm-4 text-nowrap"><a id="change_role_show" href="#"><small>Thay
                                                                đổi</small></a></span>
                                                                @endcan
                                                </div>
                                            @can('cud', $pi)
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 ">Mật khẩu </label>
                                                <span for="" class="col-sm-8 text-nowrap">

                                                    <button id="submit_recovery_password" class="btn btn-xs btn-danger">Khôi
                                                        phục</button>

                                                </span>

                                            </div>

                                            {{-- Modal Change ROles Account --}}
                                            <form action="{{route('admin.pi.role.change',$pi->id)}}" method="post" id="change_role">
                                                {{csrf_field()}}
                                                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                                    aria-hidden="true" id="role-change-modal">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Thay đổi vai trò tài khoản</h4>
                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-4  ">Tài khoản
                                                                    </label>
                                                                    <span for="" class="col-sm-3 text-nowrap">{{$pi->employee_code}}</span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-4 control-label text-al">Loại tài khoản</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="role">
                                                                            <option {{$pi->admin !='' ? '':'selected'}} value="0">Người
                                                                                dùng</option>
                                                                            <option {{$pi->admin !='' ? 'selected':''}} value="1">Quản
                                                                                trị viên</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="role_admin form-group hide">
                                                                        <label for="inputEmail3" class="col-sm-4 control-label text-al">Vai trò </label>
                                                                        <div class="col-sm-8">
                                                                                <div class="radio">
                                                                                        <label class="col-sm-6">
                                                                                            @if($pi->admin != '')
                                                                                            <input {{$pi->admin->is_supervisor == '1' ? 'checked' : ''}} required type="radio"
                                                                                                name="role_admin" value="0">Ban quản trị
                                                                                            @else
                                                                                            <input required type="radio"
                                                                                                name="role_admin" value="0">Ban quản trị
                                                                                            @endif

                                                                                        </label>
                                                                                        <label class="col-sm-6">
                                                                                            @if($pi->admin != '')
                                                                                            <input required type="radio" {{$pi->admin->is_supervisor == '0' ? 'checked' : ''}}
                                                                                                name="role_admin" value="1">Phòng tổng hợp
                                                                                            @else
                                                                                            <input required type="radio"
                                                                                                name="role_admin" value="1">Phòng tổng hợp
                                                                                            @endif

                                                                                        </label>
                                                                                    </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="role_employee form-group hide">
                                                                            <label for="inputEmail3" class="col-sm-4 control-label text-al">Vai trò </label>
                                                                            <div class="col-sm-8">
                                                                                    <div class="radio">
                                                                                            <label class="col-sm-6">
                                                                                                @if($pi->employee != '')
                                                                                                <input {{$pi->employee->is_leader == '0' ? 'checked' : ''}} required type="radio"
                                                                                                    name="role_employee" value="0">CBGV/NV
                                                                                                @else
                                                                                                <input required type="radio"
                                                                                                    name="role_employee" value="0">CBGV/NV
                                                                                                @endif
                                                                                            </label>
                                                                                            <label class="col-sm-6">
                                                                                                @if($pi->employee != '')
                                                                                                <input required type="radio" {{$pi->employee->is_leader == '1' ? 'checked' : ''}}
                                                                                                    name="role_employee" value="1">Trưởng Khoa
                                                                                                @else
                                                                                                <input required type="radio"
                                                                                                    name="role_employee" value="1">Trưởng Khoa
                                                                                                @endif

                                                                                            </label>
                                                                                        </div>
                                                                            </div>

                                                                        </div>

                                                            </div>


                                                            <div class="modal-footer">

                                                                <button type="button" class="btn btn-danger" id="btn-rc-yes">Có</button>
                                                                <button type="button" class="btn btn-default" id="btn-rc-no">Không</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            @endcan
                                            {{-- Modal Reset Password --}}
                                            @can('cud', $pi)
                                            <form id="recovery_password" action="{{route('admin.pi.password.recovery',$pi->id)}}"
                                                method="get">
                                                {{csrf_field()}}

                                                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                                    aria-hidden="true" id="pwd-recovery-modal">

                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn khôi
                                                                    phục mật khẩu cho tài khoản này ?</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" id="btn-pr-yes">Có</button>
                                                                <button type="button" class="btn btn-default" id="btn-pr-no">Không</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
            </div>




        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#submit_recovery_password").on('click', function(e) {

            e.preventDefault();
            $("#pwd-recovery-modal").modal('show');
            var form_recovery_password = $("#recovery_password");
            var modalConfirm = function(callback) {
                $("#btn-pr-yes").on("click", function(){
                    callback(true);
                    $("#pwd-recovery-modal").modal('hide');
                });
                $("#btn-pr-no").on("click", function(){
                    callback(false);
                    $("#pwd-recovery-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm) {
                if (confirm) {
                    form_recovery_password.submit();
                } else {

                }
            });
        });

        $("#change_role_show").on('click',function (e) {

            e.preventDefault();
            $("#role-change-modal").modal('show');
            var form_change_role = $("#change_role");
            var roleConfirm = function(callback){

                $("#btn-rc-yes").on("click", function(){
                    callback(true);
                    $("#role-change-modal").modal('hide');
                });

                $("#btn-rc-no").on("click", function(){
                    callback(false);
                    $("#role-change-modal").modal('hide');
                });
            };
            roleConfirm(function(confirm){
                if(confirm){
                    form_change_role.submit();
                }else{

                }
            });
        });
        if ($('select[name=role]').val() == 0) {
                    $('.role_employee').removeClass('hide');
                    $('.role_admin').addClass('hide');
            }
            else{
                    $('.role_admin').removeClass('hide');
                    $('.role_employee').addClass('hide');
            }
        $('select[name=role]').change(function() {
                if (this.value == 0) {
                    $('.role_employee').removeClass('hide');
                    $('.role_admin').addClass('hide');
                }
                else if (this.value == 1) {
                    $('.role_admin').removeClass('hide');
                    $('.role_employee').addClass('hide');
                }
        });
    });
</script>
@endsection
