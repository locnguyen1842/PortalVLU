@extends('admin.master')
@section('title','Cập nhật bằng cấp')
@section('breadcrumb')
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    {{-- <li><a href="#">Home</a></li> --}}
                    <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                    <li class=""><a href="{{route('admin.pi.detail',$pi->id)}}">Chi tiết thông tin nhân viên</a></li>
                    <li class=""><a href="{{route('admin.pi.degree.index',$pi->id)}}">Danh sách bằng cấp</a></li>
                    <li class="active">Cập nhật bằng cấp</li>
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
        <div class="panel-heading">Cập nhật bằng cấp</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.degree.update',$degree->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input type="text" readonly class="form-control" name="Mã nhân viên" value="{{$pi->employee_code}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Bằng cấp</label>
                        <select required class="form-control" name="degree">
                          <option value="">Chọn Bằng Cấp</option>

                            @foreach($degrees as $d)
                                @if($d->id == $degree->degree_id)
                                    <option selected value="{{$d->id}}">{{$d->name}}</option>
                                @else
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                      <label>Chuyên ngành</label>
                      <input required type="text" maxlength="100" class="form-control" name="specialized" value="{{$degree->specialized}}" placeholder="Nhập chuyên ngành">
                  </div>
                    <div class="col-sm-6">
                        <label>Khối ngành</label>
                        <select required class="form-control" name="industry">
                            <option value="">Chọn khối ngành</option>
                            @foreach($industries as $i)
                                <option {{$degree->industry_id == $i->id ? 'selected':''}} value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        <input required type="date" min="1900-01-01" class="form-control" name="date_of_issue" value="{{$degree->date_of_issue}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input required type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$degree->place_of_issue}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Nước cấp</label>
                        <select required class="form-control" name="nation_of_issue_id">
                            <option value="{{$degree->nation_of_issue_id}}">Chọn nước cấp</option>
                            @foreach($countries as $c)
                            <option value="{{$c->id}}">{{$c->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Loại bằng</label>
                        <input required type="text" maxlength="100" class="form-control" name="degree_type" placeholder="Nhập loại bằng" value="{{$degree->degree_type}}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
