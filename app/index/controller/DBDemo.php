<?php
    namespace app\index\controller;
    use think\Db;
    class DBDemo{
        public function index(){
            // $result = Db::name('data')
            //     ->where('id','between',[1,3])
            //     ->where('name','like','%think%')
            //     ->limit(10)
            //     ->select();
            // $result = Db::name('data')
            //     ->where([
            //         'id'   => [['in',[4]],['between','1,3'],'or'],
            //         'name' => ['like','%think%']
            //     ])->select();
            // $result = Db::view('user','id,name,status')
            //     ->view('profile',['name'=>'truename','phone','email'],'profile.user_id=user.id')
            //     ->where('status',1)
            //     ->select();
            $result = Db::name('data')
                ->where('status', '>', 0)
                ->chunk(1, function ($list) {
                    // 处理100条记录
                    foreach($list as $data){

                    }
                });
            dump($result);
        }
    }
?>
