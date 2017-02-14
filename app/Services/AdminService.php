<?php

namespace App\Services;

use App\Tools\Common;
use App\Tools\CustomPage;
use Illuminate\Support\Facades\Session;
use App\Stores\DAdminUserStore;
use App\Stores\DAdminRoleStore;

/**
 * 有关用户处理一块的Service层
 *
 * Class AdminService
 * @package App\Services
 */
class AdminService
{
    protected $adminUser = null;    // DAdminUserStore
    protected $adminRole = null;    // DAdminUserStore

    /** 构造方法 */
    public function __construct(DAdminUserStore $adminUser, DAdminRoleStore $adminRole)
    {
        $this->adminUser = $adminUser;
        $this->adminRole = $adminRole;
    }

    /**
     * 用户登录验证
     *
     * @param $data     用户登录请求的数据(需要验证的)
     * @return array    返回验证结果信息
     */
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

    /**
     * 新增一条管理员角色信息
     *
     * @param $data     新增的信息内容
     * @return array    返回新增执行的结果
     */
    public function addAdminRoleInfo($data)
    {
        // 1. 执行增加管理员信息操作
        $add_result = $this->adminRole->addData($data);
        if (!$add_result) return ['status' => false, 'type' => 'error', 'message' => '插入数据失败'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $add_result];
    }

    /**
     * 新增一条管理员用户的身份信息
     *
     * @param $data     新增的信息内容
     * @return array    返回新增执行的结果
     */
    public function addAdminUserInfo($data)
    {
        // 1. 执行增加管理员信息操作
        $add_result = $this->adminUser->addData($data);
        if (!$add_result) return ['status' => false, 'type' => 'error', 'message' => '插入数据失败'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $add_result];
    }

    /**
     * 获得管理员角色的信息(分页)
     *
     * @param $data     请求信息
     * @return array    返回请求处理结果(分页信息 & 分页数据)
     */
    public function getAdminRoleInfoList($data)
    {
        // 1. 查询管理员用户总条数
        $count  = $this->adminRole->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 进行分页处理
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/admin_role_info', '');

        // 3. 获得请求页的管理员数据
        $pageData = $this->adminRole->getPageData($data['nowPage']);

        // 4. 组织返回数据
        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }

    /**
     * 获得管理员用户的信息(分页)
     *
     * @param $data     请求信息
     * @return array    返回请求处理结果(分页信息 & 分页数据)
     */
    public function getAdminUserInfoList($data)
    {
        // 1. 查询管理员用户总条数
        $count  = $this->adminUser->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 进行分页处理
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/admin_user_info', '');

        // 3. 获得请求页的管理员数据
        $pageData = $this->adminUser->getPageData($data['nowPage']);

        // 4. 组织返回数据
        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }

    /**
     * 根据某个管理员角色的id来获得该用户的具体信息
     *
     * @param $id       管理员的id
     * @return array    这位管理员的具体信息
     */
    public function getAdminRoleInfoById($id)
    {
        // 1. 请求管理员信息
        $where = ['id' => $id];
        $adminRoleInfo = $this->adminRole->getFirstData($where);
        if (!$adminRoleInfo) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $adminRoleInfo];
    }

    /**
     * 根据某个管理员用户的id来获得该用户的具体信息
     *
     * @param $id       管理员的id
     * @return array    这位管理员的具体信息
     */
    public function getAdminUserInfoById($id)
    {
        // 1. 请求管理员信息
        $where = ['id' => $id];
        $adminUserInfo = $this->adminUser->getFirstData($where);
        if (!$adminUserInfo) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 去掉这位管理员的密码
        unset($adminUserInfo->password);

        // 3. 组织返回数据
        return ['status' => true,  'message' => $adminUserInfo];
    }

    /**
     * 根据某位管理员的id来修改这位管理员的部分信息
     *
     * @param $data     要修改的数据
     * @param $id       这位管理员的id
     * @return array    返回修改结果
     */
    public function updateAdminRoleInfoById($data, $id)
    {
        // 1. 组织更新数据
        $where = ['id' => $id];
        $update = $data;

        // 2. 执行更新操作
        $update_result = $this->adminRole->updateData($where, $update);
        if (!$update_result) return ['status' => false, 'type' => 'error', 'message' => '修改失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '重置成功'];
    }

    /**
     * 根据某位管理员的id来修改这位管理员的部分信息
     *
     * @param $data     要修改的数据
     * @param $id       这位管理员的id
     * @return array    返回修改结果
     */
    public function updateAdminUserInfoById($data, $id)
    {
        // 1. 组织更新数据
        $where = ['id' => $id];
        $password = Common::myMd5Password($data['reset_password']);
        $update = ['password' => $password];

        // 2. 执行更新操作
        $update_result = $this->adminUser->updateData($where, $update);
        if (!$update_result) return ['status' => false, 'type' => 'error', 'message' => '修改失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '重置成功'];
    }

    /**
     * 根据某位管理员用户的id来删除这位管理员信息(软删除)
     *
     * @param $id       管理员的id
     * @return array    删除结构
     */
    public function deleteAdminRoleInfoById($id)
    {
        // 1. 组织数据
        $where = ['id' => $id];

        // 2. 执行删除操作(软删除)
        $delete_result = $this->adminRole->deleteData($where);
        if (!$delete_result) return ['status' => false, 'type' => 'error', 'message' => '删除失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '删除成功'];
    }

    /**
     * 根据某位管理员用户的id来删除这位管理员信息(软删除)
     *
     * @param $id       管理员的id
     * @return array    删除结构
     */
    public function deleteAdminUserInfoById($id)
    {
        // 1. 组织数据
        $where = ['id' => $id];
        $update = ['status' => '2'];

        // 2. 执行删除操作(软删除)
        $update_result = $this->adminUser->updateData($where, $update);
        if (!$update_result) return ['status' => false, 'type' => 'error', 'message' => '删除失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '删除成功'];
    }
}