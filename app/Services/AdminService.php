<?php

namespace App\Services;

use App\Tools\Common;
use App\Stores\DAdminUserStore;

class AdminService
{
    protected $adminUser = null;

    public function __construct(DAdminUserStore $adminUser)
    {
        $this->adminUser = $adminUser;
    }

    public function loginCheck($data)
    {
        // 1. 通过邮箱(用户名)查找数据库
        $user = $this->adminUser->getFirstData(['email' => $data['email']]);

        // 1.1 判断用户是否存在
        if (empty($user)) return ['status' => false, 'type' => 'error', 'message' => '用户不存在'];

        // 1.2 判断密码是否正确
        if ($user->password != Common::myMd5Password($data['password'])) return ['status' => false, 'type' => 'error', 'message' => '密码错误'];

        // 2. 向数据库中写入用户的登录信息

//          'email' => 'master@163.com',
//          'password' => 'master163!',
//          'check' => 'checked',
//          'ip' => '192.168.33.1',


        // 3. 登录成功, 正常返回
        return ['status' => true,  'message' => '登录成功'];
    }
}