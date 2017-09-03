<?php
    namespace app\index\controller;
    use think\Request;
    class Responses{
        public function hello(Request $request,$name = 'World'){
            echo '路由信息：';
            dump($request->routeInfo());
            echo '调度信息：';
            dump($request->dispatch());
            return "hello,".$name.'!';
        }
         public function demo()
        {
            $data = ['name' => 'thinkphp', 'status' => '1'];
            return json($data,201,['Cache-control' => 'no-cache,must-revalidate']);
        }
        use \traits\controller\Jump;
        public function index($name=''){
            if('thinkphp' == $name){
                $this->success('欢迎使用thinkphp','hello');
            }else{
                // $this->error('错误的name','guest');
                $this->redirect('http://www.baidu.com');
            }
        }
        public function guest(){
            return 'Hello,Guest!';
        }
    }
?>
