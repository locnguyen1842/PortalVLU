@extends('master')
@section('title','Thêm mới thông tin nhân viên')
@section('breadcrumb')
  @include('layouts.breadcrumb')
@endsection
@section('content')
  <div class="panel panel-default">
      <div class="panel-heading">Cập nhật thông tin</div>
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
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <label>Cai gì đó</label>
                  <input type="text" class="form-control" id="inputEmail3" placeholder="ma nhan vien">
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
