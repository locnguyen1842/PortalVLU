@extends('admin.master')
@section('title','Danh sách khối lượng công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class="active">Quản lý năm học</li>
            </ol>
        </div>
    </div>
@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup" >
    <div class="cm-flex">
        <div class="nav-tabs-container  table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('admin.workload.index') ? 'active':''}}"><a href="{{route('admin.workload.index')}}">Quản lý khối lượng công việc</a></li>
                <li class="{{url()->current() == route('admin.srworkload.index') ? 'active':''}}"><a href="{{route('admin.srworkload.index')}}">Quản lý khối lượng NCKH</a></li>
                <li class="{{url()->current() == route('admin.schoolyear.index') ? 'active':''}}"><a href="{{route('admin.schoolyear.index')}}">Quản lý năm học</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')


<div  style="padding-top:51px">
    @include('admin.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default mt-20">
        <div class="waiting">
            <img src="{{asset('img/loader.gif')}}" alt="Đang tải">
        </div>
        <div class="panel-heading">Danh sách năm học<br>
            @can('cud',App\PI::first())
            <a href="{{route('admin.schoolyear.add')}}" methods="post">
                <button type="button" name="button" class="btn btn-xs btn-success">Thêm Mới</button>
            </a>
            @endcan
        </div>


        <div class="table-responsive">
            <table class="table table-hover" style="margin-bottom:0">
                <thead>
                    <tr>
                        <th>Năm bắt đầu</th>
                        <th>Năm kết thúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($yearlist->count() >0)
                    @foreach ($yearlist as $item)
                    <tr>
                        <td class="col-sm-6">{{$item->start_year}}</td>
                        <td class="col-sm-5">{{$item->end_year}}</td>
            @can('cud',App\PI::first())

                        <td class="col-sm-1">
                            <a href="{{route('admin.schoolyear.update',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test">
                                <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                            <a href="{{route('admin.schoolyear.delete',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Xóa" class="delete_workload tooltip-test ml-10">
                                <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                        </td>
                        @else
                        <td></td>
                        @endcan

                    </tr>
                    {{--modal delete workload--}}
                    @can('cud',App\PI::first())

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
                        id="pi-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa năm học này ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                    <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endcan

                    @endforeach
                    @else
                    <tr>
                        <td colspan="3" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>
        <div class="panel-footer">
                {{$yearlist->links()}}

        </div>
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
                            $('.header-import-label').text('XEM TRƯỚC : '+datas[index][0]);
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
                         });

                         $("#btn-workload-no").on("click", function(){
                             callback(false);
                             $("#workload-import-modal").modal('hide');
                         });
                     };
                     modalConfirm(function(confirm){

                         if(confirm){
                            var test = '<img width="40px" height="40px" src="{{asset('img/loader.gif')}}" alt="Đang tải">';
                            $('#header-modal').append(test);
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


            // $(this).val('');
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
