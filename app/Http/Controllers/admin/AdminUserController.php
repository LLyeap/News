<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\CustomPage;
use App\Services\AdminService;

class AdminUserController extends Controller
{
    protected $adminServer = null;

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
        return response()->view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    public function getAdminUserInfo(Request $request)
    {
        $data = $request->except('token');

        $result = $this->adminServer->getAdminUserInfoList($data);
        return response()->json($this->Res($result));
    }

    protected function Res($result)
    {
        if ($result['status']) { // 如果service层返回正确
            return ['ServerNo' => 200, 'ResultData' => $result['message']];
        } else { // service层返回错误
            switch ($result['type']){ // 判断错误类型
                case 'danger':
                    return ['ServerNo' => 400, 'ResultData' => $result['message']];
                case 'err':
                    return ['ServerNo' => 500, 'ResultData' => $result['message']];
                default :
                    return ['ServerNo' => 500, 'ResultData' => '未知错误'];
            }
        }
    }
}
