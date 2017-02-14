@extends('admin.layouts.master')

{{-- 标题 --}}
@section('title', '类别管理')

{{-- CSS样式开始 --}}
@section('styles')

@endsection {{-- CSS样式结束 --}}

{{-- 主题内容开始 --}}
@section('content')

    {{-- 内容面板开始 --}}
    <div class="panel panel-default">
        {{-- 内容标题开始 --}}
        <div class="panel-heading">
            <h3 class="panel-title">类别列表</h3>
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

    <!-- 模态框开始 -->
    @include('admin/category/_model')
    <!-- 模态框开始 -->

@endsection {{-- 主题内容结束 --}}

{{-- JS开始 --}}
@section('scripts')
    <script src="{{ asset('common/js/MyTable.js') }}"></script>
    <script>

        function getData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                beforeSend: function () {
                    $('#table').html('');
                    $('#page').html('');
                },
                success: function (data) {
                    if (data.ServerNo == 200) {
                        // 处理表格数据
                        var myTable = new MyTable();
                        myTable.setCaption('类别列表');
                        console.log();
                        myTable.setData(data.ResultData.pageData);
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
                },
                error: function(XMLHttpRequest) {
                    alert('err');
                    console.log(XMLHttpRequest);
                }
            });
        }
        getData('http://admin.mysite.com/category_info?totalPage=&nowPage=1');


        // 解决jq无法直接获得动态加载的dom节点的问题
        // 解决办法:事件委托 - http://www.css88.com/jqapi-1.9/on/
        $(document).on('click','#update',function(){
            // $(this) - 获得当前的按钮(这里不可以用$(#update), 这样就只能获得第一个了)
            var update_id = $(this).val();
            $.ajax({
                url: 'category/' + update_id + '/edit',
                type: 'GET',
                data: {},
                success: function (data) {
                    console.log(data);
                    if (data.ServerNo == 200) {
                        $('#myModalTitle').html('修改类别: ' + data.ResultData.name + '的信息');
                        $('#id').val(data.ResultData.id);
                        $('#name').val(data.ResultData.name);
                    } else {
                        alert(data.ResultData);
                    }
                },
                error: function(XMLHttpRequest) {
                    alert('err');
                    console.log(XMLHttpRequest);
                }
            });
        });


        $(document).on('click','#delete',function(){
            var delete_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'category/' + delete_id,
                type: 'DELETE',
                data: {},
                success: function (data) {
                    alert(data.ResultData);
                },
                error: function(XMLHttpRequest) {
                    alert('err');
                    console.log(XMLHttpRequest);
                }
            });
        });


        $('#submit-modal').click(function () {
            var name = $('#name').val();
            if (name == '' || name.length > 16) {
                alert('类别名不合法');
            } else {
                var update_id = $('#id').val();
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'category/' + update_id,
                    type: 'PUT',
                    data: {
                        name: name
                    },
                    success: function (data) {
                        // ?? 为什么弹窗时间会影响下面的模态框隐藏
                        if (data.ServerNo == 200) {
                            $('#submit-modal').attr('data-dismiss', 'modal');
                        }
                    },
                    error: function(XMLHttpRequest) {
                        alert('err');
                        console.log(XMLHttpRequest);
                    }
                });
            }
        });
    </script>
@endsection {{-- JS结束 --}}
