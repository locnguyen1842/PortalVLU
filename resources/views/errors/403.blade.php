@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Lỗi - Portal VLU'))

@section('image')
<div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', 'Bạn không có quyền thực hiện thao tác này!')
