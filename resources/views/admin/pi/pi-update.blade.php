@extends('admin.master')
@section('title','Cập nhật thông tin nhân viên')
@section('breadcrumb')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                <li class="active">Cập nhật thông tin nhân viên</li>
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
        <div class="panel-heading">Cập nhật thông tin cá nhân</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.update',$pi->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{$pi->employee_code}}" readonly="readonly">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input type="text" maxlength="60" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{$pi->full_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                      <label>Dân tộc</label>
                      <select class="form-control" name="nation">
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
                                <input type="radio" name="gender" value="0" {{$pi->gender ==0 ? "checked":""}}>Nam
                            </label>
                            <label class="col-sm-4">
                                <input type="radio" name="gender" value="1" {{$pi->gender ==1 ? "checked":""}}>Nữ
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control" name="date_of_birth" value="{{$pi->date_of_birth}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi sinh</label>
                        <input type="text" maxlength="100" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{$pi->place_of_birth}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Địa chỉ thường trú</label>
                        <input type="text" maxlength="100" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{$pi->permanent_address}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ liên lạc</label>
                        <input type="text" maxlength="100" class="form-control" name="contact_address" placeholder="Nhập địa chỉ liên lạc" value="{{$pi->contact_address}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{$pi->phone_number}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ Email</label>
                        <input type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{$pi->email_address}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <input type="text" class="form-control" name="position" placeholder="Nhập chức vụ" value="{{$pi->position}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Ngày tuyển dụng</label>
                        <input type="date" class="form-control" name="date_of_recruitment" value="{{$pi->date_of_recruitment}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức danh chuyên môn</label>
                        <input type="text" class="form-control" name="professional_title" placeholder="Nhập chức danh chuyên môn" value="{{$pi->professional_title}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Đơn vị</label>
                        <input type="text" class="form-control" name="unit" placeholder="Nhập đơn vị" value="{{$pi->unit}}">
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                      <label>Chứng minh nhân dân</label>
                      <input type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{$pi->identity_card}}">
                  </div>
                  <div class="col-sm-6">
                      <label>Ngày cấp</label>
                      <input type="date" class="form-control" name="date_of_issue" value="{{$pi->date_of_issue}}">
                  </div>

                </div>
                <div class="form-group">

                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$pi->place_of_issue   }}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
    {{--@section('script')--}}
    {{--<script src="{{asset('js/backend-js/ckeditor5-build-classic/ckeditor.js')}}" charset="utf-8"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--if('{{Session::has('success_message')}}' == 1){--}}
    {{--var success_message = $.gritter.add({--}}
    {{--// (string | mandatory) the heading of the notification--}}
    {{--title: 'Success!',--}}
    {{--// (string | mandatory) the text inside the notification--}}
    {{--text: '{{ session()->get('message') }}.<a href="{{route()}}">Click here to view.</a>',--}}
    {{--// (string | optional) the image to display on the left--}}
    {{--// image: '{{asset('img/backend-img')}}//ui-sam.jpg',--}}
    {{--// (bool | optional) if you want it to fade out on its own or just sit there--}}
    {{--sticky: false,--}}
    {{--// (int | optional) the time you want it to be alive for before fading out--}}
    {{--time: '2000',--}}
    {{--// (string | optional) the class name you want to apply to that specific message--}}
    {{--class_name: 'my-sticky-class'--}}
    {{--});--}}
    {{--};--}}

    {{--</script>--}}


    {{--@endsection--}}
