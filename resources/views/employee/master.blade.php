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
    <body class="cm-no-transition cm-2-navbar">
        @include('employee.layouts.left-sidebar')
        <header id="cm-header">
            @include('employee.layouts.header-menu')
            {{-- breadcrumb --}}
            @yield('breadcrumb')
        </header>
        <div id="global">
            <div class="container-fluid">
                @yield('content')
            </div>
            <footer class="cm-footer"><span class="pull-left">Van Lang University</span><span class="pull-right">&copy; CAP-Team6</span></footer>
        </div>
        <script src="{{asset('js/jquery.mousewheel.min.js')}}"></script>
        <script src="{{asset('js/jquery.cookie.min.js')}}"></script>
        <script src="{{asset('js/fastclick.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/clearmin.min.js')}}"></script>
        <script src="{{asset('js/demo/popovers-tooltips.js')}}"></script>
    </body>
</html>
