<?php

namespace App\Services;

use App\Tools\Common;
use App\Tools\CustomPage;
use Illuminate\Support\Facades\Session;
use App\Stores\DCategoryStore;
use App\Stores\DNavStore;
use App\Stores\DLinkStore;

/**
 * 站点综合信息配置Service层
 *
 * Class SiteService
 * @package App\Services
 */
class SiteService
{
    protected $categoryStore = null; // DCategoryStore
    protected $navStore = null; // DNavStore
    protected $linkStore = null; // DLinkStore

    /** 构造方法 */
    public function __construct(DCategoryStore $categoryStore, DNavStore $navStore, DLinkStore $linkStore)
    {
        $this->categoryStore = $categoryStore;
        $this->navStore = $navStore;
        $this->linkStore = $linkStore;
    }


    /** ******************************************************** */
    /**                         类别                              */
    /** ******************************************************** */

    /**
     * 获得所有类别信息(前台请求下拉菜单)
     *
     * @return array 返回请求结果
     */
    public function getCategoryInfoAll()
    {
        // 1. 请求数据
        $allData  = $this->categoryStore->getDataAll();
        if(empty($allData)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回
        return ['status' => true,  'message' => $allData];
    }

    /**
     * 新增一条类别信息
     *
     * @param $data     新增的信息内容
     * @return array    返回新增执行的结果
     */
    public function addCategoryInfo($data)
    {
        // 1. 执行增加管理员信息操作
        $add_result = $this->categoryStore->addData($data);
        if (!$add_result) return ['status' => false, 'type' => 'error', 'message' => '插入数据失败'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $add_result];
    }

    /**
     * 获得类别的信息(分页)
     *
     * @param $data     请求信息
     * @return array    返回请求处理结果(分页信息 & 分页数据)
     */
    public function getCategoryInfoList($data)
    {
        // 1. 查询管理员用户总条数
        $count  = $this->categoryStore->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 进行分页处理
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/category_info', '');

        // 3. 获得请求页的管理员数据
        $pageData = $this->categoryStore->getPageData($data['nowPage']);

        // 4. 组织返回数据
        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }

    /**
     * 根据某个类别的id来获得该类别的具体信息
     *
     * @param $id       管理员的id
     * @return array    这位管理员的具体信息
     */
    public function getCategoryInfoById($id)
    {
        // 1. 请求管理员信息
        $where = ['id' => $id];
        $categoryInfo = $this->categoryStore->getFirstData($where);
        if (!$categoryInfo) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $categoryInfo];
    }

