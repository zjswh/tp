<?php
namespace app\index\controller;

use think\Db;

class Index 
{
   public function hello($name='world')
    {
        // $data = Db::name('data')->find();
        // $this->assign('res', 'hello');
        // return $this->fetch();
        // 
        return 'hello'.$name;
    }
    public function test(){
        $this->assign('res', 'test');
        return $this->fetch();
    }
    public function index(){
        // $result = Db::execute('insert into think_data ( name ,status) values ("java",1)');
        // dump($result);
        
        // $result = Db::execute('update think_data set name = "framework" where id = 5 ');
        // dump($result);
        // 查询数据
        // $result = Db::query('select * from think_data where id = 5');
        // dump($result);

        // 删除数据
        $result = Db::execute('delete from think_data where id = 5 ');
        dump($result);
    }
}