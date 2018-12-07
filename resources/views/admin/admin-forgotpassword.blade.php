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

        <script src="{{asset('js/lib/jquery-2.1.3.min.js')}}"></script>
        <title>Quên mật khẩu - Portal VLU</title>
    </head>
    <body class="cm-no-transition cm-2-navbar">
        @include('admin.layouts.left-sidebar')
        <header id="cm-header">
            {{-- breadcrumb --}}
            <nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
                <div class="cm-flex">
                    <div class="cm-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Quên mật khẩu</li>
                        </ol>
                    </div>
                </div>
            </nav>
        </header>
        <div id="global">
            <div class="container-fluid">
              <div class="container">
                  <div class="row justify-content-center">
                    <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">ADMIN Reset Password</div>
                  <div class="panel-body">
                      @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif

                      <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.email') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary">
                                      Send Password Reset Link
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
              </div>
            </div>
            <footer class="cm-footer"><span class="pull-left">Van Lang Univercity</span><span class="pull-right">&copy; PAOMEDIA SARL</span></footer>
        </div>
        <script src="{{asset('js/jquery.mousewheel.min.js')}}"></script>
        <script src="{{asset('js/jquery.cookie.min.js')}}"></script>
        <script src="{{asset('js/fastclick.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/clearmin.min.js')}}"></script>
        <script src="{{asset('js/demo/popovers-tooltips.js')}}"></script>
    </body>
</html>
