@extends('employee.master')
@section('title','Chi tiết bằng cấp')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Chi tiết bằng cấp</li>
            </ol>
        </div>
    </div>
</nav>
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Chi tiết bằng cấp<br>
        <a href="{{route('employee.pi.update.degree',$pi->id)}}">
            <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" action="{{route('employee.pi.degreedetail',1)}}" method="get" style="margin-bottom:0">
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
            @foreach($degrees as $degree)
                    <tr>
                    <td class="col-sm-2">{{$degree->degree->name}}</td>
                    <td class="col-sm-2">{{$degree->industry->name}}</td>
                    <td class="col-sm-2">{{date('d-m-Y', strtotime($degree->date_of_issue))}}</td>
                        {{--{{date('d-m-Y',($degree->date_of_issue))}}--}}
                    <td class="col-sm-2">{{$degree->place_of_issue}}</td>
                        <td class="col-sm-3">
                            <a href="{{route('employee.pi.update.detail.degree', $degree->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test">
                          <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                            </a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa" href="javascript:" class="delete_pi tooltip-test ml-10">
                          <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                            </a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--<div class="panel-footer">--}}

        {{--{{$pis->links()}}--}}
    {{--</div>--}}
</div>
{{--<script type="text/javascript">--}}
    {{--$(document).ready(function() {--}}

        {{--$(".search_tag").on('click', function() {--}}
            {{--var url = {!!json_encode(route('admin.pi.index'), JSON_UNESCAPED_SLASHES) !!--}}
            {{--};--}}
            {{--var search = "";--}}
            {{--window.location.href = url;--}}
        {{--});--}}
        {{--$('#excel-import').on('change', function(e) {--}}
            {{--var val = $('#excel-import').val();--}}
            {{--if (val == '') {--}}
                {{--$('#excel-import').removeClass('excel-after');--}}
                {{--$('#excel-import').addClass('excel-default');--}}
            {{--} else {--}}
                {{--$('#excel-import').removeClass('excel-default');--}}
                {{--$('#excel-import').addClass('excel-after');--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
@endsection
