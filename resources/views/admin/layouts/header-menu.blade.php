<nav class="cm-navbar cm-navbar-danger">
    <div class="btn btn-danger md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
    <div class="cm-flex">
    </div>
    <div class="dropdown pull-right">
        <button class="btn btn-danger md-notifications-white" data-toggle="dropdown"> <span class="label label-danger">23</span> </button>
        <div class="popover cm-popover bottom">
            <div class="arrow"></div>
            <div class="popover-content">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading text-overflow">
                            <i class="fa fa-fw fa-envelope"></i> Nunc volutpat aliquet magna.
                        </h4>
                        <p class="list-group-item-text text-overflow">Pellentesque tincidunt mollis scelerisque. Praesent vel blandit quam.</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">
                            <i class="fa fa-fw fa-envelope"></i> Aliquam orci lectus
                        </h4>
                        <p class="list-group-item-text">Donec quis arcu non risus sagittis</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">
                            <i class="fa fa-fw fa-warning"></i> Holy guacamole !
                        </h4>
                        <p class="list-group-item-text">Best check yo self, you're not looking too good.</p>
                    </a>
                </div>
                <div style="padding:10px"><a class="btn btn-success btn-block" href="#">Show me more...</a></div>
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
            <li>
                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-cog"></i> Settings</a>
            </li>
            <li>
                <a href="{{route('admin.logout')}}"><i class="fa fa-fw fa-sign-out"></i> Sign out</a>
            </li>
        </ul>
    </div>
</nav>
