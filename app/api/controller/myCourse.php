<?php
    require "../init.inc.php";
    $_arr = array();
    $_user = Validate::getUser($_arr);
    $_model = new Model();
    $_sql = "SELECT * FROM onlinecourse WHERE id IN(SELECT courseId FROM lookedcourse WHERE user='$_user')";
    $_object = $_model->all($_sql);
    foreach ($_object as $_value){
        $_sql = "SELECT * FROM onlinechildtitle WHERE courseId='$_value->id'";
        if(!!$_obj = $_model->all($_sql)){
            $_value->courseList = $_obj;
            foreach($_value->courseList as $_val){
                $_sql = "SELECT * FROM video WHERE sectionId='$_val->id'";
                if(!!$_obj2 = $_model->all($_sql)){
                    $_val->videoList = $_obj2;
                }else{
                    $_val->videoList = [];
                }
            }
        }else{
            $_value->courseList = [];
        }
    }
    $_arr['data'] = $_object;
    $_arr['msg'] = 0;
    echo json_encode($_arr);
?>