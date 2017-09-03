<?php
namespace app\index\controller;
use think\Db;
class Dtest 
{
    public function index(){
        $DB = DB::table('book');
        $res = $DB->select();
        dump($DB);
    }
}
?>
