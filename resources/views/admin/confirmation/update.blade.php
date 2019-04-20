@extends('admin.master')
@section('title','Cập nhật thông tin bằng cấp')
@section('breadcrumb')
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin.pi.index')}}">Quản lý thông tin CBGV/NV</a></li>
                    <li><a href="{{route('admin.pi.detail',$pi->id)}}">Thông tin cá nhân - {{$pi->employee_code}}</a></li>

                    <li class="active">Cập nhật thông tin học hàm</li>
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
        <div class="panel-heading">Cập nhật thông tin học hàm</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.confirmation.update',$cr->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Bằng cấp</label>
                        <select required class="form-control" name="academic_rank_type">
                          <option value="">Chọn học hàm</option>
                            @foreach($academic_rank_types as $item)
                                <option value="{{$item->id}}" {{$item->id == $pi->academic_rank->type_id ? 'selected':''}}>{{$item->name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Chuyên ngành</label>
                        <input required type="text" maxlength="100" class="form-control" name="specialized" value="{{$pi->academic_rank->specialized}}" placeholder="Nhập chuyên ngành">

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
