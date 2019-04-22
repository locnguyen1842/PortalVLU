@extends('admin.master')
@section('title','Cập nhật đơn xác nhận')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.confirmation.index')}}">Danh sách đơn xác nhận</a></li>
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
                @include('admin.layouts.Error')
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form class="form-horizontal" action="{{route('admin.confirmation.update',$cr->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="panel panel-default">
                            <div class="panel-heading">Thông tin cá nhân<br>
                                <a href="{{route('admin.pi.update',$pi->id)}}" target="_blank">
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
                                    <label for="">Lý do</label>
                                    <input require type="text" class="form-control" name="reason" value="{{$cr->reason}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    @if($pi->permanent_address()->exists() && $pi->contact_address()->exists())
                                    <label for="">Địa chỉ</label>
                                    <select require class="form-control" name="address" id="">
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
                                    <label for="" class="text-danger">Không tìm thấy bất cứ địa chỉ cá nhân nào ( vui lòng cập nhật <a href="{{route('admin.pi.update')}}">tại đây</a> )</label>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Người xác nhận<br>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="">Người ký I</label>
                                    <input require type="text" class="form-control" name="first_signer" value="{{$cr->first_signer}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Người ký II</label>
                                    <input require type="text" class="form-control" name="second_signer" value="{{$cr->second_signer}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="">Tên Người ký</label>
                                    <input require type="text" class="form-control" name="name_of_signer" value="{{$cr->name_of_signer}}">
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


<script type="text/javascript">
    $(document).ready(function(){
        var teacher_type = $('select[name=teacher_type]');
        var is_retired = $('input[type=radio][name=is_retired]:checked');

        teacherType(teacher_type);
        isRetired(is_retired);
        teacher_type.on('change', function () {
            teacherType($(this));
        })

        $('input[type=radio][name=is_retired]').on('change', function (e) {
            isRetired($(this));

        })

        function isRetired(element) {
            if (element.val() == 0) {

                $('input[name=date_of_retirement]').prop('disabled', true);
            } else {
                $('input[name=date_of_retirement]').prop('disabled', false);
            }
        }

        function teacherType(element) {
            if (element.val() == 0) {

                $('.dependent-on-teacher').addClass('hide');
                $('.dependent-on-teacher :input').not('input[name=date_of_retirement]').prop('disabled', true);

            } else {
                $('.dependent-on-teacher').removeClass('hide');
                $('.dependent-on-teacher :input').not('input[name=date_of_retirement]').prop('disabled', false);

            }
        }
        if('{{ $pi->permanent_address()->exists() && $pi->contact_address()->exists() }}' == true){
            var province_code_1 = $('#province_1').val();
            $.get('{{route('res.districts')}}' + '?province_code=' + province_code_1,
            function(data) {
                $('#district_1').empty();
                $('#district_1').append('<option value="" disabled>Chọn quận/huyện</option>');
                $.each(data, function(index, district) {
                    $('#district_1').append('<option data-old-1="old-'+district.code+'" value="' + district.code + '">' + district.name_with_type + '</option>');
                    var district_1 = '{{ $pi->permanent_address()->exists() ? $pi->permanent_address->district->code :'' }}'

                    if(district.code == district_1){
                        $('option[data-old-1="old-'+district.code+'"]').prop('selected',true);
                    }

                });
            });
            var district_code_1 = '{{ $pi->permanent_address()->exists() ? $pi->permanent_address->district->code :'' }}';
            $.get('{{route('res.wards')}}' + '?district_code=' + district_code_1,
            function(data) {
                $('#ward_1').empty();
                $('#ward_1').append('<option value="" disabled>Chọn phường/xã</option>');
                $.each(data, function(index, ward) {
                    $('#ward_1').append('<option data-old-1="old-'+ward.code+'" value="' + ward.code + '">' + ward.name_with_type + '</option>');
                    var ward_1 = '{{ $pi->permanent_address()->exists() ? $pi->permanent_address->ward->code : ''}}';

                    if(ward.code == ward_1){
                        $('option[data-old-1="old-'+ward.code+'"]').prop('selected',true);
                    }
                });
            });

            var province_code_2 = $('#province_2').val();
            $.get('{{route('res.districts')}}' + '?province_code=' + province_code_2,
            function(data) {
                    $('#district_2').empty();
                    $('#district_2').append('<option value="" disabled>Chọn quận/huyện</option>');
                    $.each(data, function(index, district) {
                        $('#district_2').append('<option data-old-2="old-'+district.code+'" value="' + district.code + '">' + district.name_with_type + '</option>')
                        var district_2 = '{{ $pi->contact_address()->exists() ? $pi->contact_address->district->code:'' }}'

                        if(district.code == district_2){
                            $('option[data-old-1="old-'+district.code+'"]').prop('selected',true);
                        }
                });
            });

            var district_code_2 = '{{ $pi->contact_address()->exists() ? $pi->contact_address->district->code :'' }}';
            $.get('{{route('res.wards')}}' + '?district_code=' + district_code_2,
            function(data) {
                $('#ward_2').empty();
                $('#ward_2').append('<option value="" disabled>Chọn phường/xã</option>');
                $.each(data, function(index, ward) {
                    $('#ward_2').append('<option data-old-2="old-'+ward.code+'"  value="' + ward.code + '">' + ward.name_with_type + '</option>')
                    var ward_2 = '{{ $pi->contact_address()->exists() ? $pi->contact_address->ward->code :'' }}';

                        if(ward.code == ward_2){
                            $('option[data-old-2="old-'+ward.code+'"]').prop('selected',true);
                        }
                });
            });
    }


    });
        $('#province_1').on('change', function(e) {
            var province_code = e.target.value;
            $.get('{{route('res.districts')}}' + '?province_code=' + province_code,
                function(data) {
                    $('#district_1').empty();
                    $('#district_1').append('<option value="" disabled selected>Chọn quận/huyện</option>');
                    $.each(data, function(index, district) {
                        $('#district_1').append('<option data-old-1="old-'+district.code+'" value="' + district.code + '">' + district.name_with_type + '</option>');


                    });
                });
        });
        $('#district_1').on('change', function(e) {
            var district_code = e.target.value;
            $.get('{{route('res.wards')}}' + '?district_code=' + district_code,
                function(data) {
                    $('#ward_1').empty();
                    $('#ward_1').append('<option value="" disabled selected>Chọn phường/xã</option>');
                    $.each(data, function(index, ward) {
                        $('#ward_1').append('<option data-old-1="old-'+ward.code+'" value="' + ward.code + '">' + ward.name_with_type + '</option>');

                    });
                });
        });
        $('#province_2').on('change', function(e) {
            var province_code = e.target.value;
            $.get('{{route('res.districts')}}' + '?province_code=' + province_code,
                function(data) {
                    $('#district_2').empty();
                    $('#district_2').append('<option value="" disabled selected>Chọn quận/huyện</option>');
                    $.each(data, function(index, district) {
                        $('#district_2').append('<option value="' + district.code + '">' + district.name_with_type + '</option>')
                    });
                });


        });


        $('#district_2').on('change', function(e) {
            var district_code = e.target.value;
            $.get('{{route('res.wards')}}' + '?district_code=' + district_code,
                function(data) {
                    $('#ward_2').empty();
                    $('#ward_2').append('<option value="" disabled selected>Chọn phường/xã</option>');
                    $.each(data, function(index, ward) {
                        $('#ward_2').append('<option value="' + ward.code + '">' + ward.name_with_type + '</option>')
                    });
                });
        });


</script>
    @endsection
