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

        {{-- */ $beFirst = 1; /* --}}
        @foreach($carouselArray as $carousel)
            @if($beFirst == 1)
                <div class="item active">
                {{-- */ $beFirst = 0; /* --}}
            @else
                <div class="item">
            @endif

                    <img src="{{ $carousel->cover }}" width="1140px" height="470" />

                    <div class="carousel-caption">
                        <a href='/main/detail/{{ $carousel->id }}'>
                            <h3>{{ $carousel->title }}</h3>
                        </a>
                        <p>{{ $carousel->keywords }}</p>
                    </div>
                </div>
        @endforeach

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