<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Tools\Common;
use App\Services\AdminService;

class LoginController extends Controller
{
    protected $adminServer = null;

    public function __construct(AdminService $adminServer)
    {
        $this->adminServer = $adminServer;
    }

    /**
     * 返回登录页面
     */
    public function index()
    {
        $cookie = Common::createCookie('admin');
        return response()->view('admin.login')->withCookie($cookie);
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

    public function captcha($tmp)
    {
        // 判断cookie是否在5分钟内注册
        $cookieRes = Common::checkCookie('admin', '后台登陆');
        if ($cookieRes != 'OK') {
            return $cookieRes;
        }

        return Common::captcha($tmp);
    }

    /**
     * @return $this
     */
    public function doLogin(Request $request)
    {
        /** 1> 判断cookie是否在5分钟内注册 */
        $cookieRes = Common::checkCookie('admin', '登陆');
        if ($cookieRes != 'OK') return back()->withErrors(['登陆失败,请刷新页面后重试!']);

        /** 2> 获取$request数据 */
        $data = $request->except('_token');
        $request->flashOnly('email');

        /** 3> 对数据做基础校验 */
        // 3.1 验证验证规则正确性
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:5'
        ]);
        // 3.2 验证验证码正确性
        if ($data['captcha'] != Session::get('admin_code')) {
            return back()->withInput($request->only('email'))->withErrors(['验证码错误!']);
        }

        /** 4> 补充数据, 转到service层处理 */
        $data['ip'] = $request->getClientIp();
        $info = $this->adminServer->loginCheck($data);

        return redirect('/');
    }
}
