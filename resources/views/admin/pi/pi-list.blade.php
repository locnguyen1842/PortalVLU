@extends('admin.master')
@section('title','Danh sách thông tin cá nhân')
@section('breadcrumb')

    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class="active">Quản lý thông tin nhân viên</li>
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
<div class="alert alert-danger print-error-msg mt-10" style="display:none">
  <ul>

  </ul>
</div>


<div class="panel panel-default mt-20">
  <div class="waiting">
    <img src="{{asset('img/loader.gif')}}" alt="Đang tải">
  </div>
    <div class="panel-heading">Danh sách thông tin nhân viên<br>
        <a href="{{route('admin.pi.add')}}">
            <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
        </a>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <form class="form-horizontal" action="{{route('admin.pi.index')}}" method="get">
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
            <form class="form-horizontal" action="{{route('admin.pi.import')}}" id="pi-import-form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-sm-6">
                    <label for="import_file" class="control-label col-sm-4">
                            Import


                    </label>
                    <div class="col-sm-8">
                            <div class="input-group">
                                    <input required type="file" id="excel-import"  name="import_file" class="form-control col-sm-4">
                                    <span class="input-group-btn">
                                            <button class="btn btn-primary" id="btn-import-submit" type="submit">Xem</button>
                                        </span>

                            </div>
                            <span class="help-block">
                                    <a href="{{route('admin.pi.template.download')}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tải tệp mẫu" class="tooltip-test">
                                        Tải về tệp mẫu <i class="fa fa-fw fa-lg fa-download"></i>
                                    </a>
                            </span>


                    </div>
                </div>
            </form>
            {{-- Loading Div --}}

            {{-- Modal Import --}}
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="pi-import-modal">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-uppercase" id="header-modal"></h4>
                            <br>
                            <ul id="myTab" class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Thông tin nhân viên</a></li>
                                <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Học vị / Học hàm</a></li>

                            </ul>
                        </div>
                        <div class="modal-body">
                          <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                              <div class="table-responsive table-wrapper-scroll-y">
                                  <table class="table table-hover">
                                    <thead>
                                        <tr class="heading-table">

                                        </tr>
                                    </thead>
                                    <tbody class="row-table">

                                    </tbody>
                                  </table>
                              </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                              <div class="table-responsive table-wrapper-scroll-y">
                                  <table class="table table-hover">
                                    <thead>
                                        <tr class="heading-table-2">

                                        </tr>
                                    </thead>
                                    <tbody class="row-table-2">

                                    </tbody>
                                  </table>
                              </div>
                            </div>

                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="btn-pi-yes">Tải lên</button>
                            <button type="button" class="btn btn-default" id="btn-pi-no">Hủy bỏ</button>
                        </div>
                    </div>
                </div>
            </div>
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
                    <th>Đơn vị</th>
                    <th>Ngày Sinh</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @if($pis->where('show',1)->count() >0)
                @foreach ($pis->where('show',1) as $item)
                <tr class="{{$item->new ==1 ? 'font-weight-bold':''}}">
                    <td class="col-sm-1">

                        <a href="{{route('admin.pi.detail',$item->id)}}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Chi tiết" href="javascript:" class="search_tag tooltip-test">
                            <span class="badge badge-danger">{{$item->employee_code}}
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </td>
                    <td class="col-sm-3">{{$item->full_name}}</td>
                    <td class="col-sm-2">{{$item->unit->name}}</td>
                    <td class="col-sm-2">{{date('d-m-Y', strtotime($item->date_of_birth))}}</td>
                    <td class="col-sm-3">
                      <a href="{{route('admin.pi.update',$item->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test">
                          <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                      </a>
                      <a href="{{route('admin.pi.delete',$item->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa" class="delete_pi tooltip-test ml-10">
                          <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                              <span class="mdi mdi-close"></span>
                          </span>
                      </a>
                     </td>

                </tr>
                {{--modal delete pi--}}

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
                <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
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
            var url = {!!json_encode(route('admin.pi.index'), JSON_UNESCAPED_SLASHES) !!};
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
            var url_getdata = '{{route('admin.pi.import.data')}}';

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
                  $(".print-error-msg").find("ul").append('<li>'+'File tải lên không đúng cấu trúc .Vui lòng xem lại file mẫu <small> <a href="{{route('admin.pi.template.download')}}"> (tải file mẫu)</a></small>'+'</li>');
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
