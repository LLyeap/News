<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Common;
use App\Services\SiteService;

/**
 * 后台类别管理控制器
 *
 * Class CategoryController
 * @package App\Http\Controllers\admin
 */
class CategoryController extends Controller
{
    protected $siteServer = null;   // SiteService

    /** 构造方法 */
    public function __construct(SiteService $siteServer)
    {
        $this->siteServer = $siteServer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.category.create');
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
            'name'    => 'required|max:16',
        ]);

        $result = $this->siteServer->addCategoryInfo($data);
        if ($result['status']) { // 如果service层返回正确
            return response()->view('admin.category.index');
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
        $result = $this->siteServer->getCategoryInfoById($id);
        return response()->json(Common::Res($result));
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
        $data = $request->except('_token');

        $result = $this->siteServer->updateCategoryInfoById($data, $id);
        return response()->json(Common::Res($result));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->siteServer->deleteCategoryInfoById($id);
        return response()->json(Common::Res($result));
    }

    /**
     * 获得所有的类别信息
     *
     * @return \Illuminate\Http\JsonResponse 返回json格式数据
     */
    public function getCategoryAll()
    {
        $result = $this->siteServer->getCategoryInfoAll();
        return response()->json(Common::Res($result));
    }

    /**
     * 获得类别的信息(分页)
     *
     * @param Request $request                  前端请求
     * @return \Illuminate\Http\JsonResponse    返回json信息
     */
    public function getCategoryInfo(Request $request)
    {
        $data = $request->except('_token');

        $result = $this->siteServer->getCategoryInfoList($data);
        return response()->json(Common::Res($result));
    }
}
