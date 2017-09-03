<?php
    require "../init.inc.php";
    $_arr = array();
    $_user = Validate::getUser($_arr);
    $_id = $_GET['id'];
    $_model = new Model();
    $_sql = "SELECT * FROM meetmanage WHERE courseId='$_id'";
    $_object = $_model->all($_sql);
    if($_object){
        $_arr['data'] = $_object;
    }else{
        $_arr['data'] = [];
    }
    echo json_encode($_arr);
    
?>