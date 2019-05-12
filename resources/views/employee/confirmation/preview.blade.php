<html>

<head>

</head>

<body>
     <div class="form-group col-sm-12">
          <div class="col-sm-6 text-center">
               <div class="form-group-header">
                    <label>BỘ GIÁO DỤC VÀ ĐÀO TẠO</label>
               </div>
               <div class="form-group-header">
                    <strong>TRƯỜNG ĐẠI HỌC VĂN LANG
                         <hr style="width:180px;height:2px;border:none;color:#333;background-color:#333;">
                         <label
                              style="font-weight:normal">Số:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/GXN-ĐHVL</label>

                    </strong>

               </div>
          </div>
          <div class="col-sm-6 text-center">
               <div class="form-group-header">
                    <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong>
               </div>
               <div class="form-group-header">
                    <strong style="font-size:1.06rem">Độc lập – Tự do – Hạnh phúc
                         <hr style="width:210px;height:2px;border:none;color:#333;background-color:#333;">
                    </strong>
               </div>
          </div>

     </div>
     <div class="form-group">
          <div class="col-sm-12 text-center">
               <h4 style="font-size:1.06rem">GIẤY XÁC NHẬN</h4>
               <h4 style="margin-top:1rem">TRƯỜNG ĐẠI HỌC VĂN LANG</h4>
          </div>
     </div>
     <div class="form-group">
          <div class="col-sm-1">&nbsp;</div>
          <div class="col-sm-10" style="margin-top:2rem">
               <div class="form-group col-sm-12">
               <label class="content" for="">Xác nhận: {{$cr->pi->gender == 1 ? 'Bà' : 'Ông'}} <span class=" text-uppercase">{{$cr->pi->full_name}}</span></label>

               </div>
               <div class="form-group col-sm-12">
                    <div class="col-sm-6">
                        <label class="content" for="">Sinh ngày: {{date('d/m/Y', strtotime($pi->date_of_birth))}}</label>

                    </div>
                    <div class="col-sm-6">
                         <label class="content" for="">tại {{$pi->place_of_birth}}</label>

                    </div>

               </div>
               <div class="form-group col-sm-12">
                    <div class="col-sm-6">
                         <label class="content" for="">CMND: {{$pi->identity_card}}</label>

                    </div>
                    <div class="col-sm-6">
                         <label class="content" for="">Ngày cấp: {{date('d/m/Y', strtotime($pi->date_of_issue))}}</label>

                    </div>
               </div>
               <div class="form-group col-sm-12">
                    <label class="content" for="">Địa chỉ: {{$cr->address->address_content.', '.$cr->address->ward->path_with_type}}</label>

               </div>
               <div class="form-group col-sm-12">
                   @if($pi->officer->type_id == 4)
                   @if($cr->pi->leader_type()->exists())
                        @if($cr->pi->leader_type_id == 1 || $cr->pi->leader_type_id == 2)
                        <label class="content" for="">Là <span>{{$cr->pi->leader_type->name}}</span> <span>{{$cr->pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->pi->date_of_recruitment))}}
                            đến nay.</label>
                        @else
                        <label class="content" for="">Là <span>{{$cr->pi->teacher->type->note}}</span> <span>{{$cr->pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->pi->date_of_recruitment))}}
                            đến nay.</label>
                        @endif

                    @endif
                    @elseif($pi->officer->type_id == 3)
                    @if($cr->pi->leader_type()->exists())
                        @if($cr->pi->leader_type_id == 1 || $cr->pi->leader_type_id == 2)
                        <label class="content" for="">Là <span>{{$cr->pi->leader_type->name}}</span> <span>{{$cr->pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->pi->date_of_recruitment))}}
                            đến nay.</label>
                        @else

                            <label class="content" for="">Là <span>{{$pi->officer->position->name}}</span> <span>{{$pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->pi->date_of_recruitment))}}
                                đến nay.</label>
                        @endif

                    @endif
                    <label class="content" for="">Là <span>{{$pi->officer->position->name}}</span> <span>{{$pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($pi->date_of_recruitment))}}
                        đến nay.</label>

                    @elseif($pi->officer->type_id == 2)
                    <label class="content" for="">Là <span>{{$pi->officer->position->note}}</span> <span>{{$pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($pi->date_of_recruitment))}}
                        đến nay.</label>

                    @elseif($pi->officer->type_id == 1)
                    <label class="content" for="">Là <span>{{$pi->officer->position->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($pi->date_of_recruitment))}}
                        đến nay.</label>
                    @endif

               </div>
               @if($cr->incomes()->exists())
               <div class="form-group-header col-sm-12">
                    <label class="content" for="">Thu nhập {{$cr->number_of_month_income}} tháng gần nhất:</label>
                    </div>
               <div class="form-group-header col-sm-12">

                <table class="table-content" cellspacing="0px">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tháng</th>
                            <th>Thu nhập (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cr->incomes as $item)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->month_of_income .'/'.$item->year_of_income}}</td>
                        <td>{{number_format($item->amount_of_income)}} đồng</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            @endif
               <div class="form-group col-sm-12">
                    <label class="content" for="">Nhà trường cấp giấy xác nhận để {{$pi->gender == 1 ? 'bà' : 'ông'}} {{$pi->full_name}} {{$cr->confirmation}}.</label>

               </div>
               <div class="form-group col-sm-12" style="margin-top:1rem">
                    <div class="col-sm-4">&nbsp;</div>
                    <div class="col-sm-8 text-center">
                         <label class="content" style="font-style:italic" for=""> Thành Phố Hồ Chí Minh,
                            ngày &nbsp;&nbsp;&nbsp;&nbsp; tháng &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; năm
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>

                    </div>

               </div>
               <div class="form-group col-sm-12">
                    <div class="col-sm-4">&nbsp;</div>
                    <div class="col-sm-8 text-center">
                         <h4 class="text-upper" for="">{{$cr->first_signer != null ? $cr->first_signer : 'KT.HIỆU TRƯỞNG'}}</h4>
                         @if($cr->second_signer != null)
                         <h4 class="text-upper" for="">{{$cr->second_signer != null ? $cr->second_signer : 'PHÓ HIỆU TRƯỞNG'}}</h4>
                        @endif
                    </div>


               </div>
               <div class="form-group col-sm-12" style="margin-top:3rem">
                    <div class="col-sm-4">&nbsp;</div>
                    <div class="col-sm-8 text-center">
                         <h4 class="text-capitalize" for="">{{$cr->name_of_signer != null ? $cr->name_of_signer : 'Họ Tên Người Ký'}}</h4>

                    </div>


               </div>
          </div>
          <div class="col-sm-1"></div>

     </div>

