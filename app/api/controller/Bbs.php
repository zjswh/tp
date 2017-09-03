<?php
    namespace app\api\controller;
    
    use app\api\model\bbs as BbsModel;

    class Bbs{
        public function add(){
            $_arr = array();
            $_user = Validate::getUser($_arr);
            $_type = $_GET['type'];
            $_title = $_GET['title'];
            $_content = $_GET['content'];
            $_imglist = isset($_GET['imglist'])? $_GET['imglist']:null;
            $_model = new Model();
            $_sql = "INSERT INTO bbs(username,type,title,content,imglist,date)
            VALUES('$_user','$_type','$_title','$_content','$_imglist',NOW())";
            $_arr['msg'] = $_model->aud($_sql) ? 0:1;
            echo json_encode($_arr);
        }
        
        //显示全部
        public function show(){
    //         $_id = $_GET['id'];
            $_token = @$_GET['token'];
            $_model = new Model();
            $_sql = "SELECT * FROM bbs ";
            $_arr['state'] = Validate::checkToken($_token);
            $_object = Validate::checkObject($_model->all($_sql));
            foreach($_object as $_value){
                $_sql = "SELECT * FROM user WHERE nickname='$_value->username'";
                $_value->imgurl = $_model->one($_sql)->imgurl;
                $_value->date = Tool::changeTime($_value->date);
                $_value->imglist = changeImg($_value->imglist);
            }
            if($_arr['state'] == 0){
                $_arr['data'] = $_object;
            }else{
                $_user = Validate::getMessage($_token)->nickname;
                foreach($_object as $_value){
                    if($_value->username == $_user){
                        $_value->manage = 1;
                    }else{
                        $_value->manage = 0;
                    }
                }
                $_arr['data'] = $_object;
            }
            
            echo json_encode($_arr);
        }
        
        
        
        //显示精帖
        public function showBest(){
            $_model = new Model();
            $_sql = "SELECT * FROM bbs WHERE type=2 ORDER BY date DESC";
            $_arr['data'] = Validate::checkObject($_model->all($_sql));
            echo json_encode($_arr);
        }
        
        public function update(){
            $_arr = array();
            $_user = Validate::getUser($_arr);
            $_id = $_GET['id'];
            $_model = new Model();
            $_type = $_GET['type'];
            $_title = $_GET['title'];
            $_content = $_GET['content'];
            $_sql = "UPDATE bbs SET type='$_type',content='$_content',title='$_title' date=NOW() WHERE id='$_id'";
            $_arr['msg'] = $_model->aud($_sql) ? 0:1;
            echo json_encode($_arr);
        }
        public function changeImg($_img){
            $_a = $_img;
            $_a = explode(';', $_a);
            return $_a;
        }
    }
    
?>
