<?php
    namespace app\schoolapp\controller;

    use think\Controller;
    use think\Request;
    use app\schoolapp\model\User as UserModel;

    class User extends controller{
        public function index(){
            // return view('admin',['user'=>'hah']);
            
            return $this->fetch('Index/admin');
        }
        public function user(){
            $user = UserModel::paginate(10);
            $this->assign('userlist',$user);
            $this->assign('title','用户信息');
            return $this->fetch('Index/user');
        }
        public function delete(Request $request){
            $list = UserModel::where('id', 'in', $request->param('id'))->paginate(1,false,['query' => request()->param(), ]);
            $this->assign('userlist',$list);
            $this->assign('title','用户信息');
            return $this->fetch('user');
            // if($user->delete()){
            //     return '用户[ ' . $user->name . ' ]删除成功';
            // }else{
            //     return $user->getError();
            // }
        }
        public function demo(){

            // $user = UserModel::get($id);
            // if ($user) {
            //     return json($user);
            // } else {
            //     return json(['error' => '用户不存在'], 404);
            // }
            return input('id');
        }
        public function search(){
            $word = input('word');

            $list = UserModel::where('nickname', 'like', '%'.$word.'%')->paginate(2,false,['query' => request()->param(), ]);
            $this->assign('userlist',$list);
            $this->assign('title','用户信息');
            return $this->fetch('user');
        }
        public function top(){
            return view('top');
        }
        public function sidebar(){
            return view('sidebar');
        }
    }
?>