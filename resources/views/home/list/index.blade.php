@extends('home.layouts.main')

{{-- 标题 --}}
@section('title', '列表页')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    <!-- 位置导航开始 -->
    @include('home/public/main/_breadCrumb')
    <!-- 位置导航结束 -->

    <ul class="row content">

        @foreach($contentInfo['contentArray'] as $content)
            <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 animated fadeInLeft  ">
                <div class="content-block">
                    <a href="/main/detail/{{ $content->id }}" target="_blank">
                        <img src="{{ $content->cover }}" alt="">
                    </a>
                    <div>
                        <h3>
                            <a href="/main/detail/{{ $content->id }}" target="_blank">
                                {{ $content->title }}
                            </a>
                        </h3>
                        <p>{{ $content->keywords }}</p>
                        <!--p标签内容不可超过40个中文简体字-->
                        <div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>

    <nav>
        {!! $contentInfo['pageInfo'] !!}
    </nav>

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
