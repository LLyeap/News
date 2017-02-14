<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="{{url('/')}}" class="logo-expanded">
            <i class="ion-social-buffer"></i>
            <span class="nav-label">JLNU</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">

            <li class="active"><a href="{{ url('/') }}"><i class="zmdi zmdi-view-dashboard"></i> <span class="nav-label">首页</span></a></li>

            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">角色管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('admin_role') }}">角色列表</a></li>
                    <li><a href="{{ url('admin_role/create') }}">新建角色</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-accounts"></i> <span class="nav-label">用户管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('admin_user') }}">用户列表</a></li>
                    <li><a href="{{ url('admin_user/create') }}">新建用户</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-collection-text"></i> <span class="nav-label">内容管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('content') }}">内容列表</a></li>
                    <li><a href="{{ url('content/create') }}">新建内容</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-album"></i> <span class="nav-label">类别管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('category') }}">类别列表</a></li>
                    <li><a href="{{ url('category/create') }}">新建类别</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-navigation"></i> <span class="nav-label">导航栏管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('nav') }}">导航栏列表</a></li>
                    <li><a href="{{ url('nav/create') }}">新建导航栏</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-link"></i> <span class="nav-label">友链管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('link') }}">友链列表</a></li>
                    <li><a href="{{ url('link/create') }}">新建友链</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-power"></i> <span class="nav-label">网站管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('stop') }}">一键停用</a></li>
                    <li><a href="{{ url('copyright') }}">版权</a></li>
                </ul>
            </li>

            {{--@if (!empty(session('admin')->sroce) && session('admin')->sroce == 1)--}}
                {{--<li class="has-submenu"><a href="#"><i class="zmdi zmdi-lock"></i> <span class="nav-label">系统管理</span><span class="menu-arrow"></span></a>--}}
                    {{--<ul class="list-unstyled">--}}
                        {{--<li><a href="{{url('purview')}}">权限管理</a></li>--}}
                        {{--<li><a href="{{url('role')}}">角色管理</a></li>--}}
                        {{--<li><a href="{{url('manager')}}">管理员管理</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--@endif--}}
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->