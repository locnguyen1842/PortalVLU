<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clearmin.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/roboto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="icon" href="{{asset('img/logoVL-notext2.png')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Quên mật khẩu</title>
    <style></style>
</head>

<body class="cm-login">
      <div class="text-center" style="padding-top:30px;">
          <img src="{{asset('img/logoVL1.png')}}" width="300" height="100">
      </div>

      <div class="col-sm-6 col-md-4 col-lg-3" style="margin:40px auto; float:none;">
          <form method="post" action="{{route('employee.password.email')}}">
              {{ csrf_field() }}

              <div class="panel">
                <div class="panel-heading">
                  <h4>Quên mật khẩu</h4>

                </div>
                <div class="panel-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                  @if (session('error'))
                      <div class="alert alert-danger" role="alert">
                          {{ session('error') }}
                      </div>
                  @endif
                  @if (count($errors) > 0)
                      <div class="alert alert-danger">

                              @foreach ($errors->all() as $error)
                                  {{ $error }}
                              @endforeach

                      </div>
                  @endif


                  <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                          <input required id="employee_code" type="text" placeholder="Nhập mã nhân viên" class="form-control" name="employee_code" value="{{ old('employee_code') }}" required>

                      </div>
                  </div>
                  <div style="margin-top:20px" class="col-xs-12">
                      <button type="submit" class="btn btn-block btn-primary">Gửi mail khôi phục mật khẩu</button>
                  </div>

                </div>
                <div class="panel-footer text-center">
                    <a href="{{route('employee.login')}}">Quay về trang đăng nhập</a>
                </div>

              </div>


          </form>
      </div>
    </div>


</body>
