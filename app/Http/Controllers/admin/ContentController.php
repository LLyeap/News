<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Common;
use App\Services\ContentService;

/**
 * 后台内容管理控制器
 *
 * Class ContentController
 * @package App\Http\Controllers\admin
 */
class ContentController extends Controller
{
    protected $contentServer = null;    // ContentService

    /** 构造方法 */
    public function __construct(ContentService $contentServer)
    {
        $this->contentServer = $contentServer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        /** 1> 对数据做基础校验 */
        // 1.1 验证验证规则正确性
        $this->validate($request, [
            'title'    => 'required|max:128',
            'keywords' => 'required|max:128',
            'content'  => 'required',
        ]);

        $result = $this->contentServer->addContentInfo($data);
        if ($result['status']) { // 如果service层返回正确
            return response()->view('admin.content.index');
        } else { // service层返回错误
            return back()->withErrors($result['message']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->view('admin.content.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 上传图片(在内容管理中cover和md中上传图片的请求处理方法 - 这里没有调到service层, 在Controller直接处理完成)
     *
     * @param Request $request                  上传图片请求的数据
     * @return \Illuminate\Http\JsonResponse    以json格式返回上传成功后的一些信息
     */
    public function uploadImage(Request $request)
    {
        // 1. 设置图片存储的路径
        $path = 'uploads/images';

        // 2. 拿到图片
        $pic = $request->file('editormd-image-file');

        // 3. 验证图片 - 合法则上传, 并且准备返回数据
        if ($pic->isValid()) {
            $newName = md5(rand(1, 1000) . $pic->getClientOriginalName()) . '.' . $pic->getClientOriginalExtension();
            $pic->move($path, $newName);
            $message = '上传成功';
            $url     = asset($path . '/' . $newName);
        } else {
            $message = '图片不合法';
            $url     = '';
        }

        // 4. 组织返回数据
        $data = array(
            'success' => ($message == '上传成功') ? 1 : 0,
            'message' => $message,
            'url'     => $url
        );

        // 5. 将数据返回
        header('Content-Type:application/json;charset=utf8');
        return response()->json($data);
    }

    /**
     * 获得内容数据(分页)
     *
     * @param Request $request                  前端请求
     * @return \Illuminate\Http\JsonResponse    返回内容组成的json格式数据
     */
    public function getContentInfo(Request $request)
    {
        // 1. 请求分页的数据
        $data = $request->except('_token');

        // 2. 获得请求结果并返回
        $result = $this->contentServer->getContentInfoList($data);
        return response()->json(Common::Res($result));
    }

}
