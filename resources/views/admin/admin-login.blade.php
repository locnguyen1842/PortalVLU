<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clearmin.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/roboto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Đăng nhập</title>
    <style></style>
</head>

<body class="cm-login">
    <div class="text-center" style="padding-top:30px;">
        <img src="{{asset('img/logoVL.png')}}" width="300" height="100">
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">
        <form method="post" action="{{route('admin.login.submit')}}">
            {{ csrf_field() }}

            <div class="panel">
                <div class="panel-heading">
                    <h4>Đăng Nhập - Admin</h4>

                </div>
                <div class="panel-body">
                    @if(session('error_message'))
                    <div class="col-sm-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{session('error_message')}}

                        </div>
                    </div>

                    @endif
                    @if (count($errors) > 0)
                    <div class="col-xs-12 alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                <input type="text" name="username" class="form-control" placeholder="Tên tài khoản">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i></div>
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="checkbox"><label><input type="checkbox">Ghi nhớ</label></div>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-block btn-primary">Đăng nhập</button>
                    </div>

                </div>
                <div class="panel-footer text-center">
                    <a href="{{route('admin.password.request')}}">Quên mật khẩu?</a>
                </div>
            </div>


        </form>
    </div>
    </div>


</body>
