<?php
namespace app\index\controller;


use app\index\model\Profile;
use app\index\model\Book;
use app\index\model\Role;
use app\index\model\User as UserModel;
use think\Controller;

class User extends Controller{
    public function add(){
        $user           = new UserModel;
        $user->name     = 'thinkphp';
        $user->password = '123456';
        $user->nickname = '张三';
        if ($user->save()) {
            $profile           = new Profile;
            $profile->truename = '刘晨';
            $profile->birthday = '1977-03-05';
            $profile->address  = '中国上海';
            $profile->email    = 'thinkphp@qq.com';
            $user->profile()->save($profile);
            return '用户新增成功';
        }else{
            return $user->getError();
        }
        // $user = new UserModel;
        // $user->nickname = '飞鱼';
        // $user->email = 'thinkphp@qq.com';
        // $user->birthday = '2016-05-16';
        // if($user->save()){
        //     return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        // }else{
        //     return $user->getError();
        // }
        
        // $data = input('post.');
        // // 数据验证
        // $result = $this->validate($data,'User');
        // if (true !== $result) {
        //     return $result;
        // }
        // $user = new UserModel;
        // // 数据保存
        // $user->allowField(true)->save($data);
        // return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        
        // $user['nickname'] = '看云';
        // $user['email']    = 'kancloud@qq.com';
        // $user['birthday'] = strtotime('2015-04-02');
        // if ($result = UserModel::create($user)) {
        //     return '用户[ ' . $result->nickname . ':' . $result->id . ' ]新增成功';
        // } else {
        //     return '新增出错';
        // }

        // $user = new UserModel;
        // $list = [
        //     ['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1988-01-15')],
        //     ['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-09-19')],
        // ];
        // if ($user->saveAll($list)) {
        //     return '用户批量新增成功';
        // } else {
        //     return $user->getError();
        // }
    }
    public function read($id = ''){
        // $user = UserModel::get($id,'profile');
        // echo $user->name . '<br/>';
        // echo $user->nickname . '<br/>';
        // echo $user->profile->truename . '<br/>';
        // echo $user->profile->email . '<br/>';
        $user = UserModel::all();
        return view('index',['list'=>$user,'count'=>count($user)]);

        // return view('read',['list'=>$user]);
        // 
        // dump($user->hidden(['name'])->toArray());
        // dump($user->append(['user_status'])->toArray());
    }
    public function index()
    {
        // $list = UserModel::scope('email,status')->select();
        // $list = UserModel::scope('email')->select();
        // foreach ($list as $user) {
        //     echo $user->nickname . '<br/>';
        //     echo $user->email . '<br/>';
        //     echo $user->birthday . '<br/>';
        //     echo $user->status . '<br/>';
        //     echo '-------------------------------------<br/>';
        // }
        $user = UserModel::all();
        $this->assign('list',$user);
        $this->assign('count',count($user));
        $this->view->replace([
            '__PUBLIC__'    =>  '/static',
        ]);
        trace('这是测试调试信息');
        trace([1,2,3]);
        return $this->fetch();
    }
    public function update($id){
        $user = UserModel::get($id);
        $user->name = 'framework';
        if($user->save()){
            $user->profile->email = 'liu21st@gmail.com';
            $user->profile->save();
            return '用户['.$user->name.']更新成功';
        }else{
            return $user->getError();
        }
    }
    public function delete($id){
        $user = UserModel::get($id);
        if($user->delete()){
            $user->profile->delete();
            return '用户[ ' . $user->name . ' ]删除成功';
        }else{
            return $user->getError();
        }
    }
    public function create(){
        return view();
    }
    public function addBook(){
        $user = UserModel::get(1);
        $books = [
            ['title' => 'ThinkPHP5快速入门', 'publish_time' => '2016-05-06'],
            ['title' => 'ThinkPHP5开发手册', 'publish_time' => '2016-03-06'],
        ];
        $user->books()->saveAll($books);
        return '新增成功';
    }
    public function readBook(){
        $user  = UserModel::get(1);
        // 获取状态为1的关联数据
        $books = $user->books()->where('status',1)->select();
        dump($books);
        // 获取作者写的某本书
        $book  = $user->books()->getByTitle('ThinkPHP5快速入门');
        dump($book);
    }
    public function updateBook($id){
        $user        = UserModel::get($id);
        // $book        = $user->books()->getByTitle('ThinkPHP5快速入门');
        // $book->title = 'ThinkPHP5开发手册';
        // $book->save();
        $user->books()->where('title', 'ThinkPHP5快速入门')->update(['title' => 'ThinkPHP5开发手册']);
    }
    public function addRole(){
        // $user = UserModel::getByNickname('流年');
        // 新增用户角色 并自动写入枢纽表
        // $user->roles()->save(['name' => 'editor', 'title' => '编辑']);
        //  $user->roles()->saveAll([
        //     ['name' => 'leader', 'title' => '领导'],
        //     ['name' => 'admin', 'title' => '管理员'],
        // ]);
        
        //角色若已存在
        $user = UserModel::getByNickname('张三');
        $role = Role::getByName('editor');
        // 添加枢纽表数据
        $user->roles()->attach($role);
        return '用户角色添加成功';
    }
    public function deleteRole(){
        $user = UserModel::get(6);
        $role = Role::getByName('editor');
        $user->roles()->detach($role);
        return '用户角色删除成功';
    }
    public function readRole(){
        $user = UserModel::get(1);
        dump($user->roles);
    }


}
?>
