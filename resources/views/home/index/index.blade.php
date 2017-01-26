@extends('home.layouts.main')

{{-- 标题 --}}
@section('title', '首页')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    <!-- 轮播图开始 -->
    @include('home/index/_carousel')
    <!-- 轮播图开始 -->

    <!-- 下面分类栏目块开始 -->
    @include('home/public/main/_main_cell', ['section_title' => '团情快报', 'posts' => 1, 'category_id' => 1])
    @include('home/public/main/_main_cell', ['section_title' => '通知公告', 'posts' => 1, 'category_id' => 1])
    @include('home/public/main/_main_cell', ['section_title' => '学院风采', 'posts' => 1, 'category_id' => 1])
    @include('home/public/main/_main_cell', ['section_title' => '学生会 & 社联', 'posts' => 1, 'category_id' => 1])
    <!-- 下面分类栏目块结束 -->

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
