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
    <div class="alert alert-success mt-10">
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
                        <input required type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{old('employee_code')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input required type="text" maxlength="60" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{old('full_name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Dân tộc</label>
                        <select required class="form-control" name="nation">
                            <option value="">Chọn dân tộc</option>
                            @foreach($nations as $nation)
                            <option value="{{$nation->id}}">{{$nation->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Giới tính</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="0" checked>Nam
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="1">Nữ
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input required type="date" min="1900-01-01" min="1900-01-01" class="form-control" name="date_of_birth" value="{{old('date_of_birth')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi sinh</label>
                        <input required type="text" maxlength="100" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{old('place_of_birth')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Địa chỉ thường trú</label>
                        <input required type="text" maxlength="100" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{old('permanent_address')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ liên lạc</label>
                        <input required type="text" maxlength="100" class="form-control" name="contact_address" placeholder="Nhập địa chỉ liên lạc" value="{{old('contact_address')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input required type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{old('phone_number')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ Email</label>
                        <input required type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{old('email_address')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <input required type="text" class="form-control" name="position" placeholder="Nhập chức vụ" value="{{old('position')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Ngày tuyển dụng</label>
                        <input required type="date" min="1900-01-01" class="form-control" name="date_of_recruitment" value="{{old('date_of_recruitment')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức danh chuyên môn</label>
                        <input required type="text" class="form-control" name="professional_title" placeholder="Nhập chức danh chuyên môn" value="{{old('professional_title')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Đơn vị</label>
                        <select required class="form-control" name="unit">
                            <option value="">Chọn đơn vị</option>
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                      <label>Chứng minh nhân dân</label>
                      <input required type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{old('identity_card')}}">
                  </div>
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        <input required type="date" min="1900-01-01" class="form-control" name="date_of_issue" value="{{old('date_of_issue')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input required type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{old('place_of_issue')}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Vai trò</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input required type="radio" name="role" value="0" checked>Nhân viên
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="role" value="1">Quản trị viên
                            </label>
                        </div>

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
