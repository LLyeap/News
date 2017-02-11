<?php

namespace App\Services;

use App\Tools\Common;
use App\Stores\DAdminUserStore;
use App\Tools\CustomPage;
use Illuminate\Support\Facades\Session;

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
        $where = ['email' => $data['email']];
        $user = $this->adminUser->getFirstData($where);

        // 1.1 判断用户是否存在
        if (empty($user)) return ['status' => false, 'type' => 'error', 'message' => '用户不存在'];

        // 1.2 判断密码是否正确
        if ($user->password != Common::myMd5Password($data['password'])) return ['status' => false, 'type' => 'error', 'message' => '密码错误'];

        // 2. 向数据库中写入用户的登录信息
        $update = [
            'last_login_ip'   => $data['ip'],
            'last_login_time' => time(),
            'remember_me'     => ($data['check'] == 'checked') ? 1 : 0
        ];
        $result = $this->adminUser->updateData($where, $update);
        if (!$result) return ['status' => false, 'type' => 'error', 'message' => '异常错误 请重试'];

        // 3. 登录成功, 将信息存入Session, 正常返回
        unset($user->password); // 存储session不需要密码
        Session::put('admin', $user);
        return ['status' => true,  'message' => '登录成功'];
    }

    public function getAdminUserInfoList($data)
    {
        $count  = $this->adminUser->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/admin_user_info', '');

        $pageData = $this->adminUser->getPageData($data['nowPage']);

        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }
}