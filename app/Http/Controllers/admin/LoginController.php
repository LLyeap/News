<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Tools\Common;
use App\Services\AdminService;

/**
 * 后台用户登录相关控制器
 *
 * Class LoginController
 * @package App\Http\Controllers\Admin
 */
class LoginController extends Controller
{
    protected $adminServer = null;  // AdminService

    /** 构造方法 */
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
        return response()->view('admin.login.login')->withCookie($cookie);
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

    /**
     * 返回验证码(鼠标点击验证码进行验证码刷新操作)
     *
     * @param $tmp  随机参数$tmp
     * @return $this|bool|\Gregwar\Captcha\PhraseBuilder|
     *          \Illuminate\Contracts\Routing\ResponseFactory|null|
     *          string|\Symfony\Component\HttpFoundation\Response|void
     */
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
     * 对用户登录操作进行验证
     *
     * @param Request $request  用户登录的身份信息
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector   返回登录错误信息 | 成功跳转
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
        unset($data['captcha']);
        $data['ip'] = $request->getClientIp();

        /** 5> Service验证用户 */
        $result = $this->adminServer->loginCheck($data);

        /** 6> 根据Service状态返回情况 */
        if ($result['status']) {
            return redirect('/');
        } else {
            return back()->withErrors($result['message']);
        }
    }

    /**
     * 后台管理员用户退出登录操作 - 清空session
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
