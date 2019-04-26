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
                            <div class="panel-heading">Thông tin đơn xác nhận thu nhập
                            </div>
                            <div class="panel-body">
                                <div class="form-group text-center">
                                    <div class="col-sm-12">
                                    <p style="font-size:24px">Xác nhận thu nhập trong <b>{{$cr->number_of_month_income}}</b> gần nhất</p>

                                    </div>
                                </div>
                                <div class="table-responsive">
                                        <table class="table table-hover" style="margin-bottom:0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">STT</th>
                                                    <th>Tháng / Năm thu nhập</th>
                                                    <th>Thu nhập (VNĐ)</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="confirmation_incomes_repeater">

                                                <tr>
                                                    <td colspan="3">
                                                        <button type="button" class="btn btn-sm btn-success btn-block r-add-income">Thêm
                                                            mới</button>

                                                    </td>
                                                </tr>

                                                <tr class="group-confirmation-incomes form-horizontal">
                                                        <td class="col-sm-1 td-center">
                                                                <label for="date_of_income" data-pattern-text="+=1">1</label>
                                                                <input type="hidden">

                                                            </td>
                                                    <td class="col-sm-2">
                                                        <div class="col-sm-5">
                                                                <input type="number" min="1" max="12"  class="form-control" name="month_of_income[]">

                                                        </div>
                                                        <div class="col-sm-7">
                                                                <input type="number" class="form-control" name="year_of_income[]">

                                                        </div>

                                                    </td>
                                                    <td class="col-sm-4">
                                                        <input autocomplete="off" type="number" class="form-control money-input" name="amount_of_income[]">

                                                        <span data-pattern-name="help-block[++]" name="help-block[]" class="help-block money" style="margin-left:13px"></span>
                                                    </td>
                                                    <td class="col-sm-1">
                                                        <button type="button" class="btn btn-danger r-delete-income">Xóa</button>

                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>

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
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin đơn xác nhận yêu cầu<br>

                        </div>
                        <div class="panel-body">
                                <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="">Lý do</label>
                                            <input required type="text" class="form-control" name="confirmation" value="{{$cr->confirmation}}">
                                        </div>
                                    </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Người ký cấp I</label>
                                    <input required type="text" class="form-control" name="first_signer" value="{{$cr->first_signer == null ? 'KT. HIỆU TRƯỞNG': $cr->first_signer}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Người ký cấp II</label>
                                    <input required type="text" class="form-control" name="second_signer" value="{{$cr->second_signer == null ? 'PHÓ HIỆU TRƯỞNG': $cr->second_signer}}">
                                </div>
                                <div class="col-sm-4">
                                        <label for="">Họ tên người ký</label>
                                        <input required type="text" class="form-control" name="name_of_signer" value="{{$cr->name_of_signer}}">
                                    </div>
                            </div>
                            <div class="form-group">


                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <div class="col-sm-offset-2 col-sm-10 text-right">
                                    <button type="button" class="btn btn-default btn-back">Quay lại</button>
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
        <script src="{{asset('js/jquery.form-repeater.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-back').on('click',function(){
            window.open(
                        '{{route('admin.confirmation.index')}}',
                        '_self'
                    );
        })
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

        // 4

        var list4 = '{!!json_encode($cr->incomes->toArray())!!}';

        var list_confirmation_incomes = JSON.parse(list4);
        var text;
        var array_confirmation_incomes = new Array();
        var month_of_income = "month_of_income[]";
        var year_of_income = "year_of_income[]";
        var help_block = "help-block[]";
        var amount_of_income = "amount_of_income[]";

        list_confirmation_incomes.forEach(function(item,key){
            text = '{'+'"'+ month_of_income+'"'+':'+'"'+item['month_of_income']+'"'+','+'"'+year_of_income+'"'+':'+'"'+item['year_of_income'] +'"'+','+'"'+help_block+'"'+':'+'"'+item['amount_of_income'] +'"'+','+'"'+amount_of_income+'"'+':'+'"'+item['amount_of_income'] +'"'+'}';

            array_confirmation_incomes.push($.parseJSON(text));
        })
        $(array_confirmation_incomes).each(function (index, element) {
            if(array_confirmation_incomes[index][month_of_income] == "null"){
                array_confirmation_incomes[index][month_of_income]= null;
            }
            if(array_confirmation_incomes[index][year_of_income] == "null"){
                array_confirmation_incomes[index][year_of_income]= null;
            }
            if(array_confirmation_incomes[index][amount_of_income] == "null"){
                array_confirmation_incomes[index][amount_of_income]= null;
            }



        });
        $('#confirmation_incomes_repeater').repeater({
            btnAddClass: 'r-add-income',
            btnRemoveClass: 'r-delete-income',
            groupClass: 'group-confirmation-incomes',
            minItems: 1,
            maxItems: 0,
            startingIndex: 0,
            showMinItemsOnLoad: true,
            reindexOnDelete: true,
            repeatMode: 'append',
            animation: 'fade',
            animationSpeed: 400,
            animationEasing: 'swing',
            clearValues: true
        },array_confirmation_incomes);

        function numberWithCommas(num) {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }

        $(document).on('input','.money-input',function(){
            $('.money-input').on('input',function(e){
            $(this).closest('td').find('.help-block').text(numberWithCommas($(this).val()+ ' đồng'));
        })
        })



    });
</script>
@endsection
