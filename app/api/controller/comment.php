<?php
    require "../init.inc.php";
    switch ($_GET['action']){
        case 'add':
            add();
            break;
        case 'show':
            show();
            break;
        case 'collect':
            collect();
            break;
        case 'isCollect':
            isCollect();
            break;
        case 'deleteComment':
            deleteComment();
            break;
    }
    function add(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_id = $_GET['id'];
        $_content= $_GET['content'];
        $_model = new Model();
        $_sql = "INSERT INTO comment(articleId,username,content,date) VALUES ('$_id','$_user','$_content',NOW())";
        $_arr['msg'] = $_model->aud($_sql)? 0:1;
        echo json_encode($_arr);
    }
    function collect(){
        $_id = $_GET['id'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM userbbs WHERE bbsId='$_id' AND user='$_user'";
        if($_model->one($_sql)){
            $_sql = "DELETE FROM userbbs WHERE bbsId='$_id' AND user='$_user'";
            $_model->aud($_sql);
            $_arr['msg'] = 1;
        }else{
            $_sql = "INSERT INTO userbbs(bbsId,user,date) VALUES ('$_id','$_user',NOW())";
            $_model->aud($_sql);
            $_arr['msg'] = 0;
        }
        echo json_encode($_arr);
    }
    function isCollect(){
        $_id = $_GET['id'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "UPDATE bbs SET readcount=readcount+1 WHERE id='$_id'";
        $_model->aud($_sql);
        $_sql = "SELECT * FROM userbbs WHERE bbsId='$_id' AND user='$_user' ";
        $_arr['collect'] = $_model->one($_sql) ? 1:0;
        echo json_encode($_arr);
    }
    //显示该帖子下的所有评论，并判断是否有正在登录的用户发表的评论，添加manage字符进行分辨
    function show(){
        $_arr = array();
        $_id = $_GET['id'];
        $_token = @$_GET['token'];
        $_model = new Model();
        $_sql = "SELECT * FROM comment WHERE articleId='$_id' ORDER BY date ASC";
        $_object = $_model->all($_sql);
        foreach($_object as $_value){
            $_sql = "SELECT imgurl FROM user WHERE nickname='$_value->username'";
            $_value->imgurl = $_model->one($_sql)->imgurl;
        }
        if(!isset($_token)){
           $_arr['data'] = $_object;
        }else{
            $_sql = "SELECT * FROM user WHERE token='$_token'";
            $_user = $_model->one($_sql)->nickname;
            if($_object){
                foreach($_object as $_value){
                    if($_value->username == $_user){
                        $_value->manage = 1;
                    }else{
                        $_value->manage = 0;
                    }
                    $_value->date = Tool::changeTime($_value->date);
                }
            }
            $_arr['data'] = $_object;
        }
        $_arr['msg'] = $_arr['data']? 0:1;
        echo json_encode($_arr);
    }
    
    function deleteComment(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_id = $_GET['id'];
        $_model = new Model();
        $_sql = "DELETE FROM comment WHERE id='$_id'";
        $_model->aud($_sql);
        $_arr['msg'] = 0;
        echo json_encode($_arr);
        
    }

?>