</body>


<style>
    table{
    page-break-inside: avoid;
    border-collapse : collapse;
    }

    label.content{
        line-height: 1.5rem;
    }
    table td, table th{
        border: 1px solid black;
        text-align: center;
    }
    .text-uppercase{
        text-transform:uppercase!important;
     }
    table > tbody > tr > td {
        height: 30px;
    }
    .table-content{
        width: 90%;
    }
     body {
          font-family: 'Times New Roman', Times, serif;
     }

     hr {
          display: block;
          height: 1px;
          background: transparent;
          width: 100%;
          border: none;
          border-top: solid 1px #aaa;
     }
     h4 {
          margin-block-start: 0.5rem;
          margin-block-end: 0.5rem;
     }
     .text-capitalize{
          text-transform: capitalize;
     }
     .fs-14 {
          font-size: 14px;

     }

     .fs-13 {
          font-size: 13px;

     }

     .mt-10 {
          margin-top: 10px;
     }

     .form-group-header {
          margin-bottom: 0.8rem;
     }

     .text-center {
          text-align: center;
     }
     .text-upper{
          text-transform: uppercase;
     }

     .col-sm-1,
     .col-sm-2,
     .col-sm-3,
     .col-sm-4,
     .col-sm-5,
     .col-sm-6,
     .col-sm-7,
     .col-sm-8,
     .col-sm-9,
     .col-sm-10,
     .col-sm-11,
     .col-sm-12 {
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

     @media print {

          .col-sm-1,
          .col-sm-2,
          .col-sm-3,
          .col-sm-4,
          .col-sm-5,
          .col-sm-6,
          .col-sm-7,
          .col-sm-8,
          .col-sm-9,
          .col-sm-10,
          .col-sm-11,
          .col-sm-12 {
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

</html>
