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
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">用户管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('admin_user') }}">用户列表</a></li>
                    <li><a href="#">新建用户</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-collection-text"></i> <span class="nav-label">文章管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="#">内容列表</a></li>
                    <li><a href="content/create">新建内容</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-album"></i> <span class="nav-label">分类管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="#">分类列表</a></li>
                    <li><a href="#">新建分类</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-power"></i> <span class="nav-label">网站管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="#">导航栏</a></li>
                    <li><a href="#">友情链接</a></li>
                    <li><a href="#">一键停用</a></li>
                    <li><a href="#">版权</a></li>
                </ul>
            </li>

            @if (!empty(session('admin')->sroce) && session('admin')->sroce == 1)
                <li class="has-submenu"><a href="#"><i class="zmdi zmdi-lock"></i> <span class="nav-label">系统管理</span><span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('purview')}}">权限管理</a></li>
                        <li><a href="{{url('role')}}">角色管理</a></li>
                        <li><a href="{{url('manager')}}">管理员管理</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->