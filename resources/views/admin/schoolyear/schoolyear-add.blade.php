@extends('admin.master')
@section('title','Thêm mới thông tin nhân viên')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class=""><a href="{{route('admin.schoolyear.index')}}">Quản lý năm học</a></li>
                <li class="active">Thêm năm học</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
@include('admin.layouts.Error')
@if(session()->has('message'))
    <div class="alert alert-success mt-10">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Thêm năm học</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.schoolyear.add')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Năm bắt đầu</label>
                        <input required type="number" class="form-control" name="start_year" placeholder="Nhập năm bắt đầu">
                    </div>
                    <div class="col-sm-6">
                        <label>Năm kết thúc</label>
                        <input required type="number" class="form-control" name="end_year" placeholder="Nhập năm kết thúc" >
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
