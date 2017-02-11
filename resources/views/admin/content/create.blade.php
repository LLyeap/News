@extends('admin.layouts.master')

{{-- 标题 --}}
@section('title', '新建内容')

{{-- CSS样式开始 --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.min.css') }}">
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
                        <form role="form" method="post" action="#" id="page-form">
                            {{ csrf_field() }}
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
                                    <label for="keyword">关键字(Keywords)</label>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <input type='text' class='form-control' name="keyword" id='keyword' placeholder='请输入关键字，以#号分割，利于搜索引擎收录'>
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
                                <button type="button" id="reset-btn" class="btn btn-warning">重置</button>
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

    <script src="{{ asset('editor.md/editormd.min.js') }}"></script>
    <script>

        var editor = editormd("editormd", {
            path        : "{{ asset('/editor.md/lib/') }}/",
            height  : 500,
            syncScrolling : "single",
            toolbarAutoFixed: false,
            saveHTMLToTextarea : false,
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "{{ url('upload_image') }}"
        });
//
//        /* 页面操作验证 */
//        $("#page-form").bootstrapValidator({
//            live: 'disables',
//            message: "This Values is not valid",
//            feedbackIcons: {
//                valid: 'glyphicon ',
//                invalid: 'glyphicon ',
//                validating: 'glyphicon glyphicon-refresh'
//            },
//            fields : {
//                title : {
//                    validators : {
//                        notEmpty : {
//                            message : "页面标题不能为空"
//                        }
//                    }
//                }
//            }
//        }).on('success.form.bv', function(e) {
//            var html = editor.getPreviewedHTML();
//            $("#page-form textarea[name='html_content']").val(html);
//        });
    </script>
@endsection {{-- JS结束 --}}
