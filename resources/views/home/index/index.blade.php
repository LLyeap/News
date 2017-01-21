@extends('home.layouts.main')

{{-- 标题 --}}
@section('title', '首页')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    <!-- 轮播图开始 !!考虑应该是循环!! -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- 轮播图上圆点导航开始 -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol> <!-- 轮播图上圆点导航结束 -->

        <!-- 轮播图主内容开始 -->
        <div class="carousel-inner" role="listbox">

            <div class="item active">
                <img src="{{ asset('common/images/test.jpg') }}" alt="...">
                <div class="carousel-caption">
                    <h3>最美好的事 莫过遇见你--校团委迎新系列活动火热进行中</h3>
                    <p> “新生活，新希望，新辉煌——青春从这里起航”，“在青春的路上遇见你，遇见最好的自己”，9月3日的吉师校园，火红的迎新条幅处处可见。来自祖国各地的2016级小鲜肉报到，为吉师注入跃动的青春活力。校团委、校学生会、校社联的迎新系列活动紧锣密鼓地全面展开，帮助新生了解校园文化，更快地融入吉林师范大学这个温暖的大家庭。校党委书记许才山、校长杨景海、副校长祖国华、党委副书记刘万民、副校长曲殿彬观看特色社团风采展。</p>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('common/images/test.jpg') }}" alt="...">
                <div class="carousel-caption">
                    <h3>...</h3>
                    <p>...</p>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('common/images/test.jpg') }}" alt="...">
                <div class="carousel-caption">
                    <h3>...</h3>
                    <p>...</p>
                </div>
            </div>

        </div> <!-- 轮播图主内容结束 -->

        <!-- 轮播图左箭头 < 开始 -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a> <!-- 轮播图左箭头 < 结束 -->

        <!-- 轮播图右箭头 > 开始 -->
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a> <!-- 轮播图右箭头 > 结束 -->
    </div> <!-- 轮播图结束 -->


    <!-- 下面分类栏目快开始 -->
    @include('home/public/main/_main_cell', ['section_title' => '团情快报', 'posts' => 1, 'category_id' => 1])
    @include('home/public/main/_main_cell', ['section_title' => '通知公告', 'posts' => 1, 'category_id' => 1])
    @include('home/public/main/_main_cell', ['section_title' => '学院风采', 'posts' => 1, 'category_id' => 1])
    @include('home/public/main/_main_cell', ['section_title' => '学生会 & 社联', 'posts' => 1, 'category_id' => 1])
    <!-- 下面分类栏目快结束 -->

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
