@extends('employee.master')
@section('title','Cập nhật đơn xác nhận')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            <li><a href="{{route('employee.confirmation.index')}}">Danh sách đơn xác nhận</a></li>
               <li class="active">Cập nhật đơn xác nhận</li>
        </ol>
    </div>
</div>

@endsection
@section('content')
<div style="padding-top: 21px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-12">
                @include('employee.layouts.Error')
                @if(session()->has('message'))
                <div class="alert alert-success mt-10">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form class="form-horizontal" action="{{route('employee.confirmation.update',$cr->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="panel panel-default">
                            <div class="panel-heading">Thông tin cá nhân<br>
                                <a href="{{route('employee.pi.update')}}" target="_blank">
                                    <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                                </a>
                            </div>
                        <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                            <label for="">Họ tên</label>
                                            <input readonly type="text" class="form-control" value="{{$pi->full_name}}">
                                    </div>
                                    <div class="col-sm-6">
                                            <label for="">Ngày sinh, Nơi sinh</label>
                                            <input readonly type="text" class="form-control" value="{{date('d/m/Y', strtotime($pi->date_of_birth)).', tại '.$pi->place_of_birth}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="col-sm-6">
                                                <label for="">CMND</label>
                                                <input readonly type="text" class="form-control" value="{{$pi->identity_card}}">
                                        </div>
                                        <div class="col-sm-6">
                                                <label for="">Ngày cấp</label>
                                                <input readonly type="text" class="form-control" value="{{$pi->date_of_issue}}">
                                        </div>
                                    </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin yêu cầu xác nhận<br>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="">Lý do <span style="color: red">*</span></label>
                                    <input required type="text" class="form-control" name="confirmation" value="{{$cr->confirmation}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    @if($pi->permanent_address()->exists() && $pi->contact_address()->exists())
                                    <label for="">Địa chỉ (sẽ in ra trong giấy xác nhận) <span style="color: red">*</span></label>
                                    <select required class="form-control" name="address" id="">
                                        <option value="" >Chọn địa chỉ</option>

                                        <option {{ $pi->contact_address->id == $cr->address_id ? 'selected':'' }}
                                            value="{{ $pi->contact_address->id }}">
                                            Địa chỉ tạm trú:
                                            {{$pi->contact_address->address_content}},
                                            {{$pi->contact_address->ward->path_with_type}}</option>
                                        <option {{ $pi->permanent_address->id == $cr->address_id ? 'selected':'' }}
                                            value="{{ $pi->permanent_address->id }}">
                                            Địa chỉ thường trú:
                                            {{$pi->permanent_address->address_content}},
                                            {{$pi->permanent_address->ward->path_with_type}}</option>

                                    </select>
                                    @else
                                    <label for="">Địa chỉ</label><br>
                                    <label for="" class="text-danger">Không tìm thấy bất cứ địa chỉ cá nhân nào ( vui lòng cập nhật <a href="{{route('employee.pi.update')}}">tại đây</a> )</label>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox">
                                            <label>
                                                <input {{$cr->is_confirm_income == 1 ? 'checked' : ''}} type="checkbox" name="is_confirm_income">
                                                Xác nhận thu nhập trong
                                            </label>
                                            <input class="input-on-checkbox" min="0" oninput="this.value = Math.abs(this.value)" type="number" name="number_of_month_income" value="{{$cr->number_of_month_income}}"> tháng gần nhất
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group" style="margin-bottom:0">
                                <div class="col-sm-offset-2 col-sm-10 text-right">
                                    <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                                    <button type="submit" class="btn btn-primary">Xác Nhận</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>


        <script>
                $(document).ready(function(){

                    checkedInput();
                    $('input[name=is_confirm_income]').on('click',function(){
                        checkedInput();
                    })

                    function checkedInput(){
                        if($('input[name=is_confirm_income]:checked').val() == 'on'){
                        $('input[name=number_of_month_income]').prop('required',true);
                        $('input[name=number_of_month_income]').prop('disabled',false);
                    }else{
                        $('input[name=number_of_month_income]').prop('disabled',true);
                        $('input[name=number_of_month_income]').prop('required',false);
                        $('input[name=number_of_month_income]').val('');

                    }
                    }

                });
            </script>
    @endsection
