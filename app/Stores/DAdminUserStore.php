<?php

namespace App\Stores;

use Illuminate\Support\Facades\DB;

class DAdminUserStore
{
    // 表名
    protected $table = 'data_admin_user';

    public function getFirstData($where)
    {
        if(empty($where)) return false;

        return DB::table($this->table)
            ->where($where)
            ->first();
    }

    public function updateData($where, $update)
    {
        if(empty($where) || empty($update)) return false;

        return DB::table($this->table)
            ->where($where)
            ->update($update);
    }

    public function getCount()
    {
        return DB::table($this->table)
            ->count();
    }

    public function getPageData($nowPage)
    {
        return DB::table($this->table)
            ->forPage($nowPage, ADMIN_PAGE_NUM)
            ->orderBy('id', 'asc')
            ->get();
    }
}