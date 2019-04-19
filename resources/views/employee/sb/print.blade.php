<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clearmin.min.css')}}"> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Lý lịch khoa học</title>
</head>

<body>
    <div class="">
        <!-- begin header -->
        <div>
            <div class="form-group">
                <div class="col-sm-5">
                    <h4 style="padding-left:0.5rem">BỘ GIÁO DỤC VÀ ĐÀO TẠO</h4>
                    <h4><strong>TRƯỜNG ĐẠI HỌC VĂN LANG</strong></h4>
                </div>
            <div class="col-sm-7" style="text-align:center">
                <h4><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></h4>
                <h4 class="hr2"><strong>Độc lập - Tự do - Hạnh phúc</strong></h4>
            </div>
        </div>
            <div class="clear"></div>
        </div>
        <!-- END HEADER -->
        <!-- begin tieu de -->
        <div class="tieuDe">
            <h3>LÝ LỊCH KHOA HỌC</h3>
        </div>
        <!-- end tieu de -->
        <!-- begin noi dung 1 -->
        <div class="content form-horizontal">
            <div class="form-group header-content1">
                <div class="col-sm-6">
                    <h3 for="">I. LÝ LỊCH SƠ LƯỢC</h3>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">Họ và tên:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->pi->full_name}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Giới tính:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->pi->gender == 0 ? 'Nam' : 'Nữ'}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-6">Ngày,tháng,năm sinh:</label>
                    <span class="col-sm-6 text-truncate">{{date('d-m-Y',strtotime($sb->pi->date_of_birth))}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi sinh:</label>
                        <span class="col-sm-8 text-truncate">{{$sb->pi->place_of_birth}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">Quê quán:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->pi->home_town}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Dân tộc:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->pi->nation->name}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-5">Học vị cao nhất:</label>
                    <span class="col-sm-7 text-truncate">{{($sb->getHighestDegree($pi_id))== null ? '':($sb->getHighestDegree($pi_id))->degree->name}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-6">Năm,nước nhận học vị:</label>
                    <span class="col-sm-6 text-truncate">{{($sb->getHighestDegree($pi_id)) == null ? '':'năm '. date('Y',strtotime($sb->getHighestDegree($pi_id)->date_of_issue)).', nước '.$sb->getHighestDegree($pi_id)->nation_of_issue_id}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-8">Chức danh khoa học cao nhất:</label>
                    <span class="col-sm-4">{{$sb->highest_scientific_title}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Năm bổ nhiệm:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->year_of_appointment}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-5">Chức vụ (hiện tại hoặc trước khi nghỉ hưu):</label>
                    <span class="col-sm-7 text-truncate">{{$sb->pi->officer->position->name}}</span>
                </div>
                <div class="col-sm-12">
                    <label class="col-sm-5">Đơn vị công tác (hiện tại hoặc trước khi nghỉ hưu):</label>
                    <span class="col-sm-7 text-truncate">{{$sb->pi->unit->name}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-4">Chỗ ở riêng hoặc địa chỉ liên lạc:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->address}}</span>
                </div>
            </div>
            <div class="clear">

            </div>
            <div class="form-group">
                <div class="col-sm-5">
                    <label class="col-sm-6">Điện thoại liên hệ: CQ:</label>
                    <span class="col-sm-6 text-truncate">{{$sb->orga_phone_number}}</span>
                </div>
                <div class="col-sm-3">
                    <label class="col-sm-4">NR:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->home_phone_number}}</span>
                </div>
                <div class="col-sm-3">
                    <label class="col-sm-4">DĐ:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->mobile_phone_number}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">Fax:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->pi->fax}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Email:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->pi->email_address}}</span>
                </div>
            </div>

        </div>
        <!-- end noi dung 1 -->
        <!-- begin noi dung 2 -->
        <div class="content">
            <div class="form-group">
                <div class="header-content">
                    <h3 for="">II. QUÁ TRÌNH ĐÀO TẠO</h3>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <h4 for="">1. Đại học</h4>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-2">Hệ đào tạo:</label>
                    <span class="col-sm-10 text-truncate" style="padding-left:6px">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->type_of_training}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-2">Nơi đào tạo:</label>
                    <span class="col-sm-10 text-truncate" style="padding-left:6px">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->place_of_training}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-2">Ngành học:</label>
                    <span class="col-sm-10 text-truncate" style="padding-left:6px">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->field_of_study}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">Nước đào tạo:</label>
                    <span class="col-sm-8 text-truncate">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->nation_of_training}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-6">Năm tốt nghiệp:</label>
                    <span class="col-sm-6 text-truncate">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->year_of_graduation}}</span>
                </div>
            </div>
            @if($sb->tp_graduates->count() > 1)
            @foreach($sb->tp_graduates->slice(1) as $item)
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-5">Bằng đại học {{$loop->iteration + 1}}:</label>
                    <span class="col-sm-7 text-truncate">{{$item->field_of_study}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-6">Năm tốt nghiệp:</label>
                    <span class="col-sm-6 text-truncate">{{$item->year_of_graduation}}</span>

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
            <div class="clear"></div>
            <div class="form-group">
                    <h4 for="">2. Sau đại học</h4>

            </div>
            @if($sb->tp_postgraduate_masters()->exists())
            @foreach($sb->tp_postgraduate_masters as $item)
            @if($item->field_of_study !=null &&$item->place_of_training !=null &&$item->year_of_issue!=null )
            <div class="form-group">
                <div class="col-sm-6">
                        <label class="col-sm-6">Thạc sĩ chuyên ngành {{$loop->iteration == 1 ? '' : $loop->iteration}}:</label>
                        <span class="col-sm-6 text-truncate">{{ $item->field_of_study}}</span>

                </div>
                <div class="col-sm-6">
                    <label class="col-sm-5">Năm cấp bằng:</label>
                    <span class="col-sm-7 text-truncate">{{$item->year_of_issue}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi đào tạo:</label>
                    <span class="col-sm-8 text-truncate">{{$item->place_of_training}}</span>
                </div>
            </div>
            @else
            @if($loop->iteration == 1 )

            <div class="form-group">
                <div class="col-sm-6">
                        <label class="col-sm-6">Thạc sĩ chuyên ngành:</label>
                        <span class="col-sm-6 text-truncate"></span>

                </div>
                <div class="col-sm-6">
                    <label class="col-sm-5">Năm cấp bằng:</label>
                    <span class="col-sm-7 text-truncate"></span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi đào tạo:</label>
                    <span class="col-sm-8 text-truncate"></span>
                </div>
            </div>
            @endif
            @endif

            @endforeach
            @else
            <div class="form-group">
                <div class="col-sm-6">
                        <label class="col-sm-6">Thạc sĩ chuyên ngành:</label>
                        <span class="col-sm-6 text-truncate"></span>

                </div>
                <div class="col-sm-6">
                    <label class="col-sm-5">Năm cấp bằng:</label>
                    <span class="col-sm-7 text-truncate"></span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi đào tạo:</label>
                    <span class="col-sm-8 text-truncate"></span>
                </div>
            </div>
            @endif

            <br>
            <div class="clear"></div>
            @if($sb->tp_postgraduate_doctors()->exists())
            @foreach ($sb->tp_postgraduate_doctors as $item)
            @if($item->field_of_study != null &&$item->year_of_issue != null&&$item->thesis_title !=null&&$item->place_of_training != null)
            <div class="form-group">
                <div class="col-sm-6">
                            <label class="col-sm-6">Tiến sĩ chuyên ngành {{$loop->iteration == 1 ? '' : $loop->iteration}}:</label>
                            <span class="col-sm-6 text-truncate">{{$item->field_of_study}}</span>

                    <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-5">Năm cấp bằng:</label>
                    <span class="col-sm-7 text-truncate">{{$item->year_of_issue}}</span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi đào tạo:</label>
                    <span class="col-sm-8 text-truncate">{{$item->place_of_training}}</span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <div class="col-sm-6">
                            <label class="col-sm-4">Tên luận án:</label>
                            <span class="col-sm-8">{{$item->thesis_title}}</span>

                    <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                </div>
            </div>
            @else
            @if($loop->iteration == 1)
            <div class="form-group">
                <div class="col-sm-6">
                            <label class="col-sm-6">Tiến sĩ chuyên ngành:</label>
                            <span class="col-sm-6 text-truncate"></span>

                    <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-5">Năm cấp bằng:</label>
                    <span class="col-sm-7 text-truncate"></span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi đào tạo:</label>
                    <span class="col-sm-8 text-truncate"></span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <div class="col-sm-6">

                            <label class="col-sm-4">Tên luận án:</label>
                            <span class="col-sm-8"></span>

                    <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                </div>
            </div>
            @endif

            @endif

            @endforeach
            @else
            <div class="form-group">
                <div class="col-sm-6">
                            <label class="col-sm-6">Tiến sĩ chuyên ngành:</label>
                            <span class="col-sm-6 text-truncate"></span>

                    <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-5">Năm cấp bằng:</label>
                    <span class="col-sm-7 text-truncate"></span>
                </div>
                <div class="col-sm-6">
                    <label class="col-sm-4">Nơi đào tạo:</label>
                    <span class="col-sm-8 text-truncate"></span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <div class="col-sm-6">

                            <label class="col-sm-4">Tên luận án:</label>
                            <span class="col-sm-8"></span>

                    <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                </div>
            </div>
            @endif

            <div class="clear"></div>
            <div class="form-group">
                        <h4 for="">3. Ngoại ngữ</h4>

                </div>
            <div class="form-group">
                    <div class="col-sm-6">
                                    @if($sb->tp_foreign_languages()->exists())
                                    <label class="col-sm-4">1. </label>
                                    <span class="col-sm-8">{{$sb->tp_foreign_languages->first()->language}}</span>
                                    @else
                                    <label class="col-sm-4">1. </label>
                                    @endif

                            <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                        </div>
                        <div class="col-sm-6">
                                @if($sb->tp_foreign_languages()->exists())
                                <label class="col-sm-6">Mức độ sử dụng: </label>
                                <span class="col-sm-6">{{$sb->tp_foreign_languages->first()->usage_level}}</span>
                                @else
                                <label class="col-sm-6">Mức độ sử dụng: </label>
                                @endif

                        </div>

            </div>
            <div class="form-group">
                    <div class="col-sm-6">

                                        @if($sb->tp_foreign_languages()->exists())
                                        <label class="col-sm-4">2. </label>
                                        <span class="col-sm-8">{{$sb->tp_foreign_languages->last()->language}}</span>
                                        @else
                                        <label class="col-sm-4">2. </label>
                                        @endif


                            <!-- <label class="col-sm-4">-Thạc sĩ chuyên ngành:</label> -->
                        </div>
                        <div class="col-sm-6">
                                @if($sb->tp_foreign_languages()->exists())
                                <label class="col-sm-6">Mức độ sử dụng: </label>
                                <span class="col-sm-6">{{$sb->tp_foreign_languages->last()->usage_level}}</span>
                                @else
                                <label class="col-sm-6">Mức độ sử dụng: </label>
                                @endif

                        </div>

            </div>

        </div>
        <!-- begin noi dung 3 -->
        <div class="content" style="margin-top:100px">
            <div class="form-group">
                    <div class="header-content">
                            <h3 for="">III. QUÁ TRÌNH CÔNG TÁC CHUYÊN MÔN</h3>
                        </div>
            </div>


            <table class="table-content" cellspacing="0px">
              <thead>
                  <tr>
                    <th>
                        Thời gian
                    </th>
                    <th>
                        Nơi công tác
                    </th>
                    <th>
                        Công việc đảm nhiệm
                    </th>
                </tr>
              </thead>
              <tbody>
                @if($sb->wp_professionals()->exists())
                @foreach ($sb->wp_professionals as $item)
                @if($item->period_time !=null && $item->place_of_work !=null&&$item->work_of_undertake !=null)
                <tr>
                    <td class="col-sm-2">{{$item->period_time}}</td>
                    <td class="col-sm-6">{{$item->place_of_work}}</td>
                    <td class="col-sm-4">{{$item->work_of_undertake}}</td>
                </tr>
                @else
                @if($loop->iteration == 1)
                <tr>
                    <td style="height:30px" class="col-sm-2"></td>
                    <td style="height:30px" class="col-sm-6"></td>
                    <td style="height:30px" class="col-sm-4"></td>
                </tr>


                @endif
                @endif
                @endforeach
                @else
                <tr>
                    <td style="height:30px" class="col-sm-2"></td>
                    <td style="height:30px" class="col-sm-6"></td>
                    <td style="height:30px" class="col-sm-4"></td>
                </tr>
                @endif
            </tbody>
            </table>

        </div>
        <!-- end nội dung 3 -->
        <!-- begin nội dung 4 -->
        <div class="content">
            <div class="form-group">
                    <div class="">
                            <h3 for="">IV. QUÁ TRÌNH NGHIÊN CỨU KHOA HỌC</h3>
                        </div>
            </div>
            <div class="form-group">
                <div style="margin-top:1rem, d-block">

                        <h4 >
                                1. Các đề tài nghiên cứu khoa học đã và đang tham gia
                            </h4>
                </div>

            </div>
            <table class="table-content">
                <thead>
                    <tr>
                            <th>
                                    TT
                                </th>
                                <th>
                                    Tên đề tài nghiên cứu
                                </th>
                                <th>
                                    Năm bắt đầu/Năm hoàn thành
                                </th>
                                <th>
                                    Đề tài cấp (NN, Bộ, ngành, trường)
                                </th>
                                <th>
                                    Trách nhiệm tham gia trong đề tài
                                </th>
                    </tr>

                </thead>
                <tbody>
                @if($sb->research_topics()->exists())
                @foreach ($sb->research_topics as $item)
                @if($item->name_of_topic != null && $item->start_year != null && $item->end_year !=null && $item->topic_level != null && $item->responsibility != null)
                <tr>
                    <td class="col-sm-1">{{$loop->iteration}}</td>
                    <td class="col-sm-5">{{$item->name_of_topic}}</td>
                    <td class="col-sm-2">{{$item->start_year}}/{{$item->end_year}}</td>
                    <td class="col-sm-2">{{$item->topic_level->level}}</td>
                    <td class="col-sm-3">{{$item->responsibility}}</td>
                </tr>

                @else
                @if($loop->iteration == 1)
                <tr>
                    <td style="height:30px" class="col-sm-1"></td>
                    <td style="height:30px" class="col-sm-5"></td>
                    <td style="height:30px" class="col-sm-2"></td>
                    <td style="height:30px" class="col-sm-2"></td>
                    <td style="height:30px" class="col-sm-3"></td>
              </tr>
                @endif
                @endif
                @endforeach
                @else
                    <tr>
                            <td style="height:30px" class="col-sm-1"></td>
                            <td style="height:30px" class="col-sm-5"></td>
                            <td style="height:30px" class="col-sm-2"></td>
                            <td style="height:30px" class="col-sm-2"></td>
                            <td style="height:30px" class="col-sm-3"></td>
                      </tr>


              @endif
            </tbody>
            </table>
            <div class="form-group">
                    <div style="margin-top:1rem">

                            <h4>
                                    2. Các công trình khoa học đã công bố
                                </h4>
                    </div>
            </div>
            <table class="table-content">
                <thead>
                    <tr>
                            <th >
                                    <strong>TT</strong>
                                </th>
                                <th>
                                    <strong>Tên công trình </strong>
                                </th>
                                <th>
                                    <strong>Năm công bố</strong>
                                </th>
                                <th >
                                    <strong>Tên tạp chí</strong>
                                </th>
                    </tr>

                </thead>
                <tbody>
                @if($sb->research_process_works()->exists())
                @foreach ($sb->research_process_works as $item)
                @if($item->name_of_works != null &&$item->year_of_publication != null&&$item->name_of_journal != null )
                        <tr>
                                <td class="col-sm-1">{{$loop->iteration}}</td>
                                <td class="col-sm-4">{{$item->name_of_works}}</td>
                                <td class="col-sm-2">{{$item->year_of_publication}}</td>
                                <td class="col-sm-5">{{$item->name_of_journal}}</td>
                            </tr>

                @else
                @if($loop->iteration == 1)
                <tr>
                    <td style="height:30px" class="col-sm-1"></td>
                    <td style="height:30px" class="col-sm-4"></td>
                    <td style="height:30px" class="col-sm-2"></td>
                    <td style="height:30px" class="col-sm-5"></td>
              </tr>
                @endif

                @endif
              @endforeach
              @else
                    <tr>
                            <td style="height:30px" class="col-sm-1"></td>
                            <td style="height:30px" class="col-sm-4"></td>
                            <td style="height:30px" class="col-sm-2"></td>
                            <td style="height:30px" class="col-sm-5"></td>
                      </tr>


              @endif
            </tbody>
            </table>

        </div>
        <!-- end noi dung4 -->
        <!-- nội dung kí  -->
        <div class="content">
            <div class="form-group" style="margin-left: 60%;padding-top:40px">
                <span>.............,</span>
                <span style="">ngày .....</span>
                <span >tháng .....</span>
                <span >năm .....</span>
            </div>
            <div class="form-group" style="margin-left: 66% ; margin-top: 0.7rem">
                <span><strong>Người khai kí tên</strong></span>
            </div>
            <div class="form-group" style="margin-left: 63% ">
                <span>(Ghi rõ chức danh,học vị)</span>
            </div>
        </div>
        <!-- end noi dung kí -->
    </div>
</body>

</html>
<style>
body{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family:"Arial" , sans-serif;
}

.header-content {
  page-break-before: always;
}
table{
  page-break-inside: avoid;
  border-collapse : collapse;
}


table td, table th{
    border: 1px solid black;
    text-align: center;
}
table > tbody > tr > td {
    height: 30px;
}
.clear{ clear: both;}
.wrap{
    width: 100%;
    min-height: 2000px;
    margin: auto;
    margin-top:20px ;
    overflow: hidden;
    background-color: white;
}

.headerLeft{
    float: left;
    width: 50%;
}
.headerLeft>p{

    font-size: 15px;
}
.headerRight{
    float: left;
    width: 50%;
}
.table-content{
    width: 100%;
}

/* begin tieu de */
.tieuDe{
    text-align: center;
    margin-top: 3rem;
}
.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: left;
   }
   .col-sm-12 {
        width: 100%;
   }
   .col-sm-11 {
        width: 91.66666667%;
   }
   .col-sm-10 {
        width: 83.33333333%;
   }
   .col-sm-9 {
        width: 75%;
   }
   .col-sm-8 {
        width: 66.66666667%;
   }
   .col-sm-7 {
        width: 58.33333333%;
   }
   .col-sm-6 {
        width: 50%;
   }
   .col-sm-5 {
        width: 41.66666667%;
   }
   .col-sm-4 {
        width: 33.33333333%;
   }
   .col-sm-3 {
        width: 25%;
   }
   .col-sm-2 {
        width: 16.66666667%;
   }
   .col-sm-1 {
        width: 8.33333333%;
   }
}
/* end tieu de */
@media print {
   .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: left;
   }
   .col-sm-12 {
        width: 100%;
   }
   .col-sm-11 {
        width: 91.66666667%;
   }
   .col-sm-10 {
        width: 83.33333333%;
   }
   .col-sm-9 {
        width: 75%;
   }
   .col-sm-8 {
        width: 66.66666667%;
   }
   .col-sm-7 {
        width: 58.33333333%;
   }
   .col-sm-6 {
        width: 50%;
   }
   .col-sm-5 {
        width: 41.66666667%;
   }
   .col-sm-4 {
        width: 33.33333333%;
   }
   .col-sm-3 {
        width: 25%;
   }
   .col-sm-2 {
        width: 16.66666667%;
   }
   .col-sm-1 {
        width: 8.33333333%;
   }
}
</style>
