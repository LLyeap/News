<?php

namespace App\Services;

use App\Tools\Common;
use App\Tools\CustomPage;
use Illuminate\Support\Facades\Session;
use App\Services\SiteService;
use App\Stores\DContentStore;
use App\Stores\RContentCategoryStore;

/**
 * 内容相关处理的Service层
 *
 * Class ContentService
 * @package App\Services
 */
class ContentService
{
    protected $siteServer      = null;
    protected $contentStore    = null;  // DContentStore
    protected $contentCategory = null;  // RContentCategoryStore

    /** 构造方法 */
    public function __construct(SiteService $siteServer, DContentStore $contentStore, RContentCategoryStore $contentCategory)
    {
        $this->siteServer      = $siteServer;
        $this->contentStore    = $contentStore;
        $this->contentCategory = $contentCategory;
    }

    /** ******************************************************** */
    /**                         后台                              */
    /** ******************************************************** */

    /**
     * 新增一条内容
     *
     * @param $data     新增的内容的数据
     * @return array    返回新增的结果
     */
    public function addContentInfo($data)
    {
        // 1. 去掉html_content(因为它和content内容一样)
        unset($data['html_content']);

        // 2. 组织轮播设置数据(因为没选中为轮播图时, 参数中没有这项)
        if (!isset($data['carousel'])) { // 如果此内容没有设置成轮播图
            $data['carousel'] = '0';
        }

        // !! 这里需要mysql事务操作 !!

        // 3. 数据插入内容表
        $content_data = [
            'title'        => $data['title'],
            'keywords'     => $data['keywords'],
            'cover'        => $data['cover'],
            'content'      => $data['content'],
            'html_content' => $data['editormd-html-code'],
            'carousel'     => $data['carousel'],
        ];
        $content_id = $this->contentStore->addData($content_data);

        // 4. 内容插入相应的关联表
        $rel_data = ['content_id' => $content_id];
        if ($data['navigation'] != 0) { //navigation
            $rel_data = ['nav_id' => $data['navigation']];
        } else { // category
            $rel_data = ['category_id' => $data['category']];
        }
        $rel_id = $this->contentCategory->addData($rel_data);

        // 5. 组织数据返回
        if (!$content_id) return ['status' => false, 'type' => 'error', 'message' => '插入数据失败'];
        return ['status' => true,  'message' => $content_id];
    }

    /**
     * 获得内容数据(分页)
     *
     * @param $data     请求分页的数据
     * @return array    返回的处理结果
     */
    public function getContentInfoList($data)
    {
        // 1. 获得内容总条数
        $count  = $this->contentStore->getCount();
        if(empty($count)) return ['status' => false, 'type' => 'error', 'message' => '没有数据'];

        // 2. 进行分页操作
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($data['nowPage'], $totalPage, 'http://admin.mysite.com/content_info', '');

        // 3. 获得请求页的数据
        $pageData = $this->contentStore->getPageData($data['nowPage']);

        // 4. 组织返回数据
        return ['status' => true,  'message' => ['pageInfo' => $pageInfo, 'pageData' => $pageData]];
    }

    /** ******************************************************** */
    /**                         前台                              */
    /** ******************************************************** */


    /**
     * 获得首页要显示的主要内容(轮播 & 类别)
     *
     * @return array
     */
    public function getIndexContentInfo()
    {
        /** 1. 查询首页轮播图数据 */
        $carouselArray = $this->contentStore->getDataLimit(['carousel' => 1], 3);

        /** 2. 查询首页要显示的类别 推荐数据库中就显示4类 */
        $categorys = $this->siteServer->getCategoryInfoAll()['message'];

        /** 3. 根据类别的id 去关联表RContentCategory中查找内容的id */
        $contentIdsArray = [];
        foreach ($categorys as $category) {
            $contentIds = $this->contentCategory->getDataLimit(['category_id' => $category->id], 3);
            array_push($contentIdsArray, $contentIds);
        }

        /** 4. 根据内容的id查询各类别的要显示的内容 并按类别分类  */
        $contentArray = [];
        for($i = 0; $i < count($contentIdsArray); $i++) {
            $categoryData = [];
            foreach ($contentIdsArray[$i] as $contentId) {
                $content = $this->contentStore->getFirstData(['id' => $contentId->content_id]);
                unset($content->content);
                unset($content->html_content);
                unset($content->carousel);
                array_push($categoryData, $content);
            }
            $categoryName = $categorys[$i]->name;
            $categoryId    = $categorys[$i]->id;
            $categoryData = [
                'categoryId'   => $categoryId,
                'categoryName' => $categoryName,
                'categoryData' => $categoryData
            ];
            array_push($contentArray, $categoryData);
        }

        /** 5. 组装数据返回 */
        return [
            'carouselArray' => $carouselArray,
            'contentArray'  => $contentArray
        ];
    }

    /**
     * 获得列表页分页数据
     *
     * @param $data 分页信息
     * @param $id   类别id
     *
     * @return array
     */
    public function getListContentInfo($data, $id)
    {
        /** 1. 查询该类别数据总条数 */
        $count  = $this->contentCategory->getCount(['category_id' => $id]);

        /** 2. 进行分页处理 */
        $nowPage = isset($data['nowPage']) ? $data['nowPage'] : 1;
        $totalPage = CustomPage::getTotalPage($count);
        $pageInfo = CustomPage::getSelfPageView($nowPage, $totalPage, 'http://www.mysite.com/main/list/' . $id, '');

        /** 3. 获得请求页的该类别数据 */
        $pageData = $this->contentCategory->getPageData($nowPage);

        /** 4. 根据类别中内容的id获得内容数据 */
        $contentArray = [];
        foreach ($pageData as $contentId) {
            $content = $this->contentStore->getFirstData(['id' => $contentId->content_id]);
            unset($content->content);
            unset($content->html_content);
            unset($content->carousel);
            array_push($contentArray, $content);
        }

        /** 5. 组织返回 */
        return [
            'pageInfo'     => $pageInfo,
            'contentArray' => $contentArray
        ];

    }

    /**
     * 获得详情页内容
     *
     * @param $id       内容id
     * @return array
     */
    public function getDetailContentInfo($id)
    {
        /** 1. 获得该条内容 */
        $content = $this->contentStore->getFirstData(['id' => $id]);
        unset($content->content);
        unset($content->carousel);

        /** 2. 组织返回 */
        return [
            'content' => $content
        ];
    }

}