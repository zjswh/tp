<?php
    require "../init.inc.php";
    switch ($_GET['action']){
        case 'deleteAll':
            deleteAll();
            break;
        case 'deleteOne':
            deleteOne();
            break;
        case 'show':
            show();
            break;
    }
    
    function show(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM video WHERE id IN(SELECT videoId FROM lookedvideo WHERE user='$_user')";
        $_arr['data'] = $_model->all($_sql);
        echo json_encode($_arr);
    }
    
    function deleteAll(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_arr['data'] = $_user;
        $_sql = "DELETE FROM lookedvideo WHERE user='$_user'";
        $_model->aud($_sql);
        $_arr['msg'] = 0;
        echo json_encode($_arr);
    }
    
    function deleteOne(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_id = $_GET['id'];
        $_model = new Model();
        $_sql = "DELETE FROM lookedvideo WHERE user='$_user' AND videoId='$_id'";
        $_model->aud($_sql);
        $_arr['msg'] = 0;
        echo json_encode($_arr);
    }
    
?>