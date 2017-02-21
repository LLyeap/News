<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SiteService;
use App\Services\Contentservice;

/**
 * 前台主要控制器 通过隐式路由读取index/list/detail数据
 *
 * Class MainController
 * @package App\Http\Controllers\home
 */
class MainController extends Controller
{
    protected $siteServer    = null; // SiteService
    protected $contentServer = null; // ContentService

    /** 构造方法 */
    public function __construct(SiteService $siteServer, ContentService $contentServer)
    {
        $this->siteServer    = $siteServer;
        $this->contentServer = $contentServer;
    }

    /**
     * /main
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $siteInfo    = $this->siteServer->getMainSiteInfo();
        $contentInfo = $this->contentServer->getIndexContentInfo();
//        dd($contentInfo);
        return view('home.index.index', ['siteInfo' => $siteInfo, 'contentInfo' => $contentInfo]);
    }

    /**
     * /main/list/1
     *
     * @param $id   category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(Request $request, $id)
    {
        $data = $request->except('_token');

        $siteInfo    = $this->siteServer->getMainSiteInfo();
        $contentInfo = $this->contentServer->getListContentInfo($data, $id);

        return view('home.list.index', ['siteInfo' => $siteInfo, 'contentInfo' => $contentInfo]);
    }

    /**
     * /main/detail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetail($id)
    {
        $siteInfo    = $this->siteServer->getMainSiteInfo();
        $contentInfo = $this->contentServer->getDetailContentInfo($id);
        return view('home.detail.index', ['siteInfo' => $siteInfo, 'contentInfo' => $contentInfo]);
    }
}
