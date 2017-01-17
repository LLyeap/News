<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="{{url('/')}}" class="logo-expanded">
            <i class="ion-social-buffer"></i>
            <span class="nav-label">JIANGU</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">

            <li class="active"><a href="{{url('/')}}"><i class="zmdi zmdi-view-dashboard"></i> <span class="nav-label">首页</span></a></li>

            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">用户模块</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{url('user_list')}}">用户列表</a></li>
                    <li><a href="{{url('user_checkout')}}">提现列表</a></li>
                    <li><a href="{{url('card/create')}}">银行类型添加</a></li>
                    <li><a href="{{url('card')}}">银行类型列表</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">模拟模块</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{url('user_demo_list')}}">模拟库用户列表</a></li>
                    <li><a href="{{url('order_demo_list')}}">模拟库当前订单</a></li>
                    <li><a href="{{url('vend_demo_list')}}">模拟库平仓订单</a></li>
                    <li><a href="{{url('reserve_demo_list')}}">模拟库挂单</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-album"></i> <span class="nav-label">交易模块</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{url('trade_order')}}">查询订单</a></li>
                </ul>
            </li>

            <li class="has-submenu"><a href="#"><i class="zmdi zmdi-collection-text"></i> <span class="nav-label">网站管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{url('recover_cache')}}">一键缓存</a></li>
                    <li><a href="{{url('feed_back')}}">意见反馈列表</a></li>
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