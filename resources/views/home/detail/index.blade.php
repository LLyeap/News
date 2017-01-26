@extends('home.layouts.main')

{{-- 标题 --}}
@section('title', '详情页')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    <!-- 详情页开始 -->
    <div class="row">
        <!-- 左侧主内容开始 -->
        <div class="col-md-8">

            <!-- 位置导航开始 -->
            @include('home/public/main/_breadCrumb')
            <!-- 位置导航结束 -->

            <!-- 内容主题开始 -->
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            .col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8.col-md-8
            <!-- 内容主题结束 -->

        </div> <!-- 左侧主内容结束 -->

        <!-- 右侧辅内容开始 -->
        <div class="col-md-4">

            <!-- 右侧最新资讯开始 -->
            @include('home/detail/_panel')
            <!-- 右侧最新资讯结束 -->

            <!-- 右侧热读内容开始 -->
            @include('home/detail/_panel')
            <!-- 右侧热读内容结束 -->

        </div> <!-- 右侧辅内容结束 -->
    </div> <!-- 详情页结束 -->

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
