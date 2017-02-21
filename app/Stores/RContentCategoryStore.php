<?php

namespace App\Stores;

use Illuminate\Support\Facades\DB;

/**
 * 内容与类别关联的CURD Store层
 *
 * Class RContentCategoryStore
 * @package App\Stores
 */
class RContentCategoryStore
{
    // 表名
    protected $table = 'rel_content_category';

    /**
     * 新增一条内容与类别的关联,并且返回该条内容的id
     *
     * @param $data 新增数据
     * @return bool 新增结果
     */
    public function addData($data)
    {
        if(empty($data)) return false;

        return DB::table($this->table)
            ->insertGetId($data);
    }

    public function getDataLimit($where, $limit)
    {
        if(empty($where) || empty($limit)) return false;

        return DB::table($this->table)
            ->where($where)
            ->orderBy('id', 'dese')
            ->limit($limit)
            ->get();
    }

    /**
     * 获得类别数据总条数(分页用)
     *
     * @param $where    ['category_id' => 1]
     * @return mixed    总条数
     */
    public function getCount($where)
    {
        return DB::table($this->table)
            ->where($where)
            ->count();
    }

    /**
     * 获得请求页的类别数据
     *
     * @param $nowPage  请求页
     * @return mixed    该页用户数据
     */
    public function getPageData($nowPage)
    {
        return DB::table($this->table)
            ->forPage($nowPage, ADMIN_PAGE_NUM)
            ->orderBy('id', 'desc')
            ->get();
    }
}