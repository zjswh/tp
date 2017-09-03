<?php
namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    public function index()
    {
        // $user = User::get(Session::get('user_id'));
        // Request::instance()->bind('user',$user);
        $arr = ['a'=>'aa','b'=>'bb','c'=>'cc','d'=>'dd','e'=>'ee'];
        $v = ['Dog','Cat','Pig','ASS'];

        // $arr_new = array_rand($arr,3);
        // var_dump(array_reduce($v, function($v1,$v2){
        //         return $v1.'-'.$v2;
        // },5));
        var_dump(key($arr));
    }
    private function myfunction($v1,$v2){
        return $v1.'-'.$v2;
        // "myfunction"
    }
    public function change(){
        $a = 'make_by_id';
        $arr = explode('_', $a);
        for($i=0;$i<count($arr);$i++){
            $arr[$i] = ucfirst($arr[$i]);
        }
        // foreach($arr as $value){
        //     $value = ucfirst($value);
        // }
        $string=implode('',$arr);
        var_dump($string);
    }
    public function sort(){
        $b = [12,1,5,78,42];
        $len = count($b);
        for($k=0;$k<=$len;$k++)
        {
            for($j=$len-1;$j>$k;$j--){
                if($b[$j]<$b[$j-1]){
                    $temp = $b[$j];
                    $b[$j] = $b[$j-1];
                    $b[$j-1] = $temp;
                }
            }
        }
        var_dump($b);
    }
    public function getMax(){
        $a = ['b','a','f'];
        var_dump(max($a));
    }
}