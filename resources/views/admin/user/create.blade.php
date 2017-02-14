@extends('admin.layouts.master')

{{-- 标题 --}}
@section('title', '用户管理')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    {{-- 内容面板开始 --}}
    <div class="panel panel-default">
        {{-- 内容标题开始 --}}
        <div class="panel-heading">
            <h3 class="panel-title">新建用户</h3>
        </div> {{-- 内容标题结束 --}}

        {{-- 内容数据开始 --}}
        <div class="panel-body">
            {{-- 栅栏开始 --}}
            <div class="row">
                {{-- 栅栏内容区开始 --}}
                <div class="col-md-12">
                    {{-- 盒子开始 --}}
                    <div class="box box-solid">
                        {{-- 表单开始 --}}
                        <form role="form" method="POST" action="{{ url('admin_user') }}" id="page-form">
                            {{ csrf_field() }}

                            {{-- 表单提交后, 错误信息返回 --}}
                            @include('admin.public.error')

                            {{-- 盒子内容主体开始 --}}
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="email">邮箱 (email)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <input type='text' class='form-control' name="email" id='email' placeholder='邮箱 (email)'>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">登录密码 (password)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <input type='password' class='form-control' name="password" id='password' placeholder='登录密码 (password)'>
                                        </div>
                                    </div>
                                </div>

                            </div> {{-- 盒子内容主体结束 --}}

                            {{-- 盒子底部按钮组开始 --}}
                            <div class="box-footer">
                                <button type="submit" id="submit-page" class="btn btn-primary">创建</button>
                                <button type="reset" id="reset-btn" class="btn btn-warning">重置</button>
                            </div> {{-- 盒子底部按钮组结束 --}}
                        </form> {{-- 表单结束 --}}
                    </div> {{-- 盒子结束 --}}
                </div> {{-- 栅栏内容区结束 --}}
            </div> {{-- 栅栏结束 --}}
        </div> {{-- 内容数据结束 --}}
    </div> {{-- 内容面板结束 --}}

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')
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
                this.$signupForm = $("#page-form");
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
                        }
                    },
                    // 提示信息
                    messages: {
                        email: "请输入一个有效的电子邮件地址",
                        password: {
                            required: "请输入密码",
                            minlength: "您的密码必须至少有5个字符长"
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
@endsection {{-- JS结束 --}}
