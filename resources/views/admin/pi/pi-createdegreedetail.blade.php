@extends('admin.master')
@section('title','Thêm bằng cấp')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                <li class=""><a href="{{route('admin.pi.detail',$pi->id)}}">Chi tiết thông tin nhân viên</a></li>
                <li class=""><a href="{{route('admin.pi.degree.index',$pi->id)}}">Danh sách bằng cấp</a></li>
                <li class="active">Thêm bằng cấp</li>
            </ol>
        </div>
    </div>
</nav>
@endsection

@section('content')
@include('admin.layouts.Error')
@if(session()->has('message'))
    <div class="alert alert-success mt-10">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Thêm bằng cấp</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.degree.create',$pi->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input type="text" readonly class="form-control" name="Mã nhân viên" value="{{$pi->employee_code}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Bằng cấp</label>
                        <select class="form-control" name="degree">
                            <option value="">Chọn bằng cấp</option>
                            @foreach($degrees as $d)
                            <option value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Khối ngành</label>
                        <select class="form-control" name="industry">
                            <option value="">Chọn khối ngành</option>
                            @foreach($industries as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        <input type="date" class="form-control" name="date_of_issue" value="{{old('date_of_issue')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{old('place_of_issue')}}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection