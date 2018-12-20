<nav class="cm-navbar cm-navbar-primary">
    <div class="btn btn-primary md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
    <div class="cm-flex">
    </div>
    <div class="dropdown pull-right">
        <button class="btn btn-primary md-notifications-white" data-toggle="dropdown"> <span class="label label-danger"></span> </button>
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
        <button class="btn btn-primary md-account-circle-white" data-toggle="dropdown"></button>
        <ul class="dropdown-menu">
            <li class="disabled text-center">
                <a style="cursor:default;"><strong>{{Auth::guard('employee')->user()->pi->full_name}}</strong></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{route('employee.pi.detail')}}"><i class="fa fa-fw fa-user"></i>Thông tin</a>
            </li>
            <li>
                <a href="{{route('employee.pi.change.pass')}}"><i class="fa fa-fw fa-cog"></i> Đổi mật khẩu</a>
            </li>
            <li>
                <a href="{{route('employee.logout')}}"><i class="fa fa-fw fa-sign-out"></i>Đăng xuất</a>
            </li>
        </ul>
    </div>
</nav>
