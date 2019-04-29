@extends('admin.master')
@section('title','Cập nhật thông tin CBGV/NV')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin CBGV/NV</a></li>
                <li class=""><a href="{{route('admin.pi.detail',$pi->id)}}">Thông tin cá nhân - {{$pi->employee_code}}</a></li>

                <li class="active">Cập nhật thông tin CBGV/NV</li>
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
        <div class="panel-heading">Cập nhật thông tin cá nhân</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.update',$pi->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input required type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{$pi->employee_code}}" readonly="readonly">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input required type="text" maxlength="60" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{$pi->full_name}}">
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
                      <label>Tôn giáo</label>
                      <select required class="form-control" name="religion">
                          <option value="">Chọn tôn giáo</option>
                          @foreach($religions as $religion)
                          <option {{$pi->religion_id == $religion->id ? 'selected' : ''}} value="{{$religion->id}}">{{$religion->name}}</option>
                          @endforeach
                      </select>
                    </div>

                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                      <label>Giới tính</label>
                      <div class="radio">
                          <label class="col-sm-4">
                              <input required type="radio" name="gender" value="0" {{$pi->gender ==0 ? "checked":""}}>Nam
                          </label>
                          <label class="col-sm-4">
                              <input required type="radio" name="gender" value="1" {{$pi->gender ==1 ? "checked":""}}>Nữ
                          </label>
                      </div>
                  </div>
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input required required type="date" min="1900-01-01"  class="form-control" name="date_of_birth" value="{{$pi->date_of_birth}}">
                    </div>

                </div>

                <div class="form-group">
                  <div class="col-sm-6">
                      <label>Nơi sinh</label>
                      <input required type="text" maxlength="100" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{$pi->place_of_birth}}">
                  </div>
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input required type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{$pi->phone_number}}">
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
                        <label>Địa chỉ Email</label>
                        <input required type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{$pi->email_address}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Quê quán</label>
                        <input required type="text" class="form-control" name="home_town" placeholder="Nhập quê quán" value="{{$pi->home_town}}">
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-6">
                        <label>Loại hợp đồng</label>
                        <select required class="form-control" name="contract_type" data-dependent>
                            <option value="">Chọn loại hợp đồng</option>
                            @foreach($contract_types as $contract_type)
                            <option {{$pi->contract_type_id == $contract_type->id?'selected':'' }} value="{{$contract_type->id}}">{{$contract_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <input required type="text" class="form-control" name="position" placeholder="Nhập chức vụ" value="{{$pi->position}}">
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-6">
                        <label>Ngày tuyển dụng</label>
                        <input required required type="date" min="1900-01-01"  class="form-control" name="date_of_recruitment" value="{{$pi->date_of_recruitment}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Chức danh chuyên môn</label>
                        <input required type="text" class="form-control" name="professional_title" placeholder="Nhập chức danh chuyên môn" value="{{$pi->professional_title}}">
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-sm-6">
                        <label>Đơn vị</label>
                        <select required class="form-control" name="unit">
                            <option value="">Chọn đơn vị</option>
                            @foreach($units as $unit)
                            <option {{ $pi->unit_id==$unit->id?'selected':'' }} value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Chứng minh nhân dân</label>
                        <input required type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{$pi->identity_card}}">
                    </div>
                </div>
                <div class="form-group">

                  <div class="col-sm-6">
                      <label>Ngày cấp</label>
                      <input required required type="date" min="1900-01-01"  class="form-control" name="date_of_issue" value="{{$pi->date_of_issue}}">
                  </div>
                  <div class="col-sm-6">
                      <label>Nơi cấp</label>
                      <input required type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$pi->place_of_issue   }}">
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Loại cán sự</label>
                        <select required class="form-control" name="leader_type" data-dependent>
                            <option value="">Chọn loại cán sự</option>
                            @foreach($leader_types as $leader_type)
                            <option {{$pi->leader_type_id == $leader_type->id ? 'selected' : ''}} value="{{$leader_type->id}}">{{$leader_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Loại cán bộ</label>
                        <select required class="form-control" name="officer_type" data-dependent>
                            <option value="">Chọn loại cán bộ</option>

                            @foreach($officer_types as $officer_type)
                            @if($pi->officer()->exists())
                            <option {{ $officer_type->id== $pi->officer->type_id?'selected':'' }} value="{{$officer_type->id}}">{{$officer_type->name}}</option>
                            @else
                            <option {{ $officer_type->id== old('officer_type')?'selected':'' }} value="{{$officer_type->id}}">{{$officer_type->name}}</option>

                            @endif
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <select required class="form-control" name="position_type" data-dependent>
                            <option value="">Chọn chức vụ</option>
                            @foreach($position_types as $position_type)
                            @if($pi->officer()->exists())
                            <option {{ $position_type->id== $pi->officer->position_id?'selected':'' }} value="{{$position_type->id}}">{{$position_type->name}}</option>
                            @else
                            <option {{ $position_type->id== old('position_type')?'selected':'' }} value="{{$position_type->id}}">{{$position_type->name}}</option>

                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Kiêm nhiệm giảng dạy</label>
                        <div class="radio">
                            @if($pi->officer()->exists())
                            <label class="col-sm-4">
                                    <input required type="radio" name="is_concurrently" value="0" {{$pi->officer->is_concurrently ==0 ? "checked":""}}>Có
                                </label>
                                <label class="col-sm-4">
                                    <input required type="radio" name="is_concurrently" value="1" {{$pi->officer->is_concurrently ==1 ? "checked":""}}>Không
                                </label>
                            @else
                            <label class="col-sm-4">
                                    <input required type="radio" name="is_concurrently" value="0" {{old('is_concurrently') ==0 ? "checked":""}}>Có
                                </label>
                                <label class="col-sm-4">
                                    <input required type="radio" name="is_concurrently" value="1" {{old('is_concurrently') ==1 ? "checked":""}}>Không
                                </label>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Loại giảng viên</label>
                        <select required class="form-control" name="teacher_type" data-dependent>
                            <option value="">Chọn loại giảng viên</option>
                            @if($pi->teacher()->exists())
                            @foreach($teacher_types as $teacher_type)
                            <option {{ $teacher_type->id== $pi->teacher->type_id?'selected':'' }} value="{{$teacher_type->id}}">{{$teacher_type->name}}</option>

                            @endforeach
                            <option {{ $teacher_type->id== old('teacher_type')?'selected':'' }} value="0">Không có</option>

                            @else
                            @foreach($teacher_types as $teacher_type)
                            <option {{ $teacher_type->id== old('teacher_type')?'selected':'' }} value="{{$teacher_type->id}}">{{$teacher_type->name}}</option>
                            @endforeach
                            <option {{ $teacher_type->id== old('teacher_type')?'selected':'' }} value="0" selected>Không có</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6 dependent-on-teacher">
                        <label>Chức danh nghề nghiệp</label>
                        <select required class="form-control" name="teacher_title" data-dependent>
                            <option value="">Chọn chức danh</option>
                            @if($pi->teacher()->exists())
                            @foreach($teacher_titles as $teacher_title)
                            <option {{ $teacher_title->id== $pi->teacher->title_id?'selected':'' }} value="{{$teacher_title->id}}">{{$teacher_title->name}}</option>
                            @endforeach
                            @else
                            @foreach($teacher_titles as $teacher_title)
                            <option {{ $teacher_title->id== old('teacher_title')?'selected':'' }} value="{{$teacher_title->id}}">{{$teacher_title->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-sm-6 dependent-on-teacher">
                        <label>Danh hiệu</label>
                        @if($pi->teacher()->exists())
                        <div class="checkbox">
                            <label class="col-sm-4">
                                <input type="checkbox" name="is_excellent_teacher" {{$pi->teacher->is_excellent_teacher == 1 ? 'checked':''}} value="1">Nhà giáo ưu tú
                            </label>
                            <label class="col-sm-4">
                                <input type="checkbox" name="is_national_teacher" {{$pi->teacher->is_national_teacher == 1 ? 'checked':''}} value="1">Nhà giáo nhân dân
                            </label>
                        </div>
                        @else
                        <div class="checkbox">
                            <label class="col-sm-4">
                                <input type="checkbox" name="is_excellent_teacher" {{old('is_excellent_teacher') == 1 ? 'checked':''}} value="1">Nhà giáo ưu tú
                            </label>
                            <label class="col-sm-4">
                                <input type="checkbox" name="is_national_teacher" {{old('is_national_teacher') == 1 ? 'checked':''}} value="1">Nhà giáo nhân dân
                            </label>
                        </div>
                        @endif

                    </div>
                    <div class="col-sm-6">
                            <label>Nghỉ việc</label>
                                <div class="radio">
                                    <label class="col-sm-4">
                                        <input required type="radio" name="is_activity" value="1" {{$pi->is_activity==1 ? 'checked':''}}>Chưa nghỉ việc
                                    </label>
                                    <label class="col-sm-4">
                                        <input required type="radio" name="is_activity" value="0" {{$pi->is_activity==0  ? 'checked':''}}>Đã nghỉ việc
                                    </label>
                                </div>
                    </div>
                            




                    </div>
                    <div class="form-group dependent-on-teacher">
                        <div class="col-sm-6 dependent-on-teacher">
                            <label>Nghỉ hưu</label>
                            <div class="radio">
                                @if($pi->teacher()->exists())
                                    <label class="col-sm-4">
                                            <input required type="radio" name="is_retired" value="1" {{$pi->teacher->is_retired==1 ? 'checked':''}}>Đã nghỉ hưu
                                    </label>
                                <label class="col-sm-4">
                                    <input required type="radio" name="is_retired" value="0" {{$pi->teacher->is_retired==0 ? 'checked':''}}>Chưa nghỉ hưu
                                </label>
                                @else
                                    <label class="col-sm-4">
                                            <input required type="radio" name="is_retired" value="1" {{old('is_retired')==1 ? 'checked':''}}>Đã nghỉ hưu
                                    </label>
                                <label class="col-sm-4">
                                    <input required type="radio" name="is_retired" value="0" {{old('is_retired')==0 ? 'checked':''}}>Chưa nghỉ hưu
                                </label>
                                @endif
                        </div>
                        </div>
                            <div class="col-sm-6">
                                <label>Ngày nghỉ hưu</label>
                                @if($pi->teacher()->exists())
                                <input required disabled type="date" min="1900-01-01" class="form-control" name="date_of_retirement" value="{{$pi->teacher->date_of_retirement}}">
                                @else
                                <input required disabled type="date" min="1900-01-01" class="form-control" name="date_of_retirement" value="{{old('date_of_retirement')}}">

                                @endif
                            </div>
                        </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
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
