@extends('admin.layouts.master')

{{-- 标题 --}}
@section('title', '首页')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    <h1>后台首页</h1>

    PHP程式版本： {!! PHP_VERSION !!}
    <br />
    ZEND版本： {!! zend_version() !!}
    <br />
    服务器操作系统： {!! PHP_OS !!}
    <br />
    服务器端信息： {!! $_SERVER ['SERVER_SOFTWARE'] !!}

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

@endsection {{-- JS结束 --}}
