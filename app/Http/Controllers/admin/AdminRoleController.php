<?php

namespace App\Http\Controllers\admin;

use App\Tools\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;

/**
 * 后台管理员角色管理控制器
 *
 * Class AdminUserController
 * @package App\Http\Controllers\admin
 */
class AdminRoleController extends Controller
{
    protected $adminServer = null;  // AdminService

    /** 构造方法 */
    public function __construct(AdminService $adminServer)
    {
        $this->adminServer = $adminServer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.role.create');
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
            'name'    => 'required|max:8',
        ]);

        $result = $this->adminServer->addAdminRoleInfo($data);
        if ($result['status']) { // 如果service层返回正确
            return response()->view('admin.role.index');
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
        $result = $this->adminServer->getAdminRoleInfoById($id);
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

        $result = $this->adminServer->updateAdminRoleInfoById($data, $id);
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
        $result = $this->adminServer->deleteAdminRoleInfoById($id);
        return response()->json(Common::Res($result));
    }

    /**
     * 获得管理员角色的信息(分页)
     *
     * @param Request $request                  前端请求
     * @return \Illuminate\Http\JsonResponse    返回json信息
     */
    public function getAdminRoleInfo(Request $request)
    {
        $data = $request->except('_token');

        $result = $this->adminServer->getAdminRoleInfoList($data);
        return response()->json(Common::Res($result));
    }
}
