@extends('admin.master')
@section('title','Cập nhật bằng cấp')
@section('breadcrumb')
    <nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                    <li class=""><a href="{{route('admin.pi.detail',$pi->id)}}">Chi tiết thông tin nhân viên</a></li>
                    <li class=""><a href="{{route('admin.pi.degree.index',$pi->id)}}">Danh sách bằng cấp</a></li>
                    <li class="active">Cập nhật bằng cấp</li>
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
                        <select class="form-control" name="degree">
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
                      <select class="form-control" name="specialized">
                        <option value="">Chọn chuyên ngành</option>
                          @foreach($specializes as $s)
                            <option {{$degree->specialized_id == $s->id ? 'selected':''}} value="{{$s->id}}">{{$s->name}}</option>
                          @endforeach
                      </select>

                  </div>
                    <div class="col-sm-6">
                        <label>Khối ngành</label>
                        <select class="form-control" name="industry">
                            @foreach($industries as $i)
                                <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        {{--@foreach($degrees as $i)--}}
                           {{--<option value="{{$i->id}}">{{$i->date_of_issue}}</option>--}}
                        {{--@endforeach--}}
                        <input type="date" class="form-control" name="date_of_issue" value="{{$degree->date_of_issue}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$degree->place_of_issue}}">
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
