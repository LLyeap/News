<!-- 顶部导航条开始 -->
<header class="top-head container-fluid">
    <!-- 菜单按钮构造开始 -->
    <button type="button" class="navbar-toggle pull-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
     </button> <!-- 菜单按钮构造结束 -->

    <!-- 搜索框开始 -->
    <form role="search" class="navbar-left app-search pull-left hidden-xs">
        <input type="text" placeholder="Search..." class="form-control">
        <a href=""><i class="fa fa-search"></i></a>
    </form> <!-- 搜索框结束 -->

    <!-- 顶部条上的导航开始 -->
    <nav class=" navbar-default" role="navigation">
        <!-- 左侧导航开始 -->
        <ul class="nav navbar-nav hidden-xs">
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">汉语 <span class="caret"></span></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="#">English</a></li>
                    <li><a href="#">한국어</a></li>
                    <li><a href="#">日本語</a></li>
                </ul>
            </li>
            <li><a href="#">文件</a></li>
        </ul> <!-- 左侧导航结束 -->

        <!-- 右侧导航开始 -->
        <ul class="nav navbar-nav navbar-right top-menu top-right-menu">
            <!-- 邮件信息开始 -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="zmdi zmdi-email-open"></i>
                    <span class="badge badge-sm up bg-purple count">4</span>
                </a>
                <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
                    <li>
                        <p>Messages</p>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pull-left"><img src="http://cdn.rooyun.com/picture/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                            <span class="block"><strong>John smith</strong></span>
                            <span class="media-body block">有一个任务需要处理<br><small class="text-muted">10秒之前</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pull-left"><img src="http://cdn.rooyun.com/picture/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                            <span class="block"><strong>John smith</strong></span>
                            <span class="media-body block">新任务需要去完成<br><small class="text-muted">3分种之前</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pull-left"><img src="http://cdn.rooyun.com/picture/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                            <span class="block"><strong>John smith</strong></span>
                            <span class="media-body block">有新任务需要去完成<br><small class="text-muted">10分钟之前</small></span>
                        </a>
                    </li>
                    <li>
                        <p><a href="inbox.html" class="text-right">查看所有消息</a></p>
                    </li>
                </ul>
            </li> <!-- 邮件信息结束 -->

            <!-- 注意信息开始 -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="zmdi zmdi-notifications-none"></i>
                    <span class="badge badge-sm up bg-pink count">3</span>
                </a>
                <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                    <li class="noti-header">
                        <p>通知</p>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
                            <span>注册新用户<br><small class="text-muted">5分钟之前</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
                            <span>使用animate.css<br><small class="text-muted">5分钟之前</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
                            <span>发送项目Demo文件到客户端<br><small class="text-muted">1小时之前</small></span>
                        </a>
                    </li>

                    <li>
                        <p><a href="#" class="text-right">查看所有通知</a></p>
                    </li>
                </ul>
            </li> <!-- 注意信息结束 -->

            <!-- 用户登录信息开始 -->
            <li class="dropdown text-center">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="http://cdn.rooyun.com/picture/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                    <span class="username">{{-- Session::get('manager')->email --}}</span> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                    <li><a href="#"><i class="fa fa-cog"></i> 上一次登陆时间：{{-- date('Y年m月d日 H:i:s',Session::get('manager')->logintime) --}}</a></li>
                    <li><a href="#"><i class="fa fa-bell"></i> 上一次登陆IP：{{-- Session::get('manager')->ip --}}</a></li>
                    <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i>退出</a></li>
                </ul>
            </li> <!-- 用户登录信息结束 -->
        </ul> <!-- 右侧导航结束 -->
    </nav> <!-- 顶部条上的导航开始 -->

</header> <!-- 顶部导航条结束 -->