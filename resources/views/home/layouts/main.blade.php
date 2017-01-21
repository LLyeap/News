<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>mysite - @yield('title') </title>      {{-- 标题变量 --}}
    @include('home.public.style')                 {{-- 引入公共css样式 --}}
    @yield('styles')                              {{-- 继承的页面根据需要增加css --}}
</head>

<body>
@include('home.public.main.aside')                {{-- 引入左侧侧边栏 --}}
<section class="content">
    @include('home.public.main.header')           {{-- 引入顶部栏 --}}

    <div class="wraper container-fluid container">
        @yield('content')                         {{-- 内容主体 --}}
    </div>

    @include('home.public.main.footer')           {{-- 引入底部栏 --}}
</section>

@include('home.public.script')                    {{-- 引入公共js文件 --}}
@yield('scripts')                                 {{-- 继承的页面根据需要增加js --}}
</body>
</html>