<?php

namespace App\Stores;

use Illuminate\Support\Facades\DB;

/**
 * 内容CURD Store层
 *
 * Class DContentStore
 * @package App\Stores
 */
class DContentStore
{
    // 表名
    protected $table = 'data_content_info';

    /**
     * 新增一条内容,并且返回该条内容的id
     *
     * @param $data 新增的数据
     * @return bool 插入操作结果
     */
    public function addData($data)
    {
        if(empty($data)) return false;

        return DB::table($this->table)
            ->insertGetId($data);
    }

    /**
     * 根据某条件获得查询得到的第一条内容信息
     *
     * @param $where    查询条件
     * @return bool     查询结果
     */
    public function getFirstData($where)
    {
        if(empty($where)) return false;

        return DB::table($this->table)
            ->where($where)
            ->first();
    }

    /**
     * 根据某条件修改内容的信息
     *
     * @param $where    修改条件
     * @param $update   修改数据
     * @return bool     修改结果
     */
    public function updateData($where, $update)
    {
        if(empty($where) || empty($update)) return false;

        return DB::table($this->table)
            ->where($where)
            ->update($update);
    }

    /**
     * 根据某条件删除内容(硬删除 - 未调用)
     *
     * @param $where    删除条件
     * @return bool     删除结果
     */
    public function deleteData($where)
    {
        if(empty($where)) return false;

        return DB::table($this->table)
            ->where($where)
            ->delete();
    }

    /**
     * 获得所有内容的总条数
     *
     * @return mixed 内容总条数
     */
    public function getCount()
    {
        return DB::table($this->table)
            ->count();
    }

    /**
     * 获得请求页的内容数据
     *
     * @param $nowPage  请求页
     * @return mixed    该页的内容数据
     */
    public function getPageData($nowPage)
    {
        return DB::table($this->table)
            ->select('id', 'title', 'keywords', 'cover', 'carousel', 'read_count')
            ->forPage($nowPage, ADMIN_PAGE_NUM)
            ->orderBy('id', 'desc')
            ->get();
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
}