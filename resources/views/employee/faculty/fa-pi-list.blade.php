@extends('employee.master')
@section('title','Danh sách thông tin cá nhân')
@section('breadcrumb')

    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class="active">Quản lý thông tin nhân viên trong khoa</li>
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
<div class="alert alert-danger print-error-msg mt-10" style="display:none">
  <ul>

  </ul>
</div>


<div class="panel panel-default mt-20">
  <div class="waiting">
    <img src="{{asset('img/loader.gif')}}" alt="Đang tải">
  </div>
    <div class="panel-heading">Danh sách nhân viên<br>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <form class="form-horizontal" action="{{route('employee.faculty.index')}}" method="get">
                <div class="col-sm-6">
                    <div class="col-sm-3">
                        <label class="control-label">Tìm kiếm</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Nhập mã nv, tên hoặc cmnd">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Tìm</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>


            @if($search !="")
            <div class="col-sm-6">
                <div class="col-sm-3">
                    <label class="control-label">Tìm theo </label>
                </div>
                <div class="col-sm-9">
                    <div class="">
                        <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Xóa" href="javascript:" class="search_tag tooltip-test">
                            <span class="badge badge-primary">{{$search}}
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0">
            <thead>
                <tr>

                    <th>Mã NV</th>
                    <th>Họ Tên</th>

                    <th>Ngày Sinh</th>
                    <th>Đơn vị</th>
                </tr>
            </thead>
            <tbody>
              @if($pis->where('show',1)->count() >0)
                @foreach ($pis->where('show',1) as $item)
                <tr>
                    <td class="col-sm-1">

                        <a href="{{route('employee.faculty.detail',$item->id)}}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Chi tiết" href="javascript:" class="search_tag tooltip-test">
                            <span class="badge badge-danger">{{$item->employee_code}}
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </td>
                    <td class="col-sm-3">{{$item->full_name}}</td>

                    <td class="col-sm-2">{{date('d-m-Y', strtotime($item->date_of_birth))}}</td>
                    <td class="col-sm-2">{{$item->unit->name}}</td>


                </tr>

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="pi-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa tài khoản này ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                    <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
              @else
              <tr>
                <td colspan="4" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
              </tr>
            @endif

            </tbody>
        </table>

    </div>
    <div class="panel-footer">

      {{$pis->links()}}
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(".search_tag").on('click', function() {
            var url = {!!json_encode(route('employee.faculty.index'), JSON_UNESCAPED_SLASHES) !!};
            var search = "";
            window.location.href = url;
        });

        $(document).ajaxStart(function(){
            $(".waiting").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $(".waiting").css("display", "none");
        });
        $("#btn-import-submit").on('click',function(e){
            e.preventDefault();
            var form = $("#pi-import-form");
            var url_getdata = '#';

            var token = $("input[name='_token']").val();
            $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
               type: 'post',
               url: url_getdata,
               processData: false,
               contentType:  false,
               data: new FormData($('#pi-import-form')[0]), // serializes the form's elements.
               success: function(datas)
               {

                $('#header-modal').empty();
                $('.row-table-import-tr').remove();
                $('.heading-table-import-tr').remove();
                $('.row-table-import-tr-1').remove();
                $('.heading-table-import-tr-1').remove();
                 if($.isEmptyObject(datas.error)){
                     $('#header-modal').text('Xem Trước : Thông tin nhân viên');

                     console.log(datas);
                     $.each(datas[0],function(index,value){

                        if(index == 0){
                          $.each(datas[0][0],function(index1, value1) {
                              $('.heading-table').append($('<th>',{'text':value1,'class':'heading-table-import-tr text-nowrap'}));

                          });


                        }
                     });
                     datas[0].shift();
                     $.each(datas[0],function(index2, value2) {
                         $('.row-table').append($('<tr>',{'class':'row-table-import-tr text-nowrap'}));
                         $.each(datas[0][index2],function(index3, value3) {
                           $('.row-table').children('tr:last').append($('<td>',{'text':value3}));
                         });
                     });

                     // handle sheet 2
                     $.each(datas[1],function(index,value){
                        if(index == 0){
                          $.each(datas[1][0],function(index1, value1) {
                              $('.heading-table-2').append($('<th>',{'text':value1,'class':'heading-table-import-tr-1 text-nowrap'}));

                          });


                        }
                     });
                     datas[1].shift();
                     console.log(datas[1]);
                     $.each(datas[1],function(index2, value2) {
                         $('.row-table-2').append($('<tr>',{'class':'row-table-import-tr-1 text-nowrap'}));
                         $.each(datas[1][index2],function(index3, value3) {
                           $('.row-table-2').children('tr:last').append($('<td>',{'text':value3}));
                         });
                     });
                     $("#pi-import-modal").modal('show');

                     var modalConfirm = function(callback){

                         $("#btn-pi-yes").on("click", function(){
                             callback(true);
                         });

                         $("#btn-pi-no").on("click", function(){
                             callback(false);
                             $("#pi-import-modal").modal('hide');
                         });
                     };
                     modalConfirm(function(confirm){
                         if(confirm){
                            var test = '<img width="40px" height="40px" src="{{asset('img/loader.gif')}}" alt="Đang tải">';
                            $('#header-modal').append(test);

                            form.submit();
                         }else{

                           $('#header-modal').empty();
                           $('.row-table-import-tr').remove();
                           $('.heading-table-import-tr').remove();
                           $('.row-table-import-tr-1').remove();
                           $('.heading-table-import-tr-1').remove();
                         }
                     });
	                }else{
                    $(".print-error-msg").find("ul").html('');
              			$(".print-error-msg").css('display','block');
              			$.each( datas.error, function( key, value ) {
              				$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              			});
	                }

               },
               error :function(er){
                 console.log(er);
                   $(".print-error-msg").find("ul").html('');
                   $(".print-error-msg").css('display','block');
                  $(".print-error-msg").find("ul").append('<li>'+'File tải lên không đúng cấu trúc .Vui lòng xem lại file mẫu <small> <a href="#"> (tải file mẫu)</a></small>'+'</li>');
               },
            });


        });


        $(".delete_pi").on('click',function (e) {
            e.preventDefault();
            $("#pi-delete-modal").modal('show');
            var delete_pi_form = $(this).attr('href');
            var modalConfirm = function(callback){

                $("#btn-pd-yes").on("click", function(){
                    callback(true);
                    $("#pi-delete-modal").modal('hide');
                });

                $("#btn-pd-no").on("click", function(){
                    callback(false);
                    $("#pi-delete-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm){
                if(confirm){
                    window.location.href = delete_pi_form;

                }else{

                }
            });
        });
    });
</script>
@endsection
