<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Lý lịch khoa học</title>
</head>

<body>
    <div class="wrap">
        <!-- begin header -->
        <div class="header">
            <div class="headerLeft">
                <p style="padding-left:0.9rem">BỘ GIÁO DỤC VÀ ĐÀO TẠO</p>
                <p><strong>TRƯỜNG ĐẠI HỌC VĂN LANG</strong></p>
            </div>
            <div class="headerRight">
                <h4>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h4>
                <h4 class="hr2">Độc lập - Tự do - Hạnh phúc</h4>
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
        <div class="content">
            <div class="form-group header-content1">
                <div class="form-group-sub1">
                    <h3 for="">I. LÝ LỊCH SƠ LƯỢC</h3>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Họ và tên:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->full_name}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Giới tính:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->gender == 0 ? 'Nam' : 'Nữ'}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Ngày,tháng,năm sinh:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{date('d-m-Y',strtotime($sb->pi->date_of_birth))}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Nơi sinh:</label>
                        <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->place_of_birth}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Quê quán:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->home_town}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Dân tộc:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->nation->name}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Học vị cao nhất:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{($sb->getHighestDegree($pi_id))== null ? 'Chưa có':($sb->getHighestDegree($pi_id))->degree->name}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Năm,nước nhận học vị:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{($sb->getHighestDegree($pi_id)) == null ? 'Chưa có': date('Y',strtotime($sb->getHighestDegree($pi_id)->date_of_issue))}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Chức danh khoa học cao nhất:</label>
                    <span for="" class="col-sm-8">{{$sb->highest_scientific_title}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Năm bổ nhiệm:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->year_of_appointment}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Chức vụ(hiện tại hoặc trước khi nghỉ hưu):</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->position}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Chỗ ở riêng hoặc địa chỉ liên lạc:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->address}}</span>
                </div>
            </div>
            <div class="clear">

            </div>
            <div class="form-group">
                <div class="form-group-sub1" style="float: left;width: 40%;">
                    <label for="">Điện thoại liên hệ: CQ:</label>
                    <span for="" class="text-nowrap">{{$sb->orga_phone_number}}</span>
                </div>
                <div class="form-group-sub2" style="float: left;width: 30%;">
                    <label for="">NR:</label>
                    <span for="" class="text-nowrap">{{$sb->home_phone_number}}</span>
                </div>
                <div class="form-group-sub3" style="float: left;width: 30%;">
                    <label for="">DĐ:</label>
                    <span for="" class="text-nowrap">{{$sb->mobile_phone_number}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Fax:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->fax}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Email:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->pi->email_address}}</span>
                </div>
            </div>

        </div>
        <!-- end noi dung 1 -->
        <!-- begin noi dung 2 -->
        <div class="content">
            <div class="form-group">
                <div class="form-group-sub1 header-content">
                    <h3 for="">II. QUÁ TRÌNH ĐÀO TẠO</h3>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <h4 for="">1. Đại học</h4>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Hệ đào tạo:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->type_of_training}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Nơi đào tạo:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->place_of_training}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Ngành học:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->field_of_study}}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Nước đào tạo:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_graduates->isEmpty() ? '' : $sb->tp_graduates->first()->nation_of_training}}</span>
                </div>
            </div>
            @foreach($sb->tp_graduates as $item)
            <div class="form-group">
                <div class="form-group-sub1">
                    <label for="">Bằng đại học {{$loop->iteration}}:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$item->nation_of_training}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Năm tốt nghiệp:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$item->year_of_graduation}}</span>

                </div>
            </div>
          @endforeach
            <div class="clear"></div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <h4 for="">2. Sau đại học</h4>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <ul class="dash">
                        <li>
                            <label for="">Thạc sĩ chuyên ngành:</label>
                            <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_masters->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->field_of_study}}</span>
                        </li>
                    </ul>
                    <!-- <label for="">-Thạc sĩ chuyên ngành:</label> -->
                </div>
                <div class="form-group-sub2">
                    <label for="">Năm cấp bằng:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_masters->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->year_of_issue}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Nơi đào tạo:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_masters->isEmpty() ? '' : $sb->tp_postgraduate_masters->first()->place_of_training}}</span>
                </div>
            </div>
            <br>
            <div class="clear"></div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <ul class="dash">
                        <li>
                            <label for="">Tiến sĩ chuyên ngành:</label>
                            <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_doctors->first()->field_of_study}}</span>
                        </li>
                    </ul>
                    <!-- <label for="">-Thạc sĩ chuyên ngành:</label> -->
                </div>
                <div class="form-group-sub2">
                    <label for="">Năm cấp bằng:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_doctors->first()->year_of_issue}}</span>
                </div>
                <div class="form-group-sub2">
                    <label for="">Nơi đào tạo:</label>
                    <span for="" class="col-sm-8 text-nowrap">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_doctors->first()->place_of_training}}</span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <div class="form-group-sub1">
                    <ul class="dash">
                        <li>
                            <label for="">Tên luận án:</label>
                            <span for="" class="col-sm-8">{{$sb->tp_postgraduate_doctors->isEmpty() ? '' : $sb->tp_postgraduate_doctors->first()->thesis_title}}</span>
                        </li>
                    </ul>
                    <!-- <label for="">-Thạc sĩ chuyên ngành:</label> -->
                </div>
            </div>

            <div class="form-group">
                    <div class="form-group-sub1">
                        <h4 for="">3. Ngoại ngữ</h4>
                    </div>
                </div>
            <div class="form-group">
                    <div class="form-group-sub1">
                            <ul style="list-style-type: none">
                                <li>
                                    @if($sb->tp_foreign_languages()->exists())
                                    <label for="">1. {{$sb->tp_foreign_languages->first()->language}}</label>
                                    @else
                                    <label for="">1. </label>
                                    @endif
                                </li>
                            </ul>
                            <!-- <label for="">-Thạc sĩ chuyên ngành:</label> -->
                        </div>
                        <div class="form-group-sub2">
                                @if($sb->tp_foreign_languages()->exists())
                                <label for="">Mức độ sử dụng: {{$sb->tp_foreign_languages->first()->usage_level}}</label>
                                @else
                                <label for="">Mức độ sử dụng: </label>
                                @endif

                        </div>

            </div>
            <div class="form-group">
                    <div class="form-group-sub1">
                            <ul style="list-style-type: none">
                                <li>
                                        @if($sb->tp_foreign_languages()->exists())
                                        <label for="">2. {{$sb->tp_foreign_languages->last()->language}}</label>
                                        @else
                                        <label for="">2. </label>
                                        @endif

                                </li>
                            </ul>
                            <!-- <label for="">-Thạc sĩ chuyên ngành:</label> -->
                        </div>
                        <div class="form-group-sub2">
                                @if($sb->tp_foreign_languages()->exists())
                                <label for="">Mức độ sử dụng: {{$sb->tp_foreign_languages->last()->usage_level}}</label>
                                @else
                                <label for="">Mức độ sử dụng: </label>
                                @endif

                        </div>

            </div>

        </div>
        <!-- begin noi dung 3 -->
        <div class="content">
            <div class="form-group">
                    <div class="form-group-sub1 header-content">
                            <h3 for="">III. QUÁ TRÌNH CÔNG TÁC CHUYÊN MÔN</h3>
                        </div>
            </div>


            <table class="table-content" border="1px" cellspacing="0px">
              {{-- <thead> --}}
                  <tr>
                    <td align="center">
                        <strong>Thời gian</strong>
                    </td>
                    <td align="center">
                        <strong>Nơi công tác </strong>
                    </td>
                    <td align="center">
                        <strong>Công việc đảm nhiệm</strong>
                    </td>
                </tr>
              {{-- </thead> --}}
              {{-- <tbody> --}}
                @if($sb->wp_professionals->count() >0)
                @foreach ($sb->wp_professionals as $item)
               <tr>
                    <td> {{$item->period_time}}</td>
                    <td> {{$item->place_of_work}}</td>
                    <td> {{$item->work_of_undertake}}</td>
                </tr>
              @endforeach
              @else
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              @endif
            {{-- </tbody> --}}
            </table>

        </div>
        <!-- end nội dung 3 -->
        <!-- begin nội dung 4 -->
        <div class="content">
            <div class="form-group">
                    <div class="form-group-sub1 header-content">
                            <h3 for="">IV. QUÁ TRÌNH NGHIÊN CỨU KHOA HỌC</h3>
                        </div>
            </div>
            <div class="form-group">
                <div class="form-group-sub1 header-content " style="margin-top:1rem, d-block">

                        <h4 >
                                1. Các đề tài nghiên cứu khoa học đã và đang tham gia
                            </h4>
                </div>

            </div>
            <table class="table-content" border="1px" cellspacing="0px">
                <tr>
                    <td align="center" width="50px">
                        <strong>TT</strong>
                    </td>
                    <td align="center" width="250px">
                        <strong>Tên đề tài nghiên cứu </strong>
                    </td>
                    <td align="center">
                        <strong>Năm bắt đầu/Năm hoàn thành</strong>
                    </td>
                    <td align="center">
                        <strong>Đề tài cấp (NN, Bộ, ngành, trường)</strong>
                    </td>
                    <td align="center">
                        <strong>Trách nhiệm tham gia trong đề tài</strong>
                    </td>
                </tr>
                @if($sb->research_topics->count() >0)
                @foreach ($sb->research_topics as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name_of_topic}}</td>
                    <td>{{$item->start_year}}/{{$item->end_year}}</td>
                    <td>{{$item->topic_level->level}}</td>
                    <td>{{$item->responsibility}}</td>
                </tr>
              @endforeach
              @else
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              @endif
            </table>
            <div class="form-group">
                    <div class="form-group-sub1" style="margin-top:1rem">

                            <h4>
                                    2. Các công trình khoa học đã công bố
                                </h4>
                    </div>
            </div>
            <table class="table-content" border="1px" cellspacing="0px">
                <tr>
                    <td align="center" width="50px">
                        <strong>TT</strong>
                    </td>
                    <td align="center" width="250px">
                        <strong>Tên công trình </strong>
                    </td>
                    <td align="center">
                        <strong>Năm công bố</strong>
                    </td>
                    <td align="center"width="300px">
                        <strong>Tên tạp chí</strong>
                    </td>
                </tr>
                @if($sb->research_process_works->count() >0)
                @foreach ($sb->research_process_works as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name_of_works}}</td>
                    <td>{{$item->year_of_publication}}</td>
                    <td>{{$item->name_of_journal}}</td>
                </tr>
              @endforeach
              @else
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              @endif
            </table>

        </div>
        <!-- end noi dung4 -->
        <!-- nội dung kí  -->
        <div class="content">
            <div class="form-group" style="margin-left: 60%">
                <span>.............,</span>
                <span style="">ngày .....</span>
                <span >tháng .....</span>
                <span >năm .....</span>
            </div>
            <div class="form-group" style="margin-left: 66% ; margin-top: 0.7rem">
                <span><strong>Người khai kí tên</strong></span>
            </div>
            <div class="form-group" style="margin-left: 63% ; margin-top: 0.5rem">
                <span>(Ghi rõ chức danh,học vị)</span>
            </div>
        </div>
        <!-- end noi dung kí -->
    </div>
