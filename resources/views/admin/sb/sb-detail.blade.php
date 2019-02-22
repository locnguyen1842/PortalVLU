@extends('admin.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            {{-- <li><a href="#">Home</a></li> --}}
            <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
             <li class=""><a href="{{route('admin.pi.detail',$pi_id)}}">Chi tiết nhân viên - {{App\PI::find($pi_id)->employee_code}}</a></li>
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
                <li class="{{url()->current() == route('admin.pi.workload.index',$pi_id) ? 'active':''}}"><a href="{{route('admin.pi.workload.index',$pi_id)}}">Khối lượng công việc</a></li>
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
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Họ và tên</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->full_name}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Giới tính</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->gender == 0 ? 'Nam' : 'Nữ'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Ngày, tháng ,năm sinh</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{date('d-m-Y',strtotime($sb->pi->date_of_birth))}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi sinh</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->place_of_birth}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Quê quán</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->home_town}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Dân tộc</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->nation->name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Học vị cao nhất</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{($sb->getHighestDegree($pi_id))== null ? 'Chưa có':($sb->getHighestDegree($pi_id))->degree->name}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm, nước nhận học vị</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{($sb->getHighestDegree($pi_id)) == null ? 'Chưa có': date('Y',strtotime($sb->getHighestDegree($pi_id)->date_of_issue))}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Chức danh khoa học cao nhất</label>
                                    <span for="" class="col-sm-8">{{$sb->highest_scientific_title}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm bổ nhiệm</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->year_of_appointment}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Chức vụ</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->position}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Đơn vị công tác</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->unit->name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Chỗ ở riêng hoặc địa chỉ liên lạc</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->address}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Email</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->email_address}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Số điện thoại</label>
                                    <div class="col-sm-8">CQ:
                                        <span for="" class="text-nowrap">{{$sb->orga_phone_number}}</span>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-6">NR:
                                        <span for="" class="text-nowrap">{{$sb->home_phone_number}}</span>
                                    </div>
                                    <div class="col-sm-6">DĐ:
                                        <span for="" class="text-nowrap">{{$sb->mobile_phone_number}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Fax</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->fax}}</span>
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
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->type_of_training}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->place_of_training}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Ngành học</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nước đào tạo</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->nation_of_training}}</span>
                                </div>
                            </div>
                            @foreach($sb->tp_graduates as $item)
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Bằng đại học {{$loop->iteration}}</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$item->nation_of_training}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm tốt nghiệp</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$item->year_of_graduation}}</span>
                                </div>
                            </div>
                            @endforeach
                            <h4><label for="inputEmail3">2. Sau đại học</label></h4>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Thạc sĩ chuyên ngành</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_masters->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_masters->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->year_of_issue}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_masters->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->place_of_training}}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tiến sĩ chuyên ngành</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->field_of_study}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Năm cấp bằng</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->year_of_issue}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Tên luận án</label>
                                    <span for="" class="col-sm-8">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->thesis_title}}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-4">Nơi đào tạo</label>
                                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->place_of_training}}</span>
                                </div>

                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inputEmail3" class="col-sm-2">Ngoại ngữ</label>
                                    @foreach($sb->tp_foreign_languages as $item)
                                    @if($loop->iteration > 2)
                                    @break
                                    @endif
                                    <div>
                                        <div class="col-sm-4" style="padding-left:5px">{{$loop->iteration}}.
                                            <span for="" class="text-nowrap">{{$item->language}}</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="col-sm-6">Mức độ sử dụng :

                                            </div>
                                            <span for="" class="col-sm-6 text-nowrap"> {{$item->usage_level}}</span>
                                        </div>
                                    </div>
                                    @endforeach



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
                                    @if($sb->wp_professionals->count() >0)
                                    @foreach ($sb->wp_professionals as $item)
                                    <tr>

                                        <td class="col-sm-4">{{$item->period_time}}</td>
                                        <td class="col-sm-4">{{$item->place_of_work}}</td>
                                        <td class="col-sm-4">{{$item->work_of_undertake}}</td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
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
                                    @if($sb->research_topics->count() >0)
                                    @foreach ($sb->research_topics as $item)
                                    <tr>
                                        <td class="col-sm-1">{{$loop->iteration}}</td>
                                        <td class="col-sm-5">{{$item->name_of_topic}}</td>
                                        <td class="col-sm-2">{{$item->start_year}}/{{$item->end_year}}</td>
                                        <td class="col-sm-2">{{$item->topic_level->level}}</td>
                                        <td class="col-sm-2">{{$item->responsibility}}</td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
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
                                    @if($sb->research_process_works->count() >0)
                                    @foreach ($sb->research_process_works as $item)
                                    <tr>
                                        <td class="col-sm-1">{{$loop->iteration}}</td>
                                        <td class="col-sm-4">{{$item->name_of_works}}</td>
                                        <td class="col-sm-2">{{$item->year_of_publication}}</td>
                                        <td class="col-sm-3">{{$item->name_of_journal}}</td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
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
