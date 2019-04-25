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
                            <a href="{{route('admin.pi.index')}}" class="md-contacts">Danh sách nhân viên</a>
                        </li>
                        @can('cud', App\PI::first())
                        <li class="{{url()->current() == route('admin.pi.add') ? 'active':''}}">
                            <a href="{{route('admin.pi.add')}}" class=" sf-sign-add">Thêm mới nhân viên</a>
                        </li>
                        @endcan
                    {{-- <li class="cm-submenu {{(url()->current() == route('admin.pi.index')||url()->current() == route('admin.pi.add')) ? 'open':''}}">
                        <a class=" sf-profile-group">
                            Quản lý nhân viên
                            <span class="caret"></span>

                        </a>
                        <ul>
                            <li class="{{url()->current() == route('admin.pi.index') ? 'active':''}}">
                                <a href="{{route('admin.pi.index')}}">Danh sách nhân viên</a>

                            </li>
                            <li class="{{url()->current() == route('admin.pi.add') ? 'active':''}}">
                                <a href="{{route('admin.pi.add')}}">Thêm mới nhân viên</a>

                            </li>
                        </ul>
                    </li> --}}
                    <li class="{{url()->current() == route('admin.workload.index') ? 'active':''}}">
                        <a href="{{route('admin.workload.index')}}" class="md-assignment">Danh sách khối lượng GD</a>
                    </li>
                    @can('cud', App\PI::first())
                    <li class="{{url()->current() == route('admin.workload.add') ? 'active':''}}">
                        <a href="{{route('admin.workload.add')}}" class=" sf-sign-add">Thêm mới khối lượng GD</a>
                    </li>
                    @endcan
                    <li class="{{url()->current() == route('admin.srworkload.index') ? 'active':''}}">
                        <a href="{{route('admin.srworkload.index')}}" class=" md-work">Danh sách khối lượng NCKH</a>
                    </li>
                    @can('cud', App\PI::first())
                    <li class="{{url()->current() == route('admin.srworkload.add') ? 'active':''}}">
                        <a href="{{route('admin.srworkload.add')}}" class=" sf-sign-add">Thêm mới khối lượng NCKH</a>
                    </li>
                    @endcan
                    <li class="{{url()->current() == route('admin.confirmation.index') ? 'active':''}}">
                            <a href="{{route('admin.confirmation.index')}}" class="md-assignment-turned-in">Danh sách đơn yêu cầu</a>
                        </li>

                    {{-- <li class="cm-submenu {{(url()->current() == route('admin.workload.index')|| url()->current() == route('admin.workload.add')) ? 'open':''}}">
                            <a class="sf-dashboard ">
                                Khối lượng giảng dạy
                                <span class="caret"></span>

                            </a>
                            <ul>
                                <li class="{{url()->current() == route('admin.workload.index') ? 'active':''}}">
                                    <a href="{{route('admin.workload.index')}}">Danh sách KLGD</a>

                                </li>
                                <li class="{{url()->current() == route('admin.workload.add') ? 'active':''}}">
                                    <a href="{{route('admin.workload.add')}}">Thêm mới KLGD</a>

                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="cm-submenu">
                                <a class="sf-dashboard-alt">
                                    Khối lượng NCKH
                                    <span class="caret"></span>

                                </a>
                                <ul>
                                    <li class="{{url()->current() == route('admin.pi.index') ? 'active':''}}">
                                        <a href="{{route('admin.pi.index')}}">Danh sách KLNCKH</a>

                                    </li>
                                    <li class="{{url()->current() == route('admin.pi.index') ? 'active':''}}">
                                        <a href="{{route('admin.pi.add')}}">Thêm mới KLNCKH</a>

                                    </li>
                                </ul>
                            </li> --}}
                     <li class="{{url()->current() == route('admin.statistic.index') ? 'active':''}}">
                            <a href="{{route('admin.statistic.index')}}" class="sf-notepad">Thống kê - Báo cáo</a>
                        </li>

                </ul>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    $(document).ready(function(){
        var f = $('.cm-submenu');
        var h = f.hasClass("open");
        if(h){

            f.nextAll().css("transform", "translateY(" + f.children("ul").height() + "px)");
            $('.cm-submenu.open').removeAttr("style");
        }
    })

</script> --}}
