<div class="row add-top-half {{ $extra_class or '' }} home-list">

    <div class="block-header">
        <h2>{{ $section_title }}
            @if (isset($category_id))
                <span class="pull-right read-more">
                    <a href="#"><i class="fa fa-plus" aria-hidden="true"></i> 更多</a>
                </span>
            @endif
        </h2>
    </div>

    <article class="col-md-4 pic-block" onmouseover="changeStyle()">
        <a class="shodow-box" href="http://vagrant.news.com/posts/507">
            <img class="img-responsive" alt="Laravel 的核心概念" src="https://oi5u2gg2q.qnssl.com/uploads/covers/OlZQSvj6YhC4xE4ufnaA.png?imageView2/1/w/720/h/376">
            <h4>Laravel 的核心概念</h4>
        </a>
    </article>
    <article class="col-md-4 pic-block">
        <a class="shodow-box" href="http://vagrant.news.com/posts/507">
            <img class="img-responsive" alt="Laravel 的核心概念" src="https://oi5u2gg2q.qnssl.com/uploads/covers/OlZQSvj6YhC4xE4ufnaA.png?imageView2/1/w/720/h/376">
            <h4>Laravel 的核心概念</h4>
        </a>
    </article>
    <article class="col-md-4 pic-block">
        <a class="shodow-box" href="http://vagrant.news.com/posts/507">
            <img class="img-responsive" alt="Laravel 的核心概念" src="https://oi5u2gg2q.qnssl.com/uploads/covers/OlZQSvj6YhC4xE4ufnaA.png?imageView2/1/w/720/h/376">
            <h4>Laravel 的核心概念</h4>
        </a>
    </article>



    {{--@foreach ($posts as $post)--}}
        {{--<article class="col-md-4 pic-block">--}}
            {{--<a class="shodow-box" href="#">--}}
                {{--<img class="img-responsive" alt="{{ $post->title }}" src="{{ img_crop($post->cover, 720, 376) }}"/>--}}
                {{--<h4>{{ $post->title }}</h4>--}}
            {{--</a>--}}
        {{--</article>--}}
    {{--@endforeach--}}

</div>
