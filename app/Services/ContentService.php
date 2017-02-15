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
            'title'     => $data['title'],
            'keywords'  => $data['keywords'],
            'cover'     => $data['cover'],
            'content'   => $data['content'],
            'carousel'  => $data['carousel'],
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


    public function getMainContentInfo()
    {
        $carouselArray = $this->contentStore->getDataLimit(['carousel' => 1], 3);

        $categorys = $this->siteServer->getCategoryInfoAll()['message'];

        $contentIdsArray = [];
        foreach ($categorys as $category) {
            $contentIds = $this->contentCategory->getDataLimit(['category_id' => $category->id], 3);
            array_push($contentIdsArray, $contentIds);
        }

        $contentArray = [];
        for($i = 0; $i < count($contentIdsArray); $i++) {
            $categoryData = [];
            foreach ($contentIdsArray[$i] as $contentId) {
                $content = $this->contentStore->getFirstData(['id' => $contentId->content_id]);
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

        return [
            'carouselArray' => $carouselArray,
            'contentArray'  => $contentArray
        ];
    }

}