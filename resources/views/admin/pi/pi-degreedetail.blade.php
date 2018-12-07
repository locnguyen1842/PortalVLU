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
    <div class="panel panel-default">
        <div class="panel-heading">Danh sách thông tin cá nhân <br>
            <a href="{{route('admin.pi.degree.detail')}}">
                <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
            </a>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <form class="form-horizontal" action="{{route('admin.pi.index')}}" method="get">
                    <div class="col-sm-4">
                        <div class="col-sm-4">
                            <label class="control-label">Tìm kiếm</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="">
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
                        <label class="control-label col-sm-4">Chọn tệp</label>
                        <div class="col-sm-8">

                            <input type="file" id="excel-import" class="custom-file-input excel-default col-sm-4">
                            <button type="submit" name="button" class="btn btn-danger">Tải lên</button>
                        </div>
                    </div>
                </form>
                @if($search !="")
                    <div class="col-sm-4">
                        <div class="col-sm-4">
                            <label class="control-label">Tìm theo </label>
                        </div>
                        <div class="col-sm-8">
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
                @foreach ($pis as $item)
                    <tr>
                        <th class="col-sm-2"> <a href="{{route('admin.pi.detail',$item->id)}}"> {{$item->employee_code}}</a></th>
                        <td class="col-sm-3">{{$item->full_name}}</td>
                        <td class="col-sm-2">{{$item->identity_card}}</td>
                        <td class="col-sm-2">{{date('d-m-Y', strtotime($item->date_of_birth))}}</td>
                        <td class="col-sm-3"> <a href="{{route('admin.pi.update',$item->id)}}"> <i class="fa fa-lg fa-edit"></i></a></td>

                    </tr>
                @endforeach

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
        });
    </script>
@endsection
