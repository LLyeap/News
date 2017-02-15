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
        $contentInfo = $this->contentServer->getMainContentInfo();
//        dd($siteInfo);
        return view('home.index.index', ['siteInfo' => $siteInfo, 'contentInfo' => $contentInfo]);
    }

    /**
     * /main/list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $siteInfo    = $this->siteServer->getMainSiteInfo();
        return view('home.list.index', ['siteInfo' => $siteInfo]);
    }

    /**
     * /main/detail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetail()
    {
        $siteInfo    = $this->siteServer->getMainSiteInfo();
        return view('home.detail.index', ['siteInfo' => $siteInfo]);
    }
}
