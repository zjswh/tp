<?php
    namespace app\index\controller;

    //传统方式调用
    // use think\Request;

    // class Requests
    // {
    //     public function hello($name = 'World')
    //     {
    //         $request = Request::instance();
    //         // 获取当前URL地址 不含域名
    //         echo 'url: ' . $request->url() . '<br/>';
    //         return 'Hello,' . $name . '！';
    //     }
    // }
    
    // 如果控制器类继承了think\Controller的话，可以做如下简化调用：
    // use think\Controller;
    // class Requests extends Controller{
    //     public function hello(){
    //         echo 'url: ' . $this->request->url() . '<br/>';
    //     }
    // }
    //助手函数
    // class Requests
    // {
    //     public function hello($name = 'World')
    //     {
    //         // 获取当前URL地址 不含域名
    //         echo 'url: ' . request()->url() . '<br/>';
    //         return 'Hello,' . $name . '！';

    //     }

    // }
    //建议方法
    use think\Request;
    class Requests {
        // public function hello(Request $request){
        //     echo 'url:'.$request->url().'<br />';
        // }
         public function hello(Request $request)
        {
            // echo '请求参数：';
            // dump($request->param());
            // echo 'name:'.$request->param('name');
            
            // input助手
            // dump(input());
            // echo 'name:'.input('name');
            echo 'name:'.$request->param('name','World','strtolower');
            echo '<br />test:'.$request->param('test','think','strtoupper');

        }
        public function demo(Request $request)
        {
            echo 'GET参数：';
            dump(input('get.'));
            echo 'GET参数：name';
            dump(input('get.name'));
            echo 'POST参数：name';
            dump(input('post.name'));
            echo 'cookie参数：name';
            dump(input('cookie.name'));
            echo '上传文件信息：image';
            dump(input('file.image'));
        }
        public function de(Request $request,$name = 'World')
        {
            // 获取当前域名
            echo 'domain: ' . $request->domain() . '<br/>';
            // 获取当前入口文件
            echo 'file: ' . $request->baseFile() . '<br/>';
            // 获取当前URL地址 不含域名
            echo 'url: ' . $request->url() . '<br/>';
            // 获取包含域名的完整URL地址
            echo 'url with domain: ' . $request->url(true) . '<br/>';
            // 获取当前URL地址 不含QUERY_STRING
            echo 'url without query: ' . $request->baseUrl() . '<br/>';
            // 获取URL访问的ROOT地址
            echo 'root:' . $request->root() . '<br/>';
            // 获取URL访问的ROOT地址
            echo 'root with domain: ' . $request->root(true) . '<br/>';
            // 获取URL地址中的PATH_INFO信息
            echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
            // 获取URL地址中的PATH_INFO信息 不含后缀
            echo 'pathinfo: ' . $request->path() . '<br/>';
            // 获取URL地址中的后缀信息
            echo 'ext: ' . $request->ext() . '<br/>';

            return 'Hello,' . $name . '！';
        }
         public function mva(Request $request, $name = 'World')
        {
            echo '模块：'.$request->module();
            echo '<br/>控制器：'.$request->controller();
            echo '<br/>操作：'.$request->action();
        }
    }

?>