    /**
     * 根据类别的id来修改这位类别的部分信息
     *
     * @param $data     要修改的数据
     * @param $id       这位管理员的id
     * @return array    返回修改结果
     */
    public function updateCategoryInfoById($data, $id)
    {
        // 1. 组织更新数据
        $where = ['id' => $id];
        $update = $data;

        // 2. 执行更新操作
        $update_result = $this->categoryStore->updateData($where, $update);
        if (!$update_result) return ['status' => false, 'type' => 'error', 'message' => '修改失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '重置成功'];
    }

    /**
     * 根据类别的id来删除该类别信息(软删除)
     *
     * @param $id       管理员的id
     * @return array    删除结构
     */
    public function deleteCategoryInfoById($id)
    {
        // 1. 组织数据
        $where = ['id' => $id];

        // 2. 执行删除操作(软删除)
        $delete_result = $this->categoryStore->deleteData($where);
        if (!$delete_result) return ['status' => false, 'type' => 'error', 'message' => '删除失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '删除成功'];
    }


    /** ******************************************************** */
    /**                         导航                              */
    /** ******************************************************** */

    /**
     * 获得所有导航信息(前台请求下拉菜单)
     *
     * @return array 返回请求结果
     */
    public function getNavInfoAll()
    {
        // 1. 请求数据
        $allData  = $this->navStore->getDataAll();
        if(empty($allData)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回
        return ['status' => true,  'message' => $allData];
    }

    /**
     * 新增一条导航信息
     *
     * @param $data     新增的信息内容
     * @return array    返回新增执行的结果
     */
    public function addNavInfo($data)
    {
        // 1. 执行增加管理员信息操作
        $add_result = $this->navStore->addData($data);
        if (!$add_result) return ['status' => false, 'type' => 'error', 'message' => '插入数据失败'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $add_result];
    }

    /**
     * 获得导航的信息(分页)
     *
     * @param $data     请求信息
     * @return array    返回请求处理结果(分页信息 & 分页数据)
     */
    public function getNavInfoList($data)
    {
        // 1. 查询管理员用户总条数
        $count  = $this->navStore->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 进行分页处理
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/nav_info', '');

        // 3. 获得请求页的管理员数据
        $pageData = $this->navStore->getPageData($data['nowPage']);

        // 4. 组织返回数据
        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }

    /**
     * 根据某个导航的id来获得该导航的具体信息
     *
     * @param $id       管理员的id
     * @return array    这位管理员的具体信息
     */
    public function getNavInfoById($id)
    {
        // 1. 请求管理员信息
        $where = ['id' => $id];
        $navInfo = $this->navStore->getFirstData($where);
        if (!$navInfo) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $navInfo];
    }

    /**
     * 根据导航的id来修改该导航的部分信息
     *
     * @param $data     要修改的数据
     * @param $id       这位管理员的id
     * @return array    返回修改结果
     */
    public function updateNavInfoById($data, $id)
    {
        // 1. 组织更新数据
        $where = ['id' => $id];
        $update = $data;

        // 2. 执行更新操作
        $update_result = $this->navStore->updateData($where, $update);
        if (!$update_result) return ['status' => false, 'type' => 'error', 'message' => '修改失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '重置成功'];
    }

    /**
     * 根据导航的id来删除该导航信息(软删除)
     *
     * @param $id       管理员的id
     * @return array    删除结构
     */
    public function deleteNavInfoById($id)
    {
        // 1. 组织数据
        $where = ['id' => $id];

        // 2. 执行删除操作(软删除)
        $delete_result = $this->navStore->deleteData($where);
        if (!$delete_result) return ['status' => false, 'type' => 'error', 'message' => '删除失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '删除成功'];
    }


    /** ******************************************************** */
    /**                         友链                              */
    /** ******************************************************** */


    /**
     * 获得所有友链信息
     *
     * @return array 返回请求结果
     */
    public function getLinkInfoAll()
    {
        // 1. 请求数据
        $allData  = $this->linkStore->getDataAll();
        if(empty($allData)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回
        return ['status' => true,  'message' => $allData];
    }

    /**
     * 新增一条友链信息
     *
     * @param $data     新增的信息内容
     * @return array    返回新增执行的结果
     */
    public function addLinkInfo($data)
    {
        // 1. 执行增加管理员信息操作
        $add_result = $this->linkStore->addData($data);
        if (!$add_result) return ['status' => false, 'type' => 'error', 'message' => '插入数据失败'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $add_result];
    }

    /**
     * 获得友链的信息(分页)
     *
     * @param $data     请求信息
     * @return array    返回请求处理结果(分页信息 & 分页数据)
     */
    public function getLinkInfoList($data)
    {
        // 1. 查询管理员用户总条数
        $count  = $this->linkStore->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 进行分页处理
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/link_info', '');

        // 3. 获得请求页的管理员数据
        $pageData = $this->linkStore->getPageData($data['nowPage']);

        // 4. 组织返回数据
        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }

    /**
     * 根据某个友链的id来获得该友链的具体信息
     *
     * @param $id       管理员的id
     * @return array    这位管理员的具体信息
     */
    public function getLinkInfoById($id)
    {
        // 1. 请求管理员信息
        $where = ['id' => $id];
        $linkInfo = $this->linkStore->getFirstData($where);
        if (!$linkInfo) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 组织返回数据
        return ['status' => true,  'message' => $linkInfo];
    }

    /**
     * 根据友链的id来修改该友链的部分信息
     *
     * @param $data     要修改的数据
     * @param $id       这位管理员的id
     * @return array    返回修改结果
     */
    public function updateLinkInfoById($data, $id)
    {
        // 1. 组织更新数据
        $where = ['id' => $id];
        $update = $data;

        // 2. 执行更新操作
        $update_result = $this->linkStore->updateData($where, $update);
        if (!$update_result) return ['status' => false, 'type' => 'error', 'message' => '修改失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '重置成功'];
    }

    /**
     * 根据友链的id来删除该友链信息(软删除)
     *
     * @param $id       管理员的id
     * @return array    删除结构
     */
    public function deleteLinkInfoById($id)
    {
        // 1. 组织数据
        $where = ['id' => $id];

        // 2. 执行删除操作(软删除)
        $delete_result = $this->linkStore->deleteData($where);
        if (!$delete_result) return ['status' => false, 'type' => 'error', 'message' => '删除失败'];

        // 3. 组织返回数据
        return ['status' => true,  'message' => '删除成功'];
    }




    /** ******************************************************** */
    /**                         前端                              */
    /** ******************************************************** */

    public function getMainSiteInfo()
    {
        $navArray  = $this->getNavInfoAll()['message'];
        $linkArray = $this->getLinkInfoAll()['message'];

        return [
            'navArray'  => $navArray,
            'linkArray' => $linkArray,
            'copyRight' => 'Copyright &copy; 2017.WangYanshuang All rights reserved.'
        ];
    }
}