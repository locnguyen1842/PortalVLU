@extends('admin.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Quản lý khối lượng công việc</li>
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
@if(session()->has('error_message'))
    <div class="alert alert-danger mt-10">
        {{ session()->get('error_message') }}
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
    <div class="panel-heading">Danh sách khối lượng công việc<br>
        <a href="{{route('admin.workload.add')}}">
            <button type="button" name="button" class="btn btn-xs btn-success">Thêm Mới</button>
        </a>
    </div>

    <div class="panel-body">
        <div class="form-group col-sm-6">
            <form class="form-horizontal" action="{{route('admin.workload.index')}}" method="get">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label class="control-label">Tìm kiếm</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="search" placeholder="Nhập mã hoặc tên nv/khoa/môn.">


                    </div>
                </div>
                @if($search !="")
                <div class="col-sm-12 mt-10">
                    <div class="col-sm-3">
                        <label class="control-label">Tìm theo </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="control-label text-al">
                            <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Xóa" href="javascript:"
                                class="search_tag tooltip-test">
                                <span class="badge badge-primary">{{$search}}
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                @endif

                <div class="col-sm-12 mt-10">
                    <div class="col-sm-3">
                        <label class="control-label">Năm học</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="form-control year_workload" name="year_workload">
                                @foreach($workload_session as $item)
                                @if($year_workload == null)
                                @if($item->id == $workload_session_current->id)
                                <option selected value="{{$item->id}}">{{$item->start_year}} - {{$item->end_year}} (
                                    Hiện tại ) </option>

                                @else
                                <option value="{{$item->id}}">{{$item->start_year}} - {{$item->end_year}}</option>
                                @endif
                                @else
                                @if($item->id == $workload_session_current->id)
                                <option selected value="{{$item->id}}">{{$item->start_year}} - {{$item->end_year}} (
                                    Hiện tại ) </option>

                                @else
                                @if($item->id == $year_workload)
                                <option selected value="{{$item->id}}">{{$item->start_year}} - {{$item->end_year}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->start_year}} - {{$item->end_year}}</option>

                                @endif
                                @endif
                                @endif

                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Tìm</button>
                            </span>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-sm-2"></div>
        <div class="form-group col-sm-4">

            <form class="form-horizontal" action="{{route('admin.workload.import')}}" id="workload-import-form"
                method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <label for="import_file" class="control-label col-sm-4">
                        <a href="{{route('admin.workload.template.download')}}" data-toggle="tooltip" data-placement="top"
                            title="" data-original-title="Tải file mẫu" class="tooltip-test">
                            Import
                        </a>
                    </label>
                    <div class="col-sm-8">

                        <input required type="file" id="excel-import" name="import_file" class="custom-file-input excel-default col-sm-4">
                        <button type="submit" id="btn-import-submit" class="btn btn-danger col-sm-6">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- Loading Div --}}

        {{-- Modal Import --}}
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="workload-import-modal">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-uppercase" id="header-modal">
                            <span class="header-import-label"></span>
                            Năm Học : <span class="session-import-label font-weight-bold"></span>
                        </h4>
                        <br>
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab"
                                    aria-controls="home" aria-expanded="false">Sheet1</a></li>

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
                            <div class="form-group form-horizontal">
                                <div class="col-sm-8 text-al mb-10">
                                    <div class="col-sm-4">
                                        <label class="control-label">Phương thức nhập</label>
                                    </div>

                                    <div class="radio col-sm-8">
                                        <label class="col-sm-6">
                                            <input required type="radio" checked name="append" value="0">Tạo mới
                                        </label>
                                        <label class="col-sm-6">
                                            <input required type="radio" name="append" value="1">Thêm mới
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-danger" id="btn-workload-yes">Tải lên</button>
                                    <button type="button" class="btn btn-default" id="btn-workload-no">Hủy bỏ</button>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0">
            <thead>
                <tr>

                    <th>Mã NV</th>
                    <th>Họ Tên</th>
                    <th>Khoa</th>
                    <th>Mã - Tên môn học</th>
                    <th>Số tiết</th>
                    <th>Học kỳ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if($workloads->count() >0)
                @foreach ($workloads as $item)
                <tr>
                    <td class="col-sm-1">

                        <a href="{{route('admin.workload.detail',$item->id)}}" data-toggle="tooltip" data-placement="right"
                            title="" data-original-title="Chi tiết" href="javascript:" class="search_tag tooltip-test">
                            <span class="badge badge-danger">{{$item->pi->employee_code}}
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </td>
                    <td class="col-sm-2">{{$item->pi->full_name}}</td>
                    <td class="col-sm-1">{{$item->unit->unit_code}}</td>
                    <td class="col-sm-3">{{$item->subject_code}} - {{$item->subject_name }}</td>
                    <td class="col-sm-2">{{$item->number_of_lessons}}</td>
                    <td class="col-sm-2">{{$item->semester->alias}}</td>
                    <td class="col-sm-2">
                        <a href="{{route('admin.workload.update',$item->id)}}" data-toggle="tooltip" data-placement="top"
                            title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test">
                            <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                        <a href="{{route('admin.workload.delete',$item->id)}}" data-toggle="tooltip" data-placement="top"
                            title="" data-original-title="Xóa" class="delete_workload tooltip-test ml-10">
                            <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                <span class="mdi mdi-close"></span>
                            </span>
                        </a>
                    </td>

                </tr>
                {{--modal delete workload--}}

                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
                    id="pi-delete-modal">

                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa workload này ?</h4>
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

        {{$workloads->links()}}
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(".search_tag").on('click', function() {
            var url = {!!json_encode(route('admin.workload.index'), JSON_UNESCAPED_SLASHES) !!};
            var session_id = $('.year_workload').val();
            var search = "";
            window.location.href = url+'?year_workload='+session_id;
        });

        $('#excel-import').on('change', function(e) {
            var val = $('#excel-import').val();
            if (val == '') {
                $('#excel-import').removeClass('excel-after');
                $('#excel-import').addClass('excel-default');
            } else {
                $('#excel-import').removeClass('excel-default');
                $('#excel-import').addClass('excel-after');
            }
        });


        // import preview
        $(document).ajaxStart(function(){
            $(".waiting").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $(".waiting").css("display", "none");
        });
        $("#btn-import-submit").on('click',function(e){
            e.preventDefault();
            var form = $("#workload-import-form");
            var url_getdata = '{{route('admin.workload.import.data')}}';
            var session = '';
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
               data: new FormData($('#workload-import-form')[0]), // serializes the form's elements.
               success: function(datas)
               {
                $('.row-table-import-tr').remove();
                $('.heading-table-import-tr').remove();
                 if($.isEmptyObject(datas.error)){
                     $.each(datas,function(index,value){
                        if(index == 0){
                            $('.header-import-label').text(datas[index][0]);
                        }
                        if(index == 2){
                            session = datas[index][1];
                            $('.session-import-label').text(datas[index][1]);
                        }
                        if(index==5){

                            $.each(datas[5],function(index1, value1) {
                                $('.heading-table').append($('<th>',{'text':value1,'class':'heading-table-import-tr text-nowrap'}));

                            });
                        }

                        if(index >5){

                            $('.row-table').append($('<tr>',{'class':'row-table-import-tr text-nowrap'}));
                            $.each(datas[index],function(index2, value2) {
                                $('.row-table').children('tr:last').append($('<td>',{'text':value2}));
                            });
                        }


                     });

                     $("#workload-import-modal").modal('show');

                     var modalConfirm = function(callback){

                         $("#btn-workload-yes").on("click", function(){
                             callback(true);
                             $("#workload-import-modal").modal('hide');
                         });

                         $("#btn-workload-no").on("click", function(){
                             callback(false);
                             $("#workload-import-modal").modal('hide');
                         });
                     };
                     modalConfirm(function(confirm){

                         if(confirm){
                            var append_value = $('input[name="append"]:checked').val();

                            var append_input =  $("<input>")
                                                .attr("type", "hidden")
                                                .attr("name", "append").val(append_value);
                            var session_input =  $("<input>")
                                                .attr("type", "hidden")
                                                .attr("name", "session_year").val(session);
                            form.append(append_input);
                            form.append(session_input);
                            form.submit();

                           $('.row-table-import-tr').remove();
                           $('.heading-table-import-tr').remove();
                         }else{
                           $('.row-table-import-tr').remove();
                           $('.heading-table-import-tr').remove();
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
                  $(".print-error-msg").find("ul").append('<li>'+'File tải lên không đúng cấu trúc .Vui lòng xem lại file mẫu <small> <a href="{{route('admin.workload.template.download')}}"> (tải file mẫu)</a></small>'+'</li>');
               },
            });


        });

        $('input[type=radio][name=session_new]').change(function() {
            alert(this.value);
            if (this.value == 0) {
                $('.session_list').removeClass('hide');
                $('.session_new').addClass('hide');
            }
            else if (this.value == 1) {
                $('.session_list').addClass('hide');
                $('.session_new').removeClass('hide');
            }
        });

        $(".delete_workload").on('click',function (e) {
            e.preventDefault();
            $("#pi-delete-modal").modal('show');
            var delete_workload_form = $(this).attr('href');
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
                    window.location.href = delete_workload_form;

                }else{

                }
            });
        });
    });
</script>
@endsection
