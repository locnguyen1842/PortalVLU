@extends('employee.master')
@section('title','Cập nhật thông tin nhân viên')
@section('breadcrumb')
    <nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                    <li class="active">Cập nhật thông tin cá nhân</li>
                </ol>
            </div>
        </div>
    </nav>
@endsection
@section('content')
    @include('employee.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Cập nhật thông tin cá nhân</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('employee.pi.update')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input required type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{$pi->employee_code}}" readonly="readonly">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input required type="text" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{$pi->full_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Dân tộc</label>
                        <select required class="form-control" name="nation">
                            <option value="">Chọn dân tộc</option>
                            @foreach($nations as $nation)
                            <option {{$pi->nation_id == $nation->id ? 'selected' : ''}} value="{{$nation->id}}">{{$nation->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Giới tính</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="0"{{$pi->gender ==0 ? "checked":""}}>Male
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="1"{{$pi->gender ==1 ? "checked":""}}>Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input required required type="date" min="1900-01-01" class="form-control" name="date_of_birth" value="{{$pi->date_of_birth}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi sinh</label>
                        <input required type="text" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{$pi->place_of_birth}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Địa chỉ thường trú</label>
                        <input required type="text" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{$pi->permanent_address}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ liên lạc</label>
                        <input required type="text" class="form-control" name="contact_address" placeholder="Nhập địa chỉ liên lạc" value="{{$pi->contact_address}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input required type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{$pi->phone_number}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ Email</label>
                        <input required type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{$pi->email_address}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <input required readonly type="text" class="form-control" name="position" placeholder="Nhập chức vụ" value="{{$pi->position}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Ngày tuyển dụng</label>
                        <input required readonly required type="date" min="1900-01-01" class="form-control" name="date_of_recruitment" value="{{$pi->date_of_recruitment}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức danh chuyên môn</label>
                        <input required readonly type="text" class="form-control" name="professional_title" placeholder="Nhập chức danh chuyên môn" value="{{$pi->professional_title}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Đơn vị</label>
                        <input required readonly type="text" class="form-control" name="unit" value="{{$pi->unit->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chứng minh nhân dân</label>
                        <input required type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{$pi->identity_card}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input required type="text" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$pi->place_of_issue   }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        <input required required type="date" min="1900-01-01" class="form-control" name="date_of_issue" value="{{$pi->date_of_issue}}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
