<?php
namespace app\index\model;

use think\Model;

class Role extends Model
{   
    protected $autoWriteTimestamp = false;
    public function user()
    {
        // 角色 BELONGS_TO_MANY 用户
        return $this->belongsToMany('User', 'think_access');
    }

}