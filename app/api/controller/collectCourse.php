<?php
    require "../init.inc.php";
    switch ($_GET['action']){
        case 'collect':
            collect();
            break;
        case 'show':
            show();
            break;
        case 'isCollect':
            isCollect();
            break;
    }
    function collect(){
        $_id = $_GET['id'];
        $_type = $_GET['type'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM usercourse WHERE courseId='$_id' AND user='$_user'AND type='$_type'";
        if($_model->one($_sql)){
            $_sql = "DELETE FROM usercourse WHERE courseId='$_id' AND user='$_user'AND type='$_type'";
            $_model->aud($_sql);
            $_arr['msg'] = 1;
        }else{
            $_sql = "INSERT INTO usercourse(courseId,type,user,date) VALUES ('$_id','$_type','$_user',NOW())";
            $_model->aud($_sql);
            $_arr['msg'] = 0;
        }
        echo json_encode($_arr);
    }
    
    function isCollect(){
        $_id = $_GET['id'];
        $_type = $_GET['type'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model(); 
        $_sql = "SELECT * FROM usercourse WHERE courseId='$_id' AND user='$_user' AND type='$_type'";
        $_arr['collect'] = $_model->one($_sql) ? 1:0;
        echo json_encode($_arr);
    }
    
    function show(){
        $_type = $_GET['type'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        if($_type == 1){
            $_sql = "SELECT * FROM onlinecourse 
                        WHERE id IN(SELECT courseId FROM usercourse WHERE user='$_user' AND type=1 ORDER BY date DESC)";
        }
        if($_type == 0){
            $_sql = "SELECT * FROM offlinecourse
                        WHERE id IN(SELECT courseId FROM usercourse WHERE user='$_user'AND type=0 ORDER BY date DESC)";
        }
        $_arr['data'] = $_model->all($_sql);
        $_arr['msg'] = $_arr['data']? 1:0;
        echo json_encode($_arr);
    }

?>
