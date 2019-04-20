@extends('employee.master')
@section('title','Danh sách đơn yêu cầu')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class="active">Danh sách đơn yêu cầu</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')


<div  style="padding-top:21px">
    @include('employee.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default mt-20">
        <div class="waiting">
            <img src="{{asset('img/loader.gif')}}" alt="Đang tải">
        </div>
        <div class="panel-heading">Danh sách đơn yêu cầu<br>

            <a href="{{route('employee.confirmation.create')}}">
                <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
            </a>

        </div>


        <div class="table-responsive">
            <table class="table table-hover" style="margin-bottom:0">
                <thead>
                    <tr>

                        <th>Lý do</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($crs->count() >0)
                    @foreach ($crs as $item)
                    <tr>
                        <td>{{$item->reason}}
                                <a href="{{route('employee.confirmation.send',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Xem trước" href="javascript:" class="preview_cr tooltip-test ml-10">
                                        <span class=""><i class="fa fa-lg fa-sign-out"></i>
                                            <span class="mdi mdi-close"></span>
                                        </span>
                                    </a>
                                    <div class="modal fade cr-preview-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="cr-preview-modal">

                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                      <div class="preview-confirmation">
                                                            <iframe frameborder="0" style="width:100%;height:400px" src="{{route('employee.confirmation.preview',$item->id)}}"></iframe>
                                                      </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-preview-no" id="btn-preview-no">Quay lại</button>
                                                        @if($item->status== 0)
                                                        <button type="button" data-src="{{route('employee.confirmation.update',$item->id)}}" name="button" class="btn btn-primary btn-preview-update" id="btn-preview-update">Cập nhật</button>

                                                        <button type="button" class="btn btn-success btn-preview-yes" id="btn-preview-yes">Gửi yêu cầu</button>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        </td>

                        <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                        <td class="font-weight-bold {{$item->status == 0 ? 'text-warning':'text-success'}}">{{$item->status == 0 ? 'Chưa gửi': 'Đã gửi'}}</td>

                        @if($item->status == 0)
                        <td>
                            <a href="{{route('employee.confirmation.send',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                    title="" data-original-title="Gửi yêu cầu" href="javascript:" class="tooltip-test">
                                    <span class=""><i class="fa fa-lg fa-send-o text-success"></i>
                                        <span class="mdi mdi-close"></span>
                                    </span>
                                </a>

                            <a href="{{route('employee.confirmation.update',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Cập nhật" href="javascript:" class="tooltip-test ml-10">
                                <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                            <a href="{{route('employee.confirmation.delete',$item->id)}}" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Xóa" class="delete_cr tooltip-test ml-10">
                                <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                                    <span class="mdi mdi-close"></span>
                                </span>
                            </a>
                        </td>
                        @else

                            <td></td>

                        @endif


                    </tr>
                    {{--modal show preview--}}

                    {{-- end modal --}}
                    {{--modal delete workload--}}

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
                        id="pi-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xóa đơn yêu cầu này ?</h4>
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
                {{$crs->links()}}

        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $(".delete_cr").on('click',function (e) {
            e.preventDefault();
            $("#pi-delete-modal").modal('show');
            var delete_cr_form = $(this).attr('href');
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
                    window.location.href = delete_cr_form;

                }else{

                }
            });
        });

        $(".preview_cr").on('click',function (e) {
            e.preventDefault();
            var modal = $(this).closest('tr').find('.cr-preview-modal');
            var btn_yes = modal.find('.btn-preview-yes');
            var btn_no = modal.find('.btn-preview-no');
            var btn_update = modal.find('.btn-preview-update');
            modal.modal('show');

            var send_form = $(this).attr('href');
            var modalConfirm = function(callback){

                btn_yes.on("click", function(){
                    callback(true);
                    modal.modal('hide');
                });

                btn_no.on("click", function(){
                    callback(false);
                    modal.modal('hide');
                });

                btn_update.on("click", function(){
                    callback(false);
                    window.location.href = $(this).data('src');
                    modal.modal('hide');
                });
            };
            modalConfirm(function(confirm){
                if(confirm){
                    window.location.href = send_form;

                }else{

                }
            });
        });


    });

</script>
@endsection
