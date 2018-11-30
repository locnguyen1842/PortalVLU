@extends('master')
@section('title','Thêm mới thông tin nhân viên')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Danh sách thông tin cá nhân</div>
    <div class="panel-body">

            <div class="form-group">
              <form class="form-horizontal" action="{{route('pi.index')}}" method="get">
                <div class="col-sm-4">
                    <div class="col-sm-4">
                        <label class="control-label">Tìm kiếm</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Nhập mã nv">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Tìm</button>
                            </span>
                        </div>
                    </div>
                </div>
              </form>
              <div class="col-sm-4">
              </div>
              <form class="form-horizontal" action="index.html" method="post">
                <div class="col-sm-4">
                  <label class="control-label col-sm-4">Import</label>
                  <div class="col-sm-8">

                      <input type="file" id="excel-import" class="custom-file-input excel-default col-sm-4">
                      <button type="submit" name="button" class="btn btn-danger">Import</button>
                  </div>
                </div>
              </form>
            </div>
            @if($search !="")
            <div class="col-sm-4">
                <div class="col-sm-4">
                    <label class="control-label">Tìm theo </label>
                </div>
                <div class="col-sm-8">
                  <div class="">
                  <a  data-toggle="tooltip" data-placement="right" title="" data-original-title="Xóa" href="javascript:" class="search_tag tooltip-test">
                    <span class="badge badge-primary">Mã nv : {{$search}}
                      <span class="mdi mdi-close"></span>
                    </span>
                  </a>
                </div>
                </div>
            </div>
          @endif
        <table class="table table-hover" style="margin-bottom:0">
            <thead>
                <tr>

                    <th>Mã NV</th>
                    <th>Họ Tên</th>
                    <th>Ngày Sinh</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($pis as $item)
                <tr>
                    <th>{{$item->employee_code}}</th>
                    <td>{{$item->full_name}}</td>
                    <td>{{$item->date_of_birth}}</td>
                    <td>action</td>
                </tr>
              @endforeach

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(".search_tag").on('click',function(){
          var url = {!!json_encode(route('pi.index'),JSON_UNESCAPED_SLASHES)!!};
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
    });
</script>
@endsection
