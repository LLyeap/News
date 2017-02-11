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
            <h3 class="panel-title">用户列表</h3>
        </div> {{-- 内容标题结束 --}}

        {{-- 内容数据开始 --}}
        <div class="panel-body">
            {{-- 内容栅栏开始 --}}
            <div class="row">
                {{-- 内容栅栏区域开始 --}}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- 总体数据开始 --}}
                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        {{-- 主要显示数据内容开始 --}}
                        <div class="row">
                            <div class="col-sm-12" id="table">

                            </div>
                        </div> {{-- 主要显示数据内容结束 --}}

                        {{-- 分页开始 --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="dataTables_paginate paging_simple_numbers" id="page">

                                </div>
                            </div>
                        </div> {{-- 分页结束 --}}
                    </div> {{-- 总体数据结束 --}}
                </div> {{-- 内容栅栏区域结束 --}}
            </div> {{-- 内容栅栏结束 --}}
        </div> {{-- 内容数据结束 --}}
    </div> {{-- 内容面板结束 --}}

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')

<script src="{{ asset('common/js/MyAjax.js') }}"></script>
<script src="{{ asset('common/js/MyTable.js') }}"></script>
<script>

    function getData(url) {
        var myAjax = new MyAjax();
        myAjax.url = url;
        myAjax.type = 'get';
        myAjax.beforeSend = function () {
            $('#table').html('');
            $('#page').html('');
        };
        myAjax.success = function (data) {
            if (data.ServerNo == 200) {
                // 处理表格数据
                var myTable = new MyTable();
                myTable.setCaption('用户列表');
                myTable.setTh(['邮箱', '操作']);
                console.log();
                myTable.setData(data.ResultData.pageData);
//                console.log(myTable.getTable());
                // 显示表格数据
                $('#table').html(myTable.getTable());

                // 显示分页
                $('#page').html(data.ResultData.pageInfo);

                // 递归分页
                $('.pagination li').click(function () {
                    var class_name = $(this).prop('class');
                    if (class_name == 'disabled' || class_name == 'active') {
                        return false;
                    }
                    var url = $(this).children().prop('href');

                    getData(url);
                    return false;
                });
            } else {
                alert(data.ResultData);
            }
        };
        myAjax.error = function(XMLHttpRequest) {
            alert('err');
            console.log(XMLHttpRequest);
        };
        myAjax.excuteAjax();
    }
    getData('http://admin.mysite.com/admin_user_info?totalPage=&nowPage=1');

</script>
@endsection {{-- JS结束 --}}
