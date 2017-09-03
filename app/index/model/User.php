<?php
    namespace app\index\model;
    use think\Model;
    class User extends Model{
        // protected $name = 'user';
        // public function getBirthdayAttr($birthday){
        //     return date('Y-m-d',$birthday);
        // }
        // public function setBirthdayAttr($birthday){
        //     return strtotime($birthday);
        // }
        // public function getUserBirthdayAttr($value,$data){
        //     return date('Y-m-d',$data['birthday']);
        // }
        
        // 类型转换
        // protected $dateFormat = 'Y/m/d';
        protected $type  = [
                        'birthday' =>'timestamp:Y/m/d',
        ];
         // 定义时间戳字段名
        // protected $createTime = 'create_at';
        
        // protected $updateTime = 'update_at';
        // 关闭自动写入时间戳
        protected $autoWriteTimestamp = true;

        // 定义自动完成的属性
        protected $insert = ['status'=>1];
        // status属性修改器
        // protected function setStatusAttr($value, $data)
        // {
        //     return '流年' == $data['nickname'] ? 1 : 2;
        // }

        // // status属性读取器
        // protected function getStatusAttr($value)
        // {
        //     $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        //     return $status[$value];
        // }
         // email查询
        protected function scopeEmail($query)
        {
            $query->where('email', 'thinkphp@qq.com');
        }

        // status查询
        protected function scopeStatus($query)
        {
            $query->where('status', 1);
        }
        // 全局查询范围
        protected static function base($query)
        {
            // 查询状态为1的数据
            $query->where('status',1);
        }
        public function books(){
            return $this->hasMany('Book');
        }
        // 定义关联方法
        public function profile()
        {
            // 用户HAS ONE档案关联
            return $this->hasOne('Profile');
        }
        public function roles(){
            // 用户 BELONGS_TO_MANY 角色
            return $this->belongsToMany('Role', 'think_access');
        }
        protected function getUserStatusAttr($value)
        {
            $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
            return $status[$value];
        }
    }
?>