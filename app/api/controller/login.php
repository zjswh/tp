<?php
    require "../init.inc.php";
    $_arr = array();
    $_nickname = $_GET['nickname'];
    $_imgurl = $_GET['imgurl'];
    $_gender = $_GET['gender'];
    $_signature = $_GET['signature'];
    $_token = md5($_nickname.$_imgurl.time());
    $_model = new Model();
    $_sql = "SELECT nickname FROM user WHERE nickname='$_nickname'";
    if($_model->one($_sql)){
        $_sql = "UPDATE user SET token='$_token',date=NOW() WHERE nickname='$_nickname'";
    }else{
        $_sql = "INSERT INTO user(nickname,imgurl,token,gender,signature,date)
                VALUES('$_nickname','$_imgurl','$_token','$_gender','$_signature',NOW())";
    }
    $_arr['token'] = $_token;
    $_arr['success'] = $_model->aud($_sql) ? 1:0;
    echo json_encode($_arr);
    
?>
