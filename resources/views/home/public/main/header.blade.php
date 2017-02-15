<!-- 顶部导航条开始 -->
<div class="navbar navbar-default" role="navigation">
    <!-- 顶部导航条主要内容开始 -->
    <div class="container">
        <!-- 顶部导航条logo开始 -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <span class="main-color text-bold">JLNU</span> 团委
            </a>
        </div> <!-- 顶部导航条logo结束 -->

        <!-- 顶部导航条导航栏目开始 -->
        <div class="navbar-collapse collapse">
            <!-- 左侧导航栏目开始 -->
            <ul class="nav navbar-nav" data-smartmenus-id="14739838239025269">
                @foreach($siteInfo['navArray'] as $nav)
                    <li><a href="{{ $nav->url }}">{{ $nav->name }}</a></li>
                @endforeach
            </ul> <!-- 左侧导航栏目结束 -->

            <!-- 右侧导航栏目开始 -->
            <div class="navbar-right">
                <!-- 右侧其他导航栏目开始 -->
                {{--<ul class="nav navbar-nav">--}}
                    {{--<li>--}}
                        {{--<a href="/assets/images/qrcode_new.png" class="icon-wechat">--}}
                            {{--<i class="fa fa-weixin" aria-hidden="true"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}} <!-- 右侧其他导航栏目结束 -->

                <!-- 右侧搜索框开始 -->
                <form method="GET" action="#" accept-charset="UTF-8" class="navbar-form navbar-left" target="_blank">
                    <div class="form-group">
                        <input class="form-control search-input mac-style" placeholder="搜索" name="q" type="text">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="search-btn">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </form> <!-- 右侧搜索框结束 -->
            </div> <!-- 右侧导航栏目结束 -->
        </div> <!-- 顶部导航条导航栏目结束 -->
    </div> <!-- 顶部导航条主要内容结束 -->
</div> <!-- 顶部导航条结束 -->
