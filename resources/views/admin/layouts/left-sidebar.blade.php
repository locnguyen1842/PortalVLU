<div id="cm-menu">
    <nav class="cm-navbar cm-navbar-danger">
        <div class="cm-flex"><a href="{{route('admin.pi.index')}}" class="vlu-logo"></a></div>
        <div class="btn btn-danger md-menu-white" data-toggle="cm-menu"></div>
    </nav>
    <div id="cm-menu-content">
        <div id="cm-menu-items-wrapper">
            <div id="cm-menu-scroller">
                <ul class="cm-menu-items">

                    <li class="{{url()->current() == route('admin.pi.index') ? 'active':''}}">
                      <a href="{{route('admin.pi.index')}}" class="sf-profile-group">Quản lý thông tin cá nhân</a>
                    </li>
                    {{-- <li><a href="components-text.html" class=" sf-cog ">Quản lý tài khoản</a></li> --}}
{{--
                    <li class="cm-submenu">
                        <a class="sf-cat">Icons <span class="caret"></span></a>
                        <ul>
                            <li><a href="ico-sf.html">Small-n-flat</a></li>
                            <li><a href="ico-md.html">Material Design</a></li>
                            <li><a href="ico-fa.html">Font Awesome</a></li>
                        </ul>
                    </li>
                   --}}
                </ul>
            </div>
        </div>
    </div>
</div>
