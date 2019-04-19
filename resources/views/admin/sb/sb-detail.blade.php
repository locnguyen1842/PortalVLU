@extends('admin.master')
@section('title','Xem chi tiết lý lịch khoa học')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
             <li class=""><a href="{{route('admin.pi.detail',$pi_id)}}">Thông tin cá nhân - {{App\PI::find($pi_id)->employee_code}}</a></li>
            <li class="active">Lý lịch khoa học</li>
        </ol>
    </div>
</div>

@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup" >
    <div class="cm-flex">
        <div class="nav-tabs-container table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('admin.pi.detail',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.detail',$pi_id)}}">Thông tin cá nhân</a></li>
                <li class="{{url()->current() == route('admin.pi.workload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.workload.index',$pi_id)}}">Khối lượng giảng dạy</a></li>
                    <li class="{{url()->current() == route('admin.pi.srworkload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.srworkload.index',$pi_id)}}">Khối lượng NCKH</a></li>
                    <li class="{{url()->current() == route('admin.sb.detail',$pi_id) ? 'active':''}}"><a href="{{route('admin.sb.detail',$pi_id)}}">Lý lịch khoa học</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')

<div style="padding-top: 71px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-12">
                @include('admin.layouts.Error')
                @if(session()->has('message'))
                <div class="alert alert-success mt-10">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Lý lịch sơ lược<br>
                        @can('cud',App\PI::first())
                        <a href="{{route('admin.sb.update',$pi_id)}}">
                            <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                        </a>
                        <a href="{{route('admin.sb.print',$pi_id)}}" target="_blank">
                            <button type="button" name="button" class="btn btn-xs btn-warning">Xuất pdf</button>
                        </a>
                        @endcan
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Họ và tên</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->full_name}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Giới tính</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{$sb->pi->gender == 0 ? 'Nam' : 'Nữ'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Ngày, tháng ,năm sinh</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{date('d-m-Y',strtotime($sb->pi->date_of_birth))}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi sinh</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->place_of_birth}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Quê quán</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->home_town}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Dân tộc</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->nation->name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Học vị cao nhất</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{($sb->getHighestDegree($pi_id))== null ? 'Chưa có':($sb->getHighestDegree($pi_id))->degree->name}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm, nước nhận học vị</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{($sb->getHighestDegree($pi_id)) == null ? '':'năm '. date('Y',strtotime($sb->getHighestDegree($pi_id)->date_of_issue)).', nước '.$sb->getHighestDegree($pi_id)->nation_of_issue_id}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Chức danh khoa học cao nhất</label>
                                    <span for=""
                                        class="col-sm-8  text-truncate">{{$sb->highest_scientific_title}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm bổ nhiệm</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->year_of_appointment}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Chức vụ</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->officer->position->name}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Đơn vị công tác</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->unit->name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Chỗ ở riêng hoặc địa chỉ liên lạc</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->contact_address->address_content}}, {{$sb->pi->contact_address->ward->path_with_type}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Email</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->email_address}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Số điện thoại</label>
                                    <div class="col-sm-8">CQ:
                                        <span for="" class="text-truncate">{{$sb->orga_phone_number}}</span>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-6">NR:
                                        <span for="" class="text-truncate">{{$sb->home_phone_number}}</span>
                                    </div>
                                    <div class="col-sm-6">DĐ:
                                        <span for="" class="text-truncate">{{$sb->mobile_phone_number}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Fax</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$sb->pi->fax}}</span>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Quá trình đào tạo<br>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <h4><label for="inputEmail3">1. Đại học</label></h4>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Hệ đào tạo</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->type_of_training}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->place_of_training}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Ngành học</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nước đào tạo</label>
                                    <span for=""
                                        class="col-sm-8 text-truncate">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->nation_of_training}}</span>
                                </div>
                            </div>
                            @if($sb->tp_graduates->count() > 1)
                            @foreach($sb->tp_graduates->slice(1) as $item)
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Bằng đại học {{$loop->iteration + 1}}</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm tốt nghiệp</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->year_of_graduation}}</span>
                                </div>
                            </div>
                            @endforeach
                            @else

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Bằng đại học 2</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm tốt nghiệp</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>
                            @endif

                            <h4><label for="inputEmail3">2. Sau đại học</label></h4>

                            @if($sb->tp_postgraduate_masters()->exists())
                            @foreach($sb->tp_postgraduate_masters as $item)
                            @if($item->field_of_study !=null &&$item->place_of_training !=null &&$item->year_of_issue
                            !=null )

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Thạc sĩ chuyên
                                        ngành {{$loop->iteration}}</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->year_of_issue}}</span>
                                </div>
                            </div>
                            <div class="form-group">


                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->place_of_training}}</span>
                                </div>
                            </div>
                            @else
                            @if($loop->iteration == 1 )
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Thạc sĩ chuyên ngành</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>
                            <div class="form-group">


                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>
                            @endif
                            @endif


                            @endforeach
                            @else
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Thạc sĩ chuyên ngành</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>
                            <div class="form-group">


                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>

                            @endif

                            <hr>

                            @if($sb->tp_postgraduate_doctors()->exists())
                            @foreach($sb->tp_postgraduate_doctors as $item)
                            @if($item->field_of_study != null &&$item->year_of_issue != null&&$item->thesis_title !=
                            null&&$item->place_of_training != null)
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tiến sĩ chuyên ngành
                                        {{$loop->iteration}}</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->year_of_issue}}</span>
                                </div>
                            </div>
                            <div class="form-group">


                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tên luận án</label>
                                    <span for="" class="col-sm-8">{{$item->thesis_title}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-truncate">{{$item->place_of_training}}</span>
                                </div>

                            </div>
                            @else
                            @if($loop->iteration == 1)
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tiến sĩ chuyên ngành</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>
                            <div class="form-group">


                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tên luận án</label>
                                    <span for="" class="col-sm-8"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>

                            </div>
                            @endif
                            @endif
                            @endforeach
                            @else
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tiến sĩ chuyên ngành</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>
                            </div>
                            <div class="form-group">


                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tên luận án</label>
                                    <span for="" class="col-sm-8"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-truncate"></span>
                                </div>

                            </div>
                            @endif

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inputEmail3" class="col-sm-2">Ngoại ngữ</label>

                                    @if($sb->tp_foreign_languages()->exists())
                                    @foreach($sb->tp_foreign_languages as $item)
                                    @if($loop->iteration > 2)
                                    @break
                                    @endif
                                    <div>
                                        <div class="col-sm-4" style="padding-left:5px">{{$loop->iteration}}.
                                            <span for="" class="text-truncate">{{$item->language}}</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="col-sm-6">Mức độ sử dụng :

                                            </div>
                                            <span for="" class="col-sm-6 text-truncate"> {{$item->usage_level}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div>
                                        <div class="col-sm-4" style="padding-left:5px">1.
                                            <span for="" class="text-truncate"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="col-sm-6">Mức độ sử dụng :

                                            </div>
                                            <span for="" class="col-sm-6 text-truncate"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-sm-4" style="padding-left:5px">2.
                                            <span for="" class="text-truncate"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="col-sm-6">Mức độ sử dụng :

                                            </div>
                                            <span for="" class="col-sm-6 text-truncate"></span>
                                        </div>
                                    </div>
                                    @endif




                                </div>


                            </div>


                        </form>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sb->wp_professionals()->exists())
                                    @foreach ($sb->wp_professionals as $item)
                                    @if($item->period_time !=null && $item->place_of_work !=null
                                    &&$item->work_of_undertake !=null)
                                    <tr>

                                        <td class="col-sm-4">{{$item->period_time}}</td>
                                        <td class="col-sm-4">{{$item->place_of_work}}</td>
                                        <td class="col-sm-4">{{$item->work_of_undertake}}</td>

                                    </tr>
                                    @else
                                    @if($loop->iteration == 1)

                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy
                                        </td>
                                    </tr>
                                    @endif
                                    @endif
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy
                                        </td>
                                    </tr>
                                    @endif

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
                                    <tr>
                                        <th>TT</th>
                                        <th>Tên đề tài nghiên cứu </th>
                                        <th>Năm bắt đầu/Năm hoàn thành</th>
                                        <th>Đề tài cấp (NN, Bộ, ngành, trường)</th>
                                        <th>Trách nhiệm tham gia trong đề tài</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sb->research_topics()->exists())
                                    @foreach ($sb->research_topics as $item)
                                    @if($item->name_of_topic != null && $item->start_year != null && $item->end_year !=
                                    null && $item->topic_level != null && $item->responsibility != null)
                                    <tr>
                                        <td class="col-sm-1">{{$loop->iteration}}</td>
                                        <td class="col-sm-5">{{$item->name_of_topic}}</td>
                                        <td class="col-sm-2">{{$item->start_year}}/{{$item->end_year}}</td>
                                        <td class="col-sm-2">{{$item->topic_level->level}}</td>
                                        <td class="col-sm-2">{{$item->responsibility}}</td>

                                    </tr>
                                    @else
                                    @if($loop->iteration == 1)
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy
                                        </td>
                                    </tr>
                                    @endif
                                    @endif

                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>

                        </div>
                        <hr>
                        <h4><label for="">2. Các công trình khoa học đã công bố</label></h4>
                        <div class="table-responsive">
                            <table class="table table-hover" style="margin-bottom:0">
                                <thead>
                                    <tr>
                                        <th>TT</th>
                                        <th>Tên công trình</th>
                                        <th>Năm công bố</th>
                                        <th>Tên tạp chí</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sb->research_process_works()->exists())
                                    @foreach ($sb->research_process_works as $item)
                                    @if($item->name_of_works != null &&$item->year_of_publication != null
                                    &&$item->name_of_journal != null )
                                    <tr>
                                        <td class="col-sm-1">{{$loop->iteration}}</td>
                                        <td class="col-sm-4">{{$item->name_of_works}}</td>
                                        <td class="col-sm-2">{{$item->year_of_publication}}</td>
                                        <td class="col-sm-3">{{$item->name_of_journal}}</td>

                                    </tr>
                                    @else
                                    @if($loop->iteration == 1)
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy
                                        </td>
                                    </tr>
                                    @endif
                                    @endif
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
