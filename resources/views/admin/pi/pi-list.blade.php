@extends('admin.master')
@section('title','Danh sách thông tin cá nhân')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Quản lý thông tin cá nhân</li>
            </ol>
        </div>
    </div>
</nav>
@endsection
@section('content')
@include('employee.layouts.Error')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">Danh sách thông tin cá nhân <br>
        <a href="{{route('admin.pi.add')}}">
            <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
        </a>
    </div>
    <div class="panel-body">
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
            <form class="form-horizontal" action="{{route('admin.pi.import')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-sm-4">
                    <label class="control-label col-sm-4">Chọn tệp</label>
                    <div class="col-sm-8">

                        <input type="file" id="excel-import"  name="import_file" class="custom-file-input excel-default col-sm-4">
                        <button type="submit" name="button" class="btn btn-danger">Tải lên</button>
                    </div>
                </div>
            </form>
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
    </div>

    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0">
            <thead>
                <tr>

                    <th>Mã NV</th>
                    <th>Họ Tên</th>
                    <th>CMND</th>
                    <th>Ngày Sinh</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @if($pis->where('show',1)->count() >0)
                @foreach ($pis->where('show',1) as $item)

                <tr>
                    <th class="col-sm-1">

                        <a href="{{route('admin.pi.detail',$item->id)}}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Chi tiết" href="javascript:" class="search_tag tooltip-test">
                            <span class="badge badge-danger">{{$item->employee_code}}
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </th>
                    <td class="col-sm-3">{{$item->full_name}}</td>
                    <td class="col-sm-2">{{$item->identity_card}}</td>
                    <td class="col-sm-2">{{date('d-m-Y', strtotime($item->date_of_birth))}}</td>
                    <td class="col-sm-3">
                      <a href="{{route('admin.pi.update',$item->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="javascript:" class="tooltip-test">
                          <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                      </a>
                      <a href="{{route('admin.pi.delete',$item->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa" href="javascript:" class="delete_pi tooltip-test ml-10">
                          <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                      </a>
                     </td>

                </tr>
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

      {{$pis->links()}}
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(".search_tag").on('click', function() {
            var url = {!!json_encode(route('admin.pi.index'), JSON_UNESCAPED_SLASHES) !!};
            var search = "";
            window.location.href = url;
        });
        $('#excel-import').on('change', function(e) {
            var val = $('#excel-import').val();
            if (val == '') {
                $('#excel-import').removeClass('excel-after');
                $('#excel-import').addClass('excel-default');
            } else {
                $('#excel-import').removeClass('excel-default');
                $('#excel-import').addClass('excel-after');
            }
        });

        $(".delete_pi").on('click',function (e) {

            e.preventDefault();
            $("#mi-modal").modal('show');
            var delete_pi_url = $(this).attr('href');
            var modalConfirm = function(callback){

                $("#modal-btn-si").on("click", function(){
                    callback(true);
                    $("#mi-modal").modal('hide');
                });

                $("#modal-btn-no").on("click", function(){
                    callback(false);
                    $("#mi-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm){
                if(confirm){
                    window.location.href = delete_pi_url;
                }else{

                }
            });
        });
    });
</script>
@endsection
