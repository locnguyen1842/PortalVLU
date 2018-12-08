@extends('admin.master')
@section('title','Thêm mới thông tin nhân viên')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                <li class="active">Thêm thông tin nhân viên</li>
            </ol>
        </div>
    </div>
</nav>
@endsection
@section('content')
@include('admin.layouts.Error')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Thêm thông tin cá nhân</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.add')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{old('employee_code')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input type="text" maxlength="60" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{old('full_name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Dân tộc</label>
                        <input type="text" class="form-control" name="nation" placeholder="Nhập dân tộc" value="{{old('nation')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Giới tính</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input type="radio" name="gender" value="0" checked>Nam
                            </label>
                            <label class="col-sm-4">
                                <input type="radio" name="gender" value="1">Nữ
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control" name="date_of_birth" value="{{old('date_of_birth')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi sinh</label>
                        <input type="text" maxlength="100" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{old('place_of_birth')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Địa chỉ thường trú</label>
                        <input type="text" maxlength="100" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{old('permanent_address')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ liên lạc</label>
                        <input type="text" maxlength="100" class="form-control" name="contact_address" placeholder="Nhập địa chỉ liên lạc" value="{{old('contact_address')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{old('phone_number')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ Email</label>
                        <input type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{old('email_address')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <input type="text" class="form-control" name="position" placeholder="Nhập chức vụ" value="{{old('position')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Ngày tuyển dụng</label>
                        <input type="date" class="form-control" name="date_of_recruitment" value="{{old('date_of_recruitment')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức danh chuyên môn</label>
                        <input type="text" class="form-control" name="professional_title" placeholder="Nhập chức danh chuyên môn" value="{{old('professional_title')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Chứng minh nhân dân</label>
                        <input type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{old('identity_card')}}">
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
