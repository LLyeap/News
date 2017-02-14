<?php

namespace App\Stores;

use Illuminate\Support\Facades\DB;

/**
 * 导航CURD Store层
 *
 * Class DCategoryStore
 * @package App\Stores
 */
class DNavStore
{
    // 表名
    protected $table = 'data_nav_info';

    /**
     * 获得所有的导航信息
     *
     * @return mixed 类别信息数组
     */
    public function getDataAll()
    {
        return DB::table($this->table)
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * 新增一条导航信息
     *
     * @param $data 新增的信息内容
     * @return bool 插入是否成功
     */
    public function addData($data)
    {
        if(empty($data)) return false;

        return DB::table($this->table)
            ->insert($data);
    }

    /**
     * 根据某条件获得查询得到的第一条导航信息
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
     * 根据某条件修改导航的信息
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
     * 根据某条件删除导航(硬删除)
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
     * 获得导航总条数(分页用)
     *
     * @return mixed    总条数
     */
    public function getCount()
    {
        return DB::table($this->table)
            ->count();
    }

    /**
     * 获得请求页的导航数据
     *
     * @param $nowPage  请求页
     * @return mixed    该页用户数据
     */
    public function getPageData($nowPage)
    {
        return DB::table($this->table)
            ->forPage($nowPage, ADMIN_PAGE_NUM)
            ->orderBy('id', 'asc')
            ->get();
    }
}