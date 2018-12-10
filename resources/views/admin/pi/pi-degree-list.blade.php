@extends('admin.master')
@section('title','Danh sách bằng cấp')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                <li class=""><a href="{{route('admin.pi.detail',$pi->id)}}">Chi tiết thông tin nhân viên</a></li>
                <li class="active">Danh sách bằng cấp</li>
            </ol>
        </div>
    </div>
</nav>
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Danh sách bằng cấp<br>
        <a href="{{route('admin.pi.degree.create',$pi->id)}}">
            <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
        </a>
    </div>
    {{-- <div class="panel-body">
        <div class="form-group">
            <form class="form-horizontal" action="{{route('admin.pi.index')}}" method="get">
                <div class="col-sm-6">
                    <div class="col-sm-3">
                        <label class="control-label">Tìm kiếm</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Nhập mã nv, tên hoặc cmnd">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Tìm</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-sm-2">
            </div>

                <div class="col-sm-4">
                    <label class="control-label col-sm-4">Chọn tệp</label>
                    <div class="col-sm-8">

                        <input type="file" id="excel-import"  name="import_file" class="custom-file-input excel-default col-sm-4">
                        <button type="submit" name="button" class="btn btn-danger">Tải lên</button>
                    </div>
                </div>

            @if($search !="")
            <div class="col-sm-6">
                <div class="col-sm-3">
                    <label class="control-label">Tìm theo </label>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Xóa" href="javascript:" class="search_tag tooltip-test">
                            <span class="badge badge-primary">{{$search}}
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div> --}}
    <div class="table-responsive">
        <table class="table table-hover" action="{{route('admin.pi.degree.index',$pi->id)}}" method="get" style="margin-bottom:0">
            <thead>
                <tr>
                    <th>Loại</th>
                    <th>Khối ngành</th>
                    <th>Ngày Cấp </th>
                    <th>Nơi Cấp</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @if($degrees->count() > 0)
            @foreach($degrees as $degree)
                    <tr>
                    <td class="col-sm-2">{{$degree->degree->name}}</td>
                    <td class="col-sm-2">{{$degree->industry->name}}</td>
                    <td class="col-sm-2">{{date('d-m-Y', strtotime($degree->date_of_issue))}}</td>
                        {{--{{date('d-m-Y',($degree->date_of_issue))}}--}}
                    <td class="col-sm-2">{{$degree->place_of_issue}}</td>
                        <td class="col-sm-3">
                            <a href="{{route('admin.pi.degree.update',$degree->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cập nhật" class="tooltip-test">
                          <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                            </a>
                            <a href="{{route('admin.pi.degree.delete',$degree->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"  class="delete_degree tooltip-test ml-10">
                          <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="degree-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xoá bằng cấp này ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                    <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
          @else
            <tr>
              <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
            </tr>
          @endif
            </tbody>
        </table>
    </div>
    <div class="panel-footer">

      {{$degrees->links()}}
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".delete_degree").on('click',function (e) {
            e.preventDefault(); //huy bo thao tac mac dinh.
            $("#degree-delete-modal").modal('show'); //show cai div co id pi-delete-modal
            var delete_pi_form = $(this).attr('href'); //lay gia tri href cua class delete_degree
            var modalConfirm = function(callback){
                //khi nhan nut yes
                $("#btn-pd-yes").on("click", function(){
                    callback(true);
                    $("#degree-delete-modal").modal('hide');
                });
                //khi nhan nut no
                $("#btn-pd-no").on("click", function(){
                    callback(false);
                    $("#degree-delete-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm){
                if(confirm){
                    //khi nhan nut yes
                    //thuc hien chuyen tiep den url delete_pi_form = $(this).attr('href');
                    window.location.href = delete_pi_form;

                }else{

                }
            });
        });
    });
</script>
@endsection
