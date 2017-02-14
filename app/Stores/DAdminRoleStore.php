<?php

namespace App\Stores;

use Illuminate\Support\Facades\DB;

/**
 * 管理员角色CURD Store层
 *
 * Class DAdminUserStore
 * @package App\Stores
 */
class DAdminRoleStore
{
    // 表名
    protected $table = 'data_admin_role';

    /**
     * 新增一条管理员角色信息
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
     * 根据某条件获得查询得到的第一条角色信息
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
     * 根据某条件修改管理员角色的信息
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
     * 根据某条件删除用户角色(硬删除)
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
     * 获得用户角色总条数(分页用)
     *
     * @return mixed    总条数
     */
    public function getCount()
    {
        return DB::table($this->table)
            ->count();
    }

    /**
     * 获得请求页的用户角色数据
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