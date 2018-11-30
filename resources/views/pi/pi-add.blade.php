@extends('master')
@section('title','Thêm mới thông tin nhân viên')
@section('breadcrumb')
  @include('layouts.breadcrumb')
@endsection
@section('content')
  <div class="panel panel-default">
      <div class="panel-heading">Thêm thông tin cá nhân</div>
      <div class="panel-body">
          <form class="form-horizontal">
              <div class="form-group">
                  <div class="col-sm-6">
                    <label>Mã nhân viên</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="họ tên">
                  </div>
                  <div class="col-sm-6">
                    <label>Giới tính</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Ngày sinh</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Nơi sinh</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ thường trú</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ liên lạc</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ liên lạc</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ liên lạc</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ liên lạc</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ liên lạc</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>
                  <div class="col-sm-6">
                    <label>Địa chỉ liên lạc</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
                  </div>

              </div>
              <div class="form-group">


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
