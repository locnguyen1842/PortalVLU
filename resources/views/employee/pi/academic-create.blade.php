@extends('employee.master')
@section('title','Thêm mới thông tin học hàm')
@section('breadcrumb')
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>

                    <li >Thêm mới thông tin học hàm</li>
                </ol>
            </div>
        </div>
@endsection

@section('content')
    @include('employee.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Thêm mới thông tin học hàm</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('employee.academic.create')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Bằng cấp</label>
                        <select required class="form-control" name="academic_rank_type">
                          <option value="">Chọn học hàm</option>
                            @foreach($academic_rank_types as $item)
                                <option value="{{$item->id}}" {{$item->id == old('academic_rank_type') ? 'selected':''}}>{{$item->name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Chuyên ngành</label>
                        <input required type="text" maxlength="100" class="form-control" name="specialized" value="{{old('specialized')}}" placeholder="Nhập chuyên ngành">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 pull-right">
                        <label>Ngày công nhận</label>
                    <input required type="date" min="1900-01-01" class="form-control" name="date_of_recognition" value="{{old('date_of_recognition')}}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