</body>

</html>
<style>
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family:"Times New Roman";
}

.header-content {
  page-break-before: always;
}
table{
  page-break-inside: avoid;

}
table.table-content > tbody > tr > td {
    text-align: center;
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
.header{
    width:100%;
    margin-top: 4rem;
    margin-left: 5rem;
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
.hr2{
    padding-left: 5rem;
}
/* begin tieu de */
.tieuDe{
    text-align: center;
    margin-top: 3rem;
}
/* end tieu de */
/* BEGIN NOI DUNG 1 */
.content{
    width: 90%;
    margin: auto;
    margin-top: 2rem;
    margin-left : 5rem;
}
.form-group{
    width: 100%;
}
.form-group-sub1{
    float: left;
    width: 55%;
    margin: 5px 0px;
}
.form-group-sub2{
    width: 45%;
    float: left;
    margin: 5px 0px;
}
.form-group ol{
    font-weight: 700;
}
.table-content{
    margin-top:1rem;
    width: 95%;
    height: 200px;
}
.form-group span{
    font-size: 17px;
}
ul.dash {
    list-style: none;
    margin-left: 0;
    padding-left: 1em;
}
ul.dash > li:before {
    display: inline-block;
    content: "-";
    width: 1em;
    margin-left: -1em;
}
</style>
