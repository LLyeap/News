<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理 - 登录</title>

    @include('admin.public.style')  {{-- 加载公共 CSS 样式 --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/login.css') }}"> {{-- 登录窗口独有css --}}
    <style>
        body {
            background: #00b4ef;
        }
        .alert-danger {padding-top: 20px;}
        .alert-danger ul li {list-style-type: none; color: red; font-size: 16px;}
        .capt-input {width: 50%;}
        #img_captcha {border: 0px; width: 40%; height: 40px; float: right; margin-top: -40px;}
    </style>
</head>

<body>
{{-- 登录页面开始 --}}
<div class="container margin-top-10">
    {{-- 登录页栅栏开始 --}}
    <div class="row">
        {{-- 登录主体内容框开始 --}}
        <div class="col-md-offset-3 col-md-6">
            {{-- 登录表单开始 --}}
            <form class="form-horizontal" id="signupForm" method="post" action="{{ url('backend/doLogin') }}">
                {{ csrf_field() }}
                {{-- 表单头 --}}
                <span class="heading">用户登录</span>

                {{-- 表单提交后, 错误信息返回 --}}
                @include('admin.public.error')

                <!-- 电子邮箱 -->
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="电子邮件" />
                    <i class="fa fa-user"></i>
                </div>

                <!-- 密码 -->
                <div class="form-group help">
                    <input type="password" class="form-control" name="password" id="password" placeholder="密　码" />
                    <i class="fa fa-lock"></i>
                    <a href="#" onmouseover="show_pass()" onmouseleave="hide_pass()" class="fa fa-eye fa-question-circle"></a>
                </div>

                <!-- 验证码 -->
                <div class="form-group help">
                    <input type="text" class="form-control capt-input" name="captcha" id="captcha" placeholder="验证码" maxlength="4" />
                    <i class="fa fa-codepen"></i>
                    <img class="img-rounded" id="img_captcha" src="{{ url('backend/code/captcha/1') }}" />
                </div>

                <!-- 记住我 & 登录按钮 -->
                <div class="form-group">
                    <div class="main-checkbox">
                        <input type="checkbox" value="None" id="remember_check" name="check" checked />
                        <label for="remember_check"></label>
                    </div>
                    <span class="text">Remember me</span>
                    <button type="submit" class="btn btn-default">登录</button>
                </div>
            </form> {{-- 登录表单结束 --}}
        </div> {{-- 登录主体内容框结束 --}}
    </div> {{-- 登录页栅栏结束 --}}
</div> {{-- 登录页面结束 --}}

@include('admin.public.script') {{-- 加载公共 JS 模块 --}}
<script src="http://cdn.rooyun.com/js/jquery.validate.min.js"></script> {{-- 前端表单js的 validate 验证 --}}
<script>
    /**
     * Theme: Velonic Admin Template
     * Author: Coderthemes
     * Form Validator
     *
     * 文档地址 http://www.runoob.com/jquery/jquery-plugin-validate.html
     */
    !function($) {
        "use strict";

        var FormValidator = function() {
            this.$signupForm = $("#signupForm");
        };

        // 初始化
        FormValidator.prototype.init = function() {
            // validate the comment form when it is submitted
            // this.$commentForm.validate();
            // validate signup form on keyup and submit
            this.$signupForm.validate({
                // 验证规则
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    captcha: {
                        required: true,
                        minlength: 4
                    }
                },
                // 提示信息
                messages: {
                    email: "请输入一个有效的电子邮件地址",
                    password: {
                        required: "请输入密码",
                        minlength: "您的密码必须至少有5个字符长"
                    },
                    captcha: {
                        required: '请输入验证码',
                        minlength: "验证码必须为4位"
                    }
                }
            });
        },
        // init
        $.FormValidator = new FormValidator, $.FormValidator.Constructor = FormValidator
    }(window.jQuery),

    // initializing
    function($) {
        "use strict";
        $.FormValidator.init()
    }(window.jQuery);
</script>
<script>
    /**
     * 点击验证码图片刷新验证码
     */
    var captcha = document.getElementById('img_captcha');
    captcha.onclick = function() {
        $url = "{{ URL('backend/code/captcha') }}";
        $url = $url + "/" + Math.random();
        this.src = $url;
    }

    /**  鼠标移入眼睛图标 - 显示密码 */
    function show_pass() {
        $('#password').attr('type', 'text');
    }
    /**  鼠标移出眼睛图标 - 显示密码 */
    function hide_pass() {
        $('#password').attr('type', 'password');
    }
</script>
</body>
</html>