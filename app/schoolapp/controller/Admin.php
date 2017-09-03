<?php
namespace app\schoolapp\controller;
use think\Controller;

class Admin extends controller{
    public function index(){
        return $this->fetch('Index/Admin');
        // dump(config());
    }
} 
?>
