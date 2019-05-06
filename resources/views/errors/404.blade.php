@extends('errors::illustrated-layout')

@section('code', '404')
@section('title', __('Không tìm thấy trang yêu cầu - Portal VLU'))

@section('image')
<div style="background-image: url({{ asset('/svg/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', __('Xin lỗi, trang bạn đang tìm kiếm không tồn tại!'))
