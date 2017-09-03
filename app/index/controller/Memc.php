<?php
namespace app\index\controller;
use think\cache\driver\Memcache;
use think\cache\driver\Redis;
class Memc 
{
    public function index(){
        $memcache = new Memcache;
        // $memcache->set('key','hello memcache!');
        // $memcache->set('num',20);
        // $memcache->clear();
        
        // 缓存自减
        //$memcache->dec('num',5);

        //缓存自增
        // $memcache->inc('num',5);
        
        
        //删除缓存
        $memcache->rm('num');

        $out = $memcache->get('num');
        print_r($out);
        // $redis = new Redis();
        // $redis->set('test','demo');
        // echo $redis->get('test');
    }
}
?>
