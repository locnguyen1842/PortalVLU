@extends('employee.master')
@section('title','Cập nhật lý lịch khoa học')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            <li><a href="{{route('employee.sb.detail')}}">Chi tiết lý lịch khoa học</a></li>
               <li class="active">Cập nhật lý lịch khoa học</li>
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
                <form class="form-horizontal" action="{{route('employee.sb.update')}}" method="post">
                    {{csrf_field()}}
                    <div class="panel panel-default">
                        <div class="panel-heading">Lý lịch sơ lược<br>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Họ và tên <span style="color: red">*</span></label>
                                    <input required type="text" class="form-control" name="full_name" placeholder="Nhập mã nhân viên"
                                        value="{{old('full_name',$sb->pi->full_name)}}">

                                </div>
                                <div class="col-sm-6">
                                    <label>Giới tính <span style="color: red">*</span></label>
                                    <div class="radio">
                                        @if(!is_null(old('gender')))
                                        <label class="col-sm-4">
                                            <input required type="radio" name="gender" value="0"
                                                {{ old('gender') == 0 ? "checked":""}}>Nam
                                        </label>
                                        <label class="col-sm-4">
                                            <input required type="radio" name="gender" value="1"
                                                {{ old('gender') == 1 ? "checked":""}}>Nữ
                                        </label>
                                        @else
                                        <label class="col-sm-4">
                                            <input required type="radio" name="gender" value="0"
                                                {{$sb->pi->gender == 0 ? "checked":""}}>Nam
                                        </label>
                                        <label class="col-sm-4">
                                            <input required type="radio" name="gender" value="1"
                                                {{$sb->pi->gender == 1 ? "checked":""}}>Nữ
                                        </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Ngày, tháng ,năm sinh <span style="color: red">*</span></label>
                                    <input required type="date" max="{{date('Y-m-d')}}" class="form-control" name="date_of_birth" placeholder="Nhập ngày, tháng ,năm sinh"
                                        value="{{old('date_of_birth',$sb->pi->date_of_birth)}}">
                                </div>
                                <div class="col-sm-6">
                                    <label>Nơi sinh <span style="color: red">*</span></label>
                                    <input required type="text" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh"
                                        value="{{old('place_of_birth',$sb->pi->place_of_birth)}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Quê quán <span style="color: red">*</span></label>
                                    <input required class="form-control" name="home_town" value="{{old('home_town',$sb->pi->home_town)}}">
                                </div>
                                <div class="col-sm-6">
                                    <label>Dân tộc <span style="color: red">*</span></label>
                                    <select required class="form-control" name="nation">
                                        <option value="">Chọn dân tộc</option>
                                        @foreach($nations as $nation)
                                        @if(old('nation'))
                                        <option {{ old('nation') == $nation->id ? 'selected' : ''}} value="{{$nation->id}}">{{$nation->name}}</option>

                                        @else
                                        <option {{$sb->pi->nation_id == $nation->id ? 'selected' : ''}} value="{{$nation->id}}">{{$nation->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">

                                    <label>Học vị cao nhất</label>
                                        @if($sb->pi->degreedetails->count() >0)
                                            <input type="text" class="form-control" readonly value="{{$sb->getHighestDegree($pi_id)->degree->name}}">
                                        @else
                                        <input type="text" class="form-control" readonly value="Chưa có bất kỳ bằng cấp nào. Vui lòng cập nhật bằng cấp">
                                        @endif
                                </div>
                                <div class="col-sm-6">
                                    <label>Năm, nước nhận học vị</label>

                                    @if($sb->pi->degreedetails->count() >0)
                                    <input type="text" readonly class="form-control" value="năm {{date('Y', strtotime($sb->getHighestDegree($pi_id)->date_of_issue))}}, nước {{$sb->getHighestDegree($pi_id)->nation_of_issue_id}}">
                                    @else
                                    <input type="text" readonly class="form-control" value="">

                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Chức danh khoa học cao nhất </label>
                                    <input class="form-control" name="highest_scientific_title" value="{{old('highest_scientific_title', $sb->highest_scientific_title)}}">
                                </div>
                                <div class="col-sm-6">
                                    <label>Năm bổ nhiệm</label>
                                    <input type="number" class="form-control year-digits" name="year_of_appointment" value="{{old('year_of_appointment',$sb->year_of_appointment)}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Chức vụ (hiện tại hoặc trước khi nghỉ hưu)</label>
                                    <input disabled class="form-control" name="position" value="{{$sb->pi->officer->position->name}}">

                                </div>
                                <div class="col-sm-6">
                                    <label>Đơn vị công tác (hiện tại hoặc trước khi nghỉ hưu)</label>
                                    <input disabled class="form-control" name="unit" value="{{$sb->pi->unit->name}}">

                                    {{-- <select required class="form-control" name="unit">
                                        <option value="">Chọn đơn vị</option>
                                        @foreach($units as $unit)
                                        <option {{$sb->pi->unit_id == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Chỗ ở riêng hoặc địa chỉ liên lạc</label>
                                    <input disabled class="form-control" name="address" value="{{$sb->pi->contact_address->address_content}}, {{$sb->pi->contact_address->ward->path_with_type}}">
                                </div>
                                <div class="col-sm-6">
                                    <label>Email <span style="color: red">*</span></label>
                                    <input required class="form-control" name="email_address" value="{{old('email_address',$sb->pi->email_address)}}">
                                </div>
                            </div>


                            <label>Số điện thoại / Fax</label>
                            <div class="form-group">

                                <div class="col-sm-3">
                                    <label for="">Cơ quan</label>
                                    <input class="form-control" name="orga_phone_number" value="{{old('orga_phone_number',$sb->orga_phone_number)}}">

                                </div>
                                <div class="col-sm-3">
                                    <label for="">Nhà riêng</label>
                                    <input class="form-control" name="home_phone_number" value="{{old('home_phone_number',$sb->home_phone_number)}}">

                                </div>
                                <div class="col-sm-3">
                                    <label for="">Di động <span style="color: red">*</span></label>
                                    <input required class="form-control" name="mobile_phone_number" value="{{old('mobile_phone_number',$sb->mobile_phone_number)}}">

                                </div>
                                <div class="col-sm-3">
                                    <label>Fax</label>
                                    <input class="form-control" name="fax" value="{{old('fax',$sb->pi->fax)}}">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Quá trình đào tạo<br>
                        </div>
                        <div class="panel-body">
                            <h4><label for="inputEmail3">1. Đại học</label></h4>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Hệ đào tạo <span style="color: red">*</span></label>
                                    @if(old('type_of_training'))
                                    <input required class="form-control" name="type_of_training" value="{{old('type_of_training')}}">
                                    @else
                                    <input required class="form-control" name="type_of_training" value="{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->type_of_training}}">
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label>Nơi đào tạo <span style="color: red">*</span></label>
                                    @if(old('place_of_training'))
                                    <input required class="form-control" name="place_of_training" value="{{old('place_of_training')}}">
                                    
                                    @else
                                    <input required class="form-control" name="place_of_training" value="{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->place_of_training}}">
                                    
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Ngành học <span style="color: red">*</span></label>
                                    
                                    @if(old('field_of_study'))
                                    <input required class="form-control" name="field_of_study" value="{{old('field_of_study')}}">
                                    
                                    @else
                                    <input required class="form-control" name="field_of_study" value="{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->field_of_study}}">
                                    
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label>Nước đào tạo <span style="color: red">*</span></label>
                                    @if(old('nation_of_training'))
                                    <input required class="form-control" name="nation_of_training" value="{{old('nation_of_training')}}">
                                    @else
                                    <input required class="form-control" name="nation_of_training" value="{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->nation_of_training}}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Năm tốt nghiệp <span style="color: red">*</span></label>
                                    @if(old('year_of_graduation_first'))
                                    <input type="number" required class="form-control year-digits" name="year_of_graduation_first" value="{{old('year_of_graduation_first')}}">
                                    @else
                                    <input type="number" required class="form-control year-digits" name="year_of_graduation_first" value="{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->year_of_graduation}}">
                                    @endif
                                </div>
                            </div>


                            <div id="graduate_repeater">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <span class="help-text">
                                            <button type="button" id="btn_add_graduate" class="btn btn-sm btn-success r-add-graduate">Thêm
                                                bằng đại học khác</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group group-graduate">
                                    <div class="col-sm-6">
                                        <label data-pattern-text="Bằng đại học +=2">Bằng đại học 1 </label>
                                        <input  class="form-control" name="industry[]">
                                    </div>
                                    <div class="col-sm-5">
                                        <label>Năm tốt nghiệp </label>
                                        <input type="number" class="form-control year-digits" name="year_of_graduation[]">

                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="mt-25 btn btn-danger r-delete-graduate">Xóa</button>

                                    </div>
                                </div>
                            </div>
                            <h4><label for="inputEmail3">2. Sau đại học</label></h4>
                            <div id="master_repeater">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <span class="help-text">
                                            <button type="button" id="btn_add_graduate" class="btn btn-sm btn-success r-add-master">Thêm
                                                bằng thạc sĩ khác</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="group-master">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label data-pattern-text="Thạc sĩ chuyên ngành +=1">Thạc sĩ chuyên ngành 1</label>
                                            <input class="form-control" name="master_field_of_study[]">

                                        </div>
                                        <div class="col-sm-6">
                                            <label>Năm cấp bằng</label>
                                            <input type="number" class="form-control year-digits" name="master_year_of_issue[]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Nơi đào tạo</label>
                                            <input class="form-control" name="master_place_of_training[]">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="mt-25 btn btn-danger r-delete-master">Xóa</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div id="doctor_repeater">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <span class="help-text">
                                            <button type="button" id="btn_add_graduate" class="btn btn-sm btn-success r-add-doctor">Thêm
                                                bằng tiến sĩ khác</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="group-doctor">

                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label data-pattern-text="Tiến sĩ chuyên ngành +=1">Tiến sĩ chuyên ngành 1</label>
                                            <input class="form-control" name="doctor_field_of_study[]">
                                        </div>
                                        <div class="col-sm-5">
                                            <label>Năm cấp bằng</label>
                                            <input type="number" class="form-control year-digits" name="doctor_year_of_issue[]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Tên luận án</label>
                                            <input class="form-control" name="thesis_title[]">
                                        </div>
                                        <div class="col-sm-5">
                                            <label>Nơi đào tạo</label>
                                            <input class="form-control" name="doctor_place_of_training[]">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="mt-25 btn btn-danger r-delete-doctor">Xóa</button>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>
                            <label>Ngoại ngữ</label>
                            @if($sb->tp_foreign_languages->count() >= 1)

                            @foreach($sb->tp_foreign_languages as $item)
                            @if($loop->iteration > 2)
                            @break
                            @endif
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="">{{$loop->iteration}}</label>
                                    <input class="form-control" name="language[]" value="{{$item->language}}">

                                </div>
                                <div class="col-sm-6">
                                    <label for="">Mức độ sử dụng</label>
                                    <input class="form-control" name="usage_level[]" value="{{$item->usage_level}}">

                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="">1</label>
                                    <input class="form-control" name="language[]" value="">

                                </div>
                                <div class="col-sm-6">
                                    <label for="">Mức độ sử dụng</label>
                                    <input class="form-control" name="usage_level[]" value="">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="">2</label>
                                    <input class="form-control" name="language[]" value="">

                                </div>
                                <div class="col-sm-6">
                                    <label for="">Mức độ sử dụng</label>
                                    <input class="form-control" name="usage_level[]" value="">

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Quá trình công tác chuyên môn</div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" style="margin-bottom:0">
                                    <thead>
                                        <tr>
                                            <th>Thời gian</th>
                                            <th>Nơi công tác</th>
                                            <th>Công việc đảm nhiệm</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="wp_professionals_repeater">
                                        <tr>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-sm btn-success btn-block r-add-wp-professionals">Thêm
                                                    mới</button>

                                            </td>
                                        </tr>
                                        <tr class="group-wp-professionals">

                                            <td class="col-sm-2">
                                                <input  class="form-control" name="period_time[]">
                                            </td>
                                            <td class="col-sm-4">

                                                <input  class="form-control" name="place_of_work[]">
                                            </td>
                                            <td class="col-sm-4">
                                                <input  class="form-control" name="work_of_undertake[]">
                                            </td>
                                            <td class="col-sm-1">
                                                <button type="button" class="btn btn-danger r-delete-wp-professionals">Xóa</button>


                                            </td>

                                        </tr>


                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">QUÁ TRÌNH NGHIÊN CỨU KHOA HỌC</div>
                        <div class="panel-body">
                            <h4><label for="">1. Các đề tài nghiên cứu khoa học đã và đang tham gia</label></h4>
                            <div class="table-responsive">
                                <table class="table table-hover" style="margin-bottom:0">
                                    <thead>
                                        <th>Tên đề tài nghiên cứu</th>
                                        <th>Năm bắt đầu / hoàn thành</th>
                                        <th>Đề tài cấp</th>
                                        <th>Trách nhiệm tham gia trong đề tài</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="research_topics_repeater">
                                        <tr>
                                            <td colspan="4">
                                                <button type="button" class="btn btn-sm btn-success btn-block r-add-research-topics">Thêm
                                                    mới</button>

                                            </td>
                                        </tr>

                                        <tr class="group-research-topics form-horizontal">

                                            <td class="col-sm-4">
                                                <input  class="form-control" name="name_of_topic[]">

                                            </td>
                                            <td class="col-sm-3" style="padding-left:0px">
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control year-digits" name="start_year[]"
                                                        placeholder="Bắt đầu">

                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control year-digits" name="end_year[]" placeholder="Kết thúc">

                                                </div>

                                            </td>
                                            <td class="col-sm-2">
                                                <select class="form-control" name="topic_level[]">
                                                    <option value="">Đề tài cấp</option>

                                                    @foreach ($topic_levels as $item)
                                                    <option value="{{$item->id}}">{{$item->level}}</option>
                                                    @endforeach
                                                </select>


                                            </td>
                                            <td class="col-sm-2">
                                                <input  class="form-control" name="responsibility[]">

                                            </td>
                                            <td class="col-sm-1">
                                                <button type="button" class="btn btn-danger r-delete-research-topics">Xóa</button>

                                            </td>

                                        </tr>


                                    </tbody>
                                </table>

                            </div>
                            <hr>
                            <h4><label for="">2. Các công trình khoa học đã công bố</label></h4>
                            <div class="table-responsive">
                                <table class="table table-hover" style="margin-bottom:0">
                                    <thead>
                                        <tr>
                                            <th>Tên công trình</th>
                                            <th>Năm công bố</th>
                                            <th>Tên tạp chí</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="research_process_works_repeater">
                                        <tr>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-sm btn-success btn-block r-add-research-process-works">Thêm
                                                    mới</button>

                                            </td>
                                        </tr>
                                        <tr class="group-research-process-works form-horizontal">
                                            <td class="col-sm-4">
                                                <input  class="form-control" name="name_of_works[]">

                                            </td>
                                            <td class="col-sm-2">
                                                <input type="number"  class="form-control year-digits" name="year_of_publication[]">

                                            </td>
                                            <td class="col-sm-3">
                                                <input  class="form-control" name="name_of_journal[]">

                                            </td>
                                            <td class="col-sm-1">
                                                <button type="button" class="btn btn-danger r-delete-research-process-works">Xóa</button>

                                            </td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <hr>
                            <div class="form-group" style="margin-bottom:0">
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-block btn-primary">Lưu</button>
                                    </div>
                                </div>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.form-repeater.js')}}"></script>
<script type="text/javascript">

$(document).ready(function(){
            $(document).on('input','.year-digits',function(){
                
                if($(this).val().length > 4){
                    $(this).val($(this).val().slice(0,4))
                }
        })
        var list1 = '{!!json_encode($sb->tp_graduates->count() > 1  ? $sb->tp_graduates->slice(1)->flatten()->toArray() :$sb->tp_graduates->slice(1)->toArray() )!!}';
        var list_graduate = JSON.parse(list1);
        var array_graduate = new Array();
        var industry = "industry[]";
        var year_of_graduation = "year_of_graduation[]";
        list_graduate.forEach(function(item,key){
            let data = {
                'industry[]': item['field_of_study'] , 
                'year_of_graduation[]' : item['year_of_graduation']
            }
            array_graduate.push(data)
        });
        
        $('#graduate_repeater').repeater({
            btnAddClass: 'r-add-graduate',
            btnRemoveClass: 'r-delete-graduate',
            groupClass: 'group-graduate',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true,
        },array_graduate);

        // 2

        var list2 = '{!!json_encode($sb->wp_professionals->toArray())!!}';
        var list_wp_professionals = JSON.parse(list2);
        var array_wp_professionals = new Array();
        
        
        list_wp_professionals.forEach(function(item,key){

            let data =  {
                'period_time[]': item['period_time'], 
                'place_of_work[]': item['place_of_work'], 
                'work_of_undertake[]': item['work_of_undertake']
            }
            array_wp_professionals.push(data);
        });
        $('#wp_professionals_repeater').repeater({
            btnAddClass: 'r-add-wp-professionals',
            btnRemoveClass: 'r-delete-wp-professionals',
            groupClass: 'group-wp-professionals',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true
        },array_wp_professionals);

        // 3

        var list3 = '{!!json_encode($sb->research_topics->toArray())!!}';
        var list_research_topics = JSON.parse(list3);
        var array_research_topics = new Array();
        list_research_topics.forEach(function(item,key){

            let data = {
                'name_of_topic[]': item['name_of_topic'], 
                'start_year[]': item['start_year'], 'end_year[]': item['end_year'], 
                'topic_level[]': item['topic_level_id'], 
                'responsibility[]': item['responsibility']
            }
            array_research_topics.push(data);
            
        });
        $('#research_topics_repeater').repeater({
            btnAddClass: 'r-add-research-topics',
            btnRemoveClass: 'r-delete-research-topics',
            groupClass: 'group-research-topics',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true
        },array_research_topics);

        // 4

        var list4 = '{!!json_encode($sb->research_process_works->toArray())!!}';
        var list_research_process_works = JSON.parse(list4);
        
        
        var array_research_process_works = new Array();
        list_research_process_works.forEach(function(item,key){

            let data = {
                "name_of_works[]": item['name_of_works'] , 
                "year_of_publication[]" : item['year_of_publication'] , 
                "name_of_journal[]" : item['name_of_journal'] 
            }
            console.log(data);
            array_research_process_works.push(data);
        });
        $('#research_process_works_repeater').repeater({
            btnAddClass: 'r-add-research-process-works',
            btnRemoveClass: 'r-delete-research-process-works',
            groupClass: 'group-research-process-works',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true
        },array_research_process_works);

        // master pplace

        var list5 = '{!!json_encode($sb->tp_postgraduate_masters->toArray())!!}';
        var list_tp_masters = JSON.parse(list5);
        var array_tp_masters = new Array();
        list_tp_masters.forEach(function(item,key){
            data = {
                        "master_field_of_study[]" : item['field_of_study'],
                        "master_year_of_issue[]" : item['year_of_issue'] ,
                        "master_place_of_training[]" : item['place_of_training'],
                    }
            array_tp_masters.push(data);
        });
        $('#master_repeater').repeater({
            btnAddClass: 'r-add-master',
            btnRemoveClass: 'r-delete-master',
            groupClass: 'group-master',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true
        },array_tp_masters);
        // tp_postgraduate_doctors

        var list5 = '{!!json_encode($sb->tp_postgraduate_doctors->toArray())!!}';
        var list_tp_doctors = JSON.parse(list5);
        var array_tp_doctors = new Array();
        list_tp_doctors.forEach(function(item,key){
            let data = {
                "doctor_field_of_study[]" : item['field_of_study'],
                "doctor_year_of_issue[]" : item['year_of_issue'],
                "thesis_title[]" : item['thesis_title'] ,
                "doctor_place_of_training[]" : item['place_of_training'] 
            }
            array_tp_doctors.push(data);
        });
        $('#doctor_repeater').repeater({
            btnAddClass: 'r-add-doctor',
            btnRemoveClass: 'r-delete-doctor',
            groupClass: 'group-doctor',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true
        },array_tp_doctors);
    });

</script>
@endsection
