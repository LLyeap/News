@extends('admin.layouts.master')

{{-- 标题 --}}
@section('title', '网站管理')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    {{-- 内容面板开始 --}}
    <div class="panel panel-default">
        {{-- 内容标题开始 --}}
        <div class="panel-heading">
            <h3 class="panel-title">一键停用</h3>
        </div> {{-- 内容标题结束 --}}

        {{-- 内容数据开始 --}}
        <div class="panel-body">
            {{-- 内容栅栏开始 --}}
            <div class="row">

            </div> {{-- 内容栅栏结束 --}}
        </div> {{-- 内容数据结束 --}}
    </div> {{-- 内容面板结束 --}}

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
