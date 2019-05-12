@extends('admin.master')
@section('title','Danh sách năm học')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class="active">Quản lý năm học</li>
            </ol>
        </div>
    </div>
@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup" >
    <div class="cm-flex">
        <div class="nav-tabs-container  table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('admin.workload.index') ? 'active':''}}"><a href="{{route('admin.workload.index')}}">Quản lý khối lượng giảng dạy</a></li>
                <li class="{{url()->current() == route('admin.srworkload.index') ? 'active':''}}"><a href="{{route('admin.srworkload.index')}}">Quản lý khối lượng NCKH</a></li>
                <li class="{{url()->current() == route('admin.schoolyear.index') ? 'active':''}}"><a href="{{route('admin.schoolyear.index')}}">Quản lý năm học</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')


<div  style="padding-top:51px">
    @include('admin.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default mt-20">
        <div class="waiting">
            <img src="{{asset('img/loader.gif')}}" alt="Đang tải">
        </div>
        <div class="panel-heading">Danh sách năm học<br>
            @can('cud',App\PI::first())
            <a href="{{route('admin.schoolyear.add')}}" methods="post">
                <button type="button" name="button" class="btn btn-xs btn-success">Thêm Mới</button>
            </a>
            @endcan
        </div>


        <div class="table-responsive">
            <table class="table table-hover" style="margin-bottom:0">
                <thead>
                    <tr>
                        <th>Năm bắt đầu</th>
                        <th>Năm kết thúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($yearlist->count() >0)
                    @foreach ($yearlist as $item)
                    <tr>
                        <td class="col-sm-1">{{$item->start_year}}</td>
                        <td class="col-sm-1">{{$item->end_year}}</td>
                        @can('cud',App\PI::first())

                        <td class="col-sm-1">
                            <a href="{{route('admin.schoolyear.update',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test">
                                <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                            <a href="{{route('admin.schoolyear.delete',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Xóa" class="delete_workload tooltip-test ml-10">
                                <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                        </td>
                        @else
                        <td></td>
                        @endcan

                    </tr>
                    {{--modal delete workload--}}
                    @can('cud',App\PI::first())

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
                        id="pi-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa năm học này ? </h4>
                                </div>
                                <div class="modal-body">
                                    <p for="" class="text-danger">Ghi chú: Việc xóa năm học này sẽ xóa cả các khối lượng công việc liên quan.</p>
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
                        <td colspan="3" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>
        <div class="panel-footer">
                {{$yearlist->links()}}

        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $(".search_tag").on('click', function() {
            var url = {!!json_encode(route('admin.workload.index'), JSON_UNESCAPED_SLASHES) !!};
            var session_id = $('.year_workload').val();
            var search = "";
            window.location.href = url+'?year_workload='+session_id;
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
    });
</script>
@endsection
