<?php
    require "../init.inc.php";
    $_model = new Model();
    $_time = '';
    $_arr = array();
    $_sql = "SELECT date,id,nickname,imgurl FROM user";
    if($_object = $_model->all($_sql)){
        foreach($_object as $_key=>$_value){
            $_time = strtotime($_value->date);
            if((time()-$_time) > ACTIVE_TIME){
                $_token = md5($_value->nickname.$_value->imgurl.time());
                $_sql = "UPDATE user SET token='$_token' WHERE id='$_value->id'";
                $_model->aud($_sql);
                $_arr['success'] = 1;
                echo json_encode($_arr);
            }
        }
    }
?>