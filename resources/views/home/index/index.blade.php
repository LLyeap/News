@extends('home.layouts.main')

{{-- 标题 --}}
@section('title', '首页')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    <!-- 轮播图开始 -->
    @include('home/index/_carousel', ['carouselArray' => $contentInfo['carouselArray']])
    <!-- 轮播图开始 -->

    <!-- 下面分类栏目块开始 -->
    @foreach($contentInfo['contentArray'] as $content)
        @include('home/public/main/_main_cell', ['category_name' => $content['categoryName'], 'category_data' => $content['categoryData'], 'category_id' => $content['categoryId']])
    @endforeach
    <!-- 下面分类栏目块结束 -->

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
