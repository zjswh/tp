<?php
    namespace app\schoolapp\model;
    use think\Model;

    class Common extends Model{
        protected $name = '';
        public function __construct($model){
            $this->name = $model;
        }


    }
?>
