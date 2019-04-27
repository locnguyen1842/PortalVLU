<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clearmin.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/roboto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/material-design.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/small-n-flat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="icon" href="{{asset('img/logoVL-notext2.png')}}">
    <script src="{{asset('js/lib/jquery-2.1.3.min.js')}}"></script>
    <title>@yield('title') - Portal VLU</title>
</head>

<body class="cm-no-transition cm-1-navbar">
    @include('admin.layouts.left-sidebar')
    <header id="cm-header">
        <nav class="cm-navbar cm-navbar-danger">
            <div class="btn btn-danger md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
            {{-- header left --}}
            @yield('breadcrumb')
            {{-- header right --}}
            <div class="dropdown pull-right">
                <button class="btn btn-danger md-notifications-white" data-toggle="dropdown"> <span class="label label-success"></span> </button>
                <div class="popover cm-popover bottom">
                    <div class="arrow"></div>
                    <div class="popover-content">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading text-overflow">
                                    <i class="fa fa-fw fa-envelope"></i> Thông báo
                                </h4>
                                <p class="list-group-item-text text-overflow">Chức năng sẽ được phát triển trong tương lai</p>
                            </a>

                        </div>
                        <div style="padding:10px"><a class="btn btn-success btn-block" href="#">Xem thêm</a></div>
                    </div>
                </div>
            </div>

            <div class="dropdown pull-right">
                <button class="btn btn-danger md-account-circle-white" data-toggle="dropdown"></button>
                <ul class="dropdown-menu">
                    <li class="disabled text-center">
                        <a style="cursor:default;"><strong>{{Auth::guard('admin')->user()->pi->full_name}}</strong></a>
                    </li>
                    <li class="divider"></li>
                    {{-- <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li> --}}
                    <li>
                        <a href="{{route('admin.pi.change.pass')}}"><i class="fa fa-fw fa-cog"></i> Đổi mật khẩu</a>
                    </li>
                    <li>
                        <a href="{{route('admin.logout')}}"><i class="fa fa-fw fa-sign-out"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Menu tabs --}}
        @yield('menu-tabs')
    </header>
    <div id="global">
        <div class="container-fluid">
            @yield('content')
        </div>
        <footer class="cm-footer"><span class="pull-left">Trang Cổng Thông Tin - Trường Đại Học Văn Lang</span></footer>
    </div>
    <script src="{{asset('js/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.min.js')}}"></script>
    <script src="{{asset('js/fastclick.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/clearmin.min.js')}}"></script>
    <script src="{{asset('js/demo/popovers-tooltips.js')}}"></script>
</body>

</html>
