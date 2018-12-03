@extends('master')
@section('title','Xem chi tiết thông tin cá nhân')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
@section('content')
  @include('layouts.Error')
  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
  <div id="" style="padding-top: 20px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-7">
                <div class="col-sm-12">
                        <div class="panel panel-default">
                                <div class="panel-heading">Thông tin cá nhân</div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label ">Mã nhân viên</label>
                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3 control-label ">Họ và tên</label>
                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                            </div>
                                            
                                        <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3 control-label ">Ngày sinh </label>
                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                            </div>
                                            
                                       
                                        <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3  control-label">Nơi sinh </label>
                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                            </div>
                                        <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3 control-label ">Giới tính </label>
                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                            </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label ">Dân tộc </label>
                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                        </div>
                                        
                                       
                                    </form>
                                </div>
                            </div>
                </div>
                <div class="col-sm-12">
                        <div class="panel panel-default">
                                <div class="panel-heading">Thông tin liên hệ</div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                            <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label ">Địa chỉ Email </label>
                                                    <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                                </div>
                                                <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-3  control-label">Số điện thoại </label>
                                                        <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                                    </div>
                                                    <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-3 control-label ">Địa chỉ liên lạc </label>
                                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="inputPassword3" class="col-sm-3 control-label ">Địa chỉ thường trú </label>
                                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                                            </div>
                            
            
                                    </form>
                                </div>
                            </div>
                </div>
                <div class="col-sm-12">
                        <div class="panel panel-default">
                                <div class="panel-heading">Thông tin nghề nghiệp</div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label ">Chức vụ </label>
                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label ">Chức danh chuyên môn </label>
                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                        </div>
                                        <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3 control-label ">Ngày tuyển dụng </label>
                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                            </div>
            
                                    </form>
                                </div>
                            </div>
                </div>
                
            </div>
            
            <div class="col-sm-5">
                <div class="col-sm-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">Thông tin xác thực</div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label ">CMND </label>
                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label ">Ngày cấp </label>
                                            <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                        </div>
                                        <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3 control-label ">Nơi cấp </label>
                                                <label for="" class="col-sm-9 control-label text-al">T154725</label>
                                            </div>
                                        {{-- <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3  ">Bằng Cấp </label>
                                             
                                                 
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                </div>
               <div class="col-sm-12">
                    <div class="panel panel-default">
                            <div class="panel-heading">Thông tin bằng cấp</div>
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label ">Số bằng đại học </label>
                                        <label for="" class="col-sm-8 control-label text-al">T154725</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Số bằng thạc sĩ </label>
                                        <label for="" class="col-sm-8 control-label text-al">T154725</label>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label ">Số bằng tiến sĩ </label>
                                        <label for="" class="col-sm-8 control-label text-al">T154725</label>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
               </div>
               <div class="col-sm-12">
                    <div class="panel panel-default">
                            <div class="panel-heading">Thông tin tài khoản</div>
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Tên tài khoản</label>
                                        <label for="" class="col-sm-8 control-label text-al">T154725</label>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Mật khẩu </label>
                                        <label for="" class="col-sm-8 control-label text-al">T154725</label>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
               </div>
            </div>
           
        </div>    
    </div>
</div>
@endsection
