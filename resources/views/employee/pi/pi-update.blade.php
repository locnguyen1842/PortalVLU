@extends('employee.master')
@section('title','Cập nhật thông tin nhân viên')
@section('breadcrumb')
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    {{-- <li><a href="#">Home</a></li> --}}
                    <li><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                    <li class="active">Cập nhật thông tin cá nhân</li>
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
        <div class="panel-heading">Cập nhật thông tin cá nhân</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('employee.pi.update')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input required type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{$pi->employee_code}}" readonly="readonly">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input required type="text" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{$pi->full_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Dân tộc</label>
                        <select required class="form-control" name="nation">
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
                                <input required type="radio" name="gender" value="0"{{$pi->gender ==0 ? "checked":""}}>Male
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="1"{{$pi->gender ==1 ? "checked":""}}>Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input required required type="date" min="1900-01-01" class="form-control" name="date_of_birth" value="{{$pi->date_of_birth}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi sinh</label>
                        <input required type="text" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{$pi->place_of_birth}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        @if($pi->permanent_address()->exists() && $pi->contact_address()->exists())
                        <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="">Địa chỉ thường trú</label>
                                    <input  type="text" maxlength="100" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{ $pi->permanent_address->address_content }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Tỉnh/Thành phố </label>
                                    <select required class="form-control" id="province_1" name="province_1">
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        @foreach($provinces as $item)
                                        <option {{ $item->code == $pi->permanent_address->province->code ? 'selected':'' }} value="{{$item->code}}">{{$item->name_with_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Quận/huyện</label>
                                    <select required class="form-control" id="district_1" name="district_1">
                                        <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Phường/xã</label>
                                    <select required class="form-control" id="ward_1" name="ward_1">
                                        <option value="">Vui lòng chọn quận/huyện</option>
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="">Địa chỉ thường trú</label>
                                    <input  type="text" maxlength="100" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{old('permanent_address')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Tỉnh/Thành phố </label>
                                    <select required class="form-control" id="province_1" name="province_1">
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        @foreach($provinces as $item)
                                        <option value="{{$item->code}}">{{$item->name_with_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Quận/huyện</label>
                                    <select required class="form-control" id="district_1" name="district_1">
                                        <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Phường/xã</label>
                                    <select required class="form-control" id="ward_1" name="ward_1">
                                        <option value="">Vui lòng chọn quận/huyện</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        @if($pi->permanent_address()->exists() && $pi->contact_address()->exists())
                        <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="">Địa chỉ tạm trú</label>
                                    <input type="text" maxlength="100" class="form-control" name="contact_address" placeholder="Nhập địa chỉ tạm trú" value="{{ $pi->contact_address->address_content }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Tỉnh/Thành phố </label>
                                    <select required class="form-control" id="province_2" name="province_2">
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        @foreach($provinces as $item)
                                        <option {{ $item->code == $pi->contact_address->province->code ? 'selected':'' }} value="{{$item->code}}">{{$item->name_with_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Quận/huyện</label>
                                    <select required class="form-control" id="district_2" name="district_2">
                                        <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Phường/xã</label>
                                    <select required class="form-control" id="ward_2" name="ward_2">
                                        <option value="">Vui lòng chọn quận/huyện</option>
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Địa chỉ tạm trú</label>
                                <input type="text" maxlength="100" class="form-control" name="contact_address" placeholder="Nhập địa chỉ tạm trú" value="{{old('contact_address')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="">Tỉnh/Thành phố </label>
                                <select required class="form-control" id="province_2" name="province_2">
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    @foreach($provinces as $item)
                                    <option value="{{$item->code}}">{{$item->name_with_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Quận/huyện</label>
                                <select required class="form-control" id="district_2" name="district_2">
                                    <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Phường/xã</label>
                                <select required class="form-control" id="ward_2" name="ward_2">
                                    <option value="">Vui lòng chọn quận/huyện</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input required type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{$pi->phone_number}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ Email</label>
                        <input required type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{$pi->email_address}}">
                    </div>

                </div>
                
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chứng minh nhân dân</label>
                        <input required type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{$pi->identity_card}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input required type="text" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$pi->place_of_issue   }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        <input required required type="date" min="1900-01-01" class="form-control" name="date_of_issue" value="{{$pi->date_of_issue}}">
                    </div>
                    
                </div>
                
                
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        $(document).ready(function(){
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
