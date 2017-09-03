<?php
 require "../init.inc.php";
    switch ($_GET['action']){
        case 'show':
            show();
            break;
    }
    function show(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM bbs WHERE id IN(SELECT bbsId FROM userbbs WHERE user='$_user' ORDER BY date DESC) ";
        $_object = $_model->all($_sql);
        foreach($_object as $_value){
            $_sql = "SELECT * FROM user WHERE nickname='$_value->username'";
            $_value->imgurl = $_model->one($_sql)->imgurl;
            $_value->date = Tool::changeTime($_value->date);
            $_value->imglist = changeImg($_value->imglist);
        }
        $_arr['data'] = $_object;
        echo json_encode($_arr);
    }
    function changeImg($_img){
        $_a = $_img;
        $_a = explode(';', $_a);
        return $_a;
    }
?>