<?php
namespace app\index\model;

use think\Model;

class Profile extends Model
{   
    // protected $name = 'profile';
    protected $type       = [
        'birthday' => 'timestamp:Y-m-d',
    ];
    protected $autoWriteTimestamp = false;
    public function user()
    {
        // 档案 BELONGS TO 关联用户
        return $this->belongsTo('User');
    }

}