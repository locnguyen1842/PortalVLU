@extends('admin.master')
@section('title','Cập nhật đơn xác nhận')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.confirmation.index')}}">Danh sách đơn xác nhận</a></li>
               <li class="active">Cập nhật đơn xác nhận</li>
        </ol>
    </div>
</div>

@endsection
@section('content')
<div style="padding-top: 21px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-12">
                @include('admin.layouts.Error')
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form class="form-horizontal" action="{{route('admin.confirmation.update',$cr->id)}}" method="post">
                    {{csrf_field()}}


                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin đơn xác nhận yêu cầu<br>
                            <a href="{{route('admin.confirmation.print',$cr->id)}}" target="_blank">
                                    <button type="button" name="button" class="btn btn-xs btn-warning">Xuất pdf</button>
                                </a>
                        </div>
                        <div class="panel-body">
                                <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="">Lý do</label>
                                            <input require type="text" class="form-control" name="reason" value="{{$cr->reason}}">
                                        </div>
                                    </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Người ký cấp I</label>
                                    <input require type="text" class="form-control" name="first_signer" value="{{$cr->first_signer == null ? 'KT. HIỆU TRƯỞNG': $cr->first_signer}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Người ký cấp II</label>
                                    <input require type="text" class="form-control" name="second_signer" value="{{$cr->second_signer == null ? 'PHÓ HIỆU TRƯỞNG': $cr->second_signer}}">
                                </div>
                                <div class="col-sm-4">
                                        <label for="">Họ tên người ký</label>
                                        <input require type="text" class="form-control" name="name_of_signer" value="{{$cr->name_of_signer}}">
                                    </div>
                            </div>
                            <div class="form-group">


                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <div class="col-sm-offset-2 col-sm-10 text-right">
                                    <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                                    <button type="button" class="btn btn-turquoise btn-preview">Xem trước</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                            <div class="modal fade cr-preview-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="cr-preview-modal">

                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                              <div class="preview-confirmation">
                                                    <iframe frameborder="0" style="width:100%;height:400px" src="{{route('admin.confirmation.preview',$cr->id)}}"></iframe>
                                              </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-preview-no" id="btn-preview-no">Quay lại</button>
                                                <button type="button" class="btn btn-warning btn-preview-yes" id="btn-preview-yes">Xuất pdf</button>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-preview').on('click',function(e){
            e.preventDefault();
            var modal = $('.cr-preview-modal');
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
            };
            modalConfirm(function(confirm){
                if(confirm){
                    window.open(
                        send_form,
                        '_blank' // <- This is what makes it open in a new window.
                    );

                }else{

                }
            });
        });
    });
</script>
@endsection
