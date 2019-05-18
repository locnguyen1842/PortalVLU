@extends('admin.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin CBGV/NV</a></li>
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
                <li class="{{url()->current() == route('admin.pi.workload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.workload.index',$pi_id)}}">Khối lượng giảng dạy</a></li>
                    <li class="{{url()->current() == route('admin.pi.srworkload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.srworkload.index',$pi_id)}}">Khối lượng NCKH</a></li>
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
                    <div class="panel-heading">Khối lượng nghiên cứu khoa học<br>
                        @can('cud',App\PI::first())
                        <a href="{{route('admin.srworkload.add','pi_id='.$pi_id)}}">
                            <button type="button" name="button" class="btn btn-xs btn-success">Thêm</button>
                        </a>
                        @endcan
                    </div>
                    <div class="panel-body">
                            <form class="form-horizontal" action="{{route('admin.pi.srworkload.index',$pi_id)}}" method="get">
                        <div class="form-group col-sm-6">



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

                    </form>
                        {{-- Loading Div --}}


                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" style="margin-bottom:0">
                            <thead>
                                <tr>

                                    <th>Mã NV</th>
                                    <th>Họ Tên</th>
                                    <th>Công việc</th>
                                    <th>Chi tiết</th>
                                    <th>Diễn giải (tên cụ thể của hoạt động NCKH, …)</th>
                                    <th>Đơn vị (đề tài, bài báo, tài liệu, giáo trình...)</th>
                                    <th>Số lượng</th>
                                    <th>Quy đổi giờ chuẩn</th>
                                    <th>Số tiết/giờ quy đổi</th>
                                    <th>Ghi chú</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($workloads->count() >0)
                                @foreach ($workloads as $item)
                                <tr>
                                    <td class="col-sm-1">

                                        <a href="{{route('admin.srworkload.detail',$item->id)}}" data-toggle="tooltip"
                                            data-placement="right" title="" data-original-title="Chi tiết" href="javascript:"
                                            class="search_tag tooltip-test">
                                            <span class="badge badge-danger">{{$item->pi->employee_code}}
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{$item->pi->full_name}}</td>
                                    <td>{{str_limit($item->name_of_work,50)}}</td>
                                    <td>{{str_limit($item->detail_of_work,50)}}</td>
                                    <td>{{str_limit($item->explain_of_work,50)}}</td>
                                    <td>{{str_limit($item->unit_of_work,50)}}</td>
                                    <td>{{$item->quantity_of_work}}</td>
                                    <td>{{$item->converted_standard_time}}</td>
                                    <td>{{$item->converted_time}}</td>
                                    <td>{{str_limit($item->note,50)}}</td>
                        @can('cud',App\PI::first())

                                    <td class="col-sm-1">
                                        <a href="{{route('admin.srworkload.update',$item->id)}}" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Cập nhật" href="javascript:"
                                            class="tooltip-test">
                                            <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                                <span class="mdi mdi-close"></span>
                                            </span>
                                        </a>
                                        <a href="{{route('admin.srworkload.delete',$item->id)}}" data-toggle="tooltip"
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
                                                <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa khối lượng nghiên cứu khoa học này ?</h4>
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
                                    <td colspan="11" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
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
