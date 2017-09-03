<?php
    namespace app\schoolapp\controller;

    use think\Db;
    use think\Controller;
    use think\Request;
    use app\schoolapp\model\User;
    use think\cache\driver\Memcache;
    // use think\cache\driver\Redis;
    class Demo extends controller
    {
        public function show()
        {
            // $user = User::all();
            // print_r($user);
            return view('',['name'=>'hello'],['__PUBLIC__'=>'public']);
        }

        public function save()
        {
            // $memcache = new Memcache;
            // $user = User::all();
            // // $memcache->set('db','schoolapp');
            // // echo $memcache->get('db');
            $redis = new \Redis();
            $redis->connect('127.0.0.1',6379);
            // foreach($user as $key=>$value){
            //     $redis->hset($key,'id',$value->id);
            //     $redis->hset($key,'nickname',$value->nickname);
            // }
            // echo $redis->hmGet(0,array('id','nickname'));
            // echo $redis->hget(0,'id');
           print_r($redis->hgetall(0));
        }
        public function update(){
           
            $data = [
                'type' => 4,
                'info'  => '啊啊'
            ];
            if(Db::name('bbstype')->insert($data)){
                $nextId = Db::name('user')->getLastInsID();
                $redis = new \Redis();
                $redis->connect('127.0.0.1',6379);
                $redis->hset('bbs_'.$nextId,'type',$data['type']);
                $redis->hset('bbs_'.$nextId,'info',$data['info']);
            }else{
                return '添加失败';
            }
            
        }
        public function  getList(Request $request){
            $redis = new \Redis();
            $redis->connect('127.0.0.1',6379);
            // $arr = array_search('bbs_1', $redis->keys('*'));
            // var_dump($arr);
            $redis->lpush('bbs_',1);
            $redis->lpush('bbs_',2);
            echo $redis->llen('bbs_');

        }
        public function setRedis(){
            

            // $redis->del();
            // print_r($redis->keys());
            $redis = new \Redis();
            $redis->connect('127.0.0.1',6379);
            $bbs = Db::name('bbstype')
                ->select();

            foreach($bbs as $key=>$val){

                $redis->del('bbs_'.$val['id']);
                $redis->hset('bbs_'.$val['id'],'type',$val['type']);
                $redis->hset('bbs_'.$val['id'],'info',$val['info']);
            }
        }
    }
?>