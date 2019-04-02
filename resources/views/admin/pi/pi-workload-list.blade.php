@extends('admin.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
             <li class=""><a href="{{route('admin.pi.detail',$pi_id)}}">Thông tin cá nhân - {{App\PI::find($pi_id)->employee_code}}</a></li>
            <li class="active">Danh sách khối lượng công việc</li>
        </ol>
    </div>
</div>

@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup" >
    <div class="cm-flex">
        <div class="nav-tabs-container  table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('admin.pi.detail',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.detail',$pi_id)}}">Thông tin cá nhân</a></li>
                <li class="{{url()->current() == route('admin.pi.workload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.workload.index',$pi_id)}}">Khối lượng công việc</a></li>
                <li class="{{url()->current() == route('admin.sb.detail',$pi_id) ? 'active':''}}"><a href="{{route('admin.sb.detail',$pi_id)}}">Lý lịch khoa học</a></li>
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
                @include('admin.layouts.Error')
                @if(session()->has('message'))
                    <div class="alert alert-success mt-10">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Khối lượng công việc<br>
                        @can('cud',App\PI::first())
                        <a href="{{route('admin.workload.add','pi_id='.$pi_id)}}">
                            <button type="button" name="button" class="btn btn-xs btn-success">Thêm</button>
                        </a>
                        @endcan
                    </div>
                    <div class="panel-body">
                            <form class="form-horizontal" action="{{route('admin.pi.workload.index',$pi_id)}}" method="get">
                        <div class="form-group col-sm-6">

                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <label class="control-label">Tìm kiếm</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="search" placeholder="Nhập mã hoặc tên khoa/môn.">


                                    </div>
                                </div>
                                @if($search !="")
                                <div class="col-sm-12 mt-10">
                                    <div class="col-sm-3">
                                        <label class="control-label">Tìm theo </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="control-label text-al">
                                            <a data-toggle="tooltip" data-placement="right" title=""
                                                data-original-title="Xóa" href="javascript:" class="search_tag tooltip-test">
                                                <span class="badge badge-primary">{{$search}}
                                                    <span class="mdi mdi-close"></span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @endif

                                <div class="col-sm-12 mt-10">
                                    <div class="col-sm-3">
                                        <label class="control-label">Năm học</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="form-control year_workload" name="year_workload">
                                                @foreach($workload_session as $item)
                                                @if($year_workload == null)
                                                @if($item->id == $workload_session_current->id)
                                                <option selected value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}} ( Hiện tại ) </option>

                                                @else
                                                <option value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}}</option>
                                                @endif
                                                @else
                                                @if($item->id == $workload_session_current->id)
                                                <option selected value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}} ( Hiện tại ) </option>

                                                @else
                                                @if($item->id == $year_workload)
                                                <option selected value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}}</option>
                                                @else
                                                <option value="{{$item->id}}">{{$item->start_year}} -
                                                    {{$item->end_year}}</option>

                                                @endif
                                                @endif
                                                @endif

                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">Tìm</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                        </div>
                        <div class="form-group col-sm-6">
                                <div class="col-sm-12">
                                        <label class="control-label col-sm-4">Học kỳ
                                        </label>
                                        <div class="col-sm-8">
                                                <select class="form-control semester" name="semester">
                                                    <option value="4" selected>Cả năm</option>
                                                    @foreach($semester as $item)
                                                    <option {{$semester_filter == $item->alias ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>

                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                        </div>
                    </form>
                        {{-- Loading Div --}}


                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" style="margin-bottom:0">
                            <thead>
                                <tr>

                                    <th>Mã NV</th>
                                    <th>Họ Tên</th>
                                    <th>Khoa</th>
                                    <th>Mã - Tên môn học</th>
                                    <th>Số tiết</th>
                                    <th>Quy đổi giờ chuẩn</th>
                                    <th>Lý thuyết</th>
                                    <th>Thực hành</th>
                                    <th>Học kỳ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($workloads->count() >0)
                                @foreach ($workloads as $item)
                                <tr>
                                    <td class="col-sm-1">

                                        <a href="{{route('admin.workload.detail',$item->id)}}" data-toggle="tooltip"
                                            data-placement="right" title="" data-original-title="Chi tiết" href="javascript:"
                                            class="search_tag tooltip-test">
                                            <span class="badge badge-danger">{{$item->pi->employee_code}}
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="col-sm-2">{{$item->pi->full_name}}</td>
                                    <td class="col-sm-1">{{$item->unit->unit_code}}</td>
                                    <td class="col-sm-2">{{$item->subject_code}} - {{$item->subject_name }}</td>
                                    <td class="col-sm-1">{{$item->number_of_lessons}}</td>
                                    <td class="col-sm-1">{{$item->total_workload}}</td>
                                    <td class="col-sm-1">{{$item->theoretical_hours}}</td>
                                    <td class="col-sm-1">{{$item->practice_hours}}</td>
                                    <td class="col-sm-1">{{$item->semester->alias}}</td>
                        @can('cud',App\PI::first())

                                    <td class="col-sm-1">
                                        <a href="{{route('admin.workload.update',$item->id)}}" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Cập nhật" href="javascript:"
                                            class="tooltip-test">
                                            <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                        <a href="{{route('admin.workload.delete',$item->id)}}" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Xóa" class="delete_workload tooltip-test ml-10">
                                            <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>
                            @else
                            <td></td>
                            @endcan
                                </tr>
                        @can('cud',App\PI::first())

                                {{--modal delete workload--}}

                                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                    aria-hidden="true" id="pi-delete-modal">

                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa khối lượng công việc này ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                                <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @endcan
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">

                        {{$workloads->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(".search_tag").on('click', function() {
            var url = {!!json_encode(route('admin.pi.workload.index',$pi_id), JSON_UNESCAPED_SLASHES) !!};
            var session_id = $('.year_workload').val();
            var semester = $('.semester').val();
            var search = "";
            window.location.href = url + '?year_workload=' + session_id+'&semester='+semester;
        });
    });

    $(".delete_workload").on('click',function (e) {
            e.preventDefault();
            $("#pi-delete-modal").modal('show');
            var delete_workload_form = $(this).attr('href');
            var modalConfirm = function(callback){

                $("#btn-pd-yes").on("click", function(){
                    callback(true);
                    $("#pi-delete-modal").modal('hide');
                });

                $("#btn-pd-no").on("click", function(){
                    callback(false);
                    $("#pi-delete-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm){
                if(confirm){
                    window.location.href = delete_workload_form;

                }else{

                }
            });
        });
</script>
@endsection
