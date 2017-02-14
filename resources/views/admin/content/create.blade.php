@extends('admin.layouts.master')

{{-- 标题 --}}
@section('title', '内容管理')

{{-- CSS样式开始 --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('common/css/bootstrap-switch.min.css') }}"> <!-- bootstrap的开关按钮样式 -->
    <link rel="stylesheet" href="{{ asset('common/css/bootstrap-select.min.css') }}"> <!-- bootstrap的下拉选择样式 -->
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.min.css') }}"> <!-- MD编辑器的样式 -->

    <style type="text/css">
        #cover-placeholder {
            width: 100%;
            height: 300px;
            cursor: pointer;
        }
    </style>
@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    {{-- 内容面板开始 --}}
    <div class="panel panel-default">
        {{-- 内容标题开始 --}}
        <div class="panel-heading">
            <h3 class="panel-title">新建内容</h3>
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
                        <form role="form" method="POST" action="{{ url('content') }}" id="page-form">
                            {{ csrf_field() }}

                            {{-- 表单提交后, 错误信息返回 --}}
                            @include('admin.public.error')

                            {{-- 盒子内容主体开始 --}}
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="title">页面标题</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <input type='text' class='form-control' name="title" id='title' placeholder='标题'>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="keywords">关键字(Keywords)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <input type='text' class='form-control' name="keywords" id='keywords' placeholder='请输入关键字，以#号分割，利于搜索引擎收录'>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cover">封面(Cover)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <img id="cover-placeholder" src="{{ asset('admin/content/images/placeholder.jpg') }}" alt="内容封面" />
                                            <input type="hidden" name="cover" id="cover" value="{{ asset('admin/content/images/placeholder.jpg') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="carousel">是否为轮播(Carousel)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <div class="switch" data-on="success" data-off="warning">
                                                <input type='checkbox' class='form-control' name="carousel" id='carousel' data-size="large" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="navigation">所属导航(Navigation)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <select id="navigation" name="navigation" class="selectpicker show-tick form-control">
                                                <option value="0">== 请选择 ==</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category">所属类别(Category)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <select id="category" name="category" class="selectpicker show-tick form-control">
                                                <option value="0">== 请选择 ==</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content">页面内容</label>
                                    <div id="editormd">
                                        {{-- MD编辑器左侧编辑开始 --}}
                                        <textarea class="editormd-markdown-textarea" style="display:none;" id="content" name="content"></textarea>
                                        {{-- MD编辑器右侧实时显示开始 --}}
                                        <textarea style="display:none;"  name="html_content"></textarea>
                                    </div>
                                </div>
                            </div> {{-- 盒子内容主体结束 --}}

                            {{-- 盒子底部按钮组开始 --}}
                            <div class="box-footer">
                                <button type="submit" id="submit-page" class="btn btn-primary">创建</button>
                                <button type="reset" id="reset-btn" class="btn btn-warning">重置</button>
                            </div> {{-- 盒子底部按钮组结束 --}}
                        </form> {{-- 表单结束 --}}

                        <form id="upload-cover" enctype="multipart/form-data">
                            <input type="file" name="editormd-image-file" id="editormd-image-file" style="display: none;">
                        </form>
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
                        title: {
                            required: true,
                            maxlength: 128
                        },
                        keywords: {
                            required: true,
                            maxlength: 128
                        },
                        content: {
                            required: true
                        }
                    },
                    // 提示信息
                    messages: {
                        title: {
                            required: "请输入内容标题",
                            maxlength: "标题总长不得多于128位"
                        },
                        keywords: {
                            required: "请输入关键词",
                            maxlength: "关键词总长不得多于128位"
                        },
                        content: {
                            require: "请输入内容标题"
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

    <script src="{{ asset('common/js/bootstrap-switch.min.js') }}"></script> <!-- bootstrap的开关按钮js -->
    <script src="{{ asset('common/js/bootstrap-select.min.js') }}"></script> <!-- bootstrap的下拉选择js -->
    <script src="{{ asset('editor.md/editormd.min.js') }}"></script> <!-- MD的js -->
    <script src="{{ asset('common/js/MyAjax.js') }}"></script> <!-- 自封装的ajax -->

    <script>

        /** bootstrap的开关按钮初始化 */
        $("[name='carousel']").bootstrapSwitch({
            onText:'是',
            offText:'否',
            handleWidth: 100,
        });


        /** MD编辑器 */
        var editor = editormd("editormd", {
            path    : "{{ asset('/editor.md/lib/') }}/",
            height  : 500,
            syncScrolling : "single",
            toolbarAutoFixed: false,
            saveHTMLToTextarea : false,
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "{{ url('upload_image') }}"
        });


        /** 封面图片上传 */
        $('#cover-placeholder').click(function () {
            $('#editormd-image-file').trigger('click');
        });
        $('#editormd-image-file').change(function () {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/upload_image',
                type: 'POST',
                data: new FormData($('#upload-cover')[0]),
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#cover-placeholder').attr('src', data.url);
                    $('#cover').val(data.url);
                },
                error: function(XMLHttpRequest) {
                    alert('err');
                    console.log(XMLHttpRequest);
                }
            });
        });


        /** 载入所属导航下拉内容 */
        $('#navigation').ready(function () {
            $.ajax({
                url: '/nav_all',
                type: 'GET',
                data: {},
                success: function (data) {
                    if (data.ServerNo != 200) {
                        alert(data.ResultData);
                    } else {
                        var str = '';
                        for(var d in data.ResultData) {
                            str += '<option value="' + data.ResultData[d].id + '">' + data.ResultData[d].name + '</option>';
                        }
                        $('#navigation').append(str);
                    }
                },
                error: function (XMLHttpRequest) {
                    alert('err');
                    console.log(XMLHttpRequest);
                }
            });
        });


        /** 载入所属类别下拉内容 */
        $('#category').ready(function () {
            $.ajax({
                url: '/category_all',
                type: 'GET',
                data: {},
                success: function (data) {
                    if (data.ServerNo != 200) {
                        alert(data.ResultData);
                    } else {
                        var str = '';
                        for(var d in data.ResultData) {
                            str += '<option value="' + data.ResultData[d].id + '">' + data.ResultData[d].name + '</option>';
                        }
                        $('#category').append(str);
                    }
                },
                error: function (XMLHttpRequest) {
                    alert('err');
                    console.log(XMLHttpRequest);
                }
            });
        });


    </script>
@endsection {{-- JS结束 --}}
