<?php
require "../init.inc.php";
switch ($_GET['action']){
    case 'collect':
        collect();
        break;
    case 'show':
        show();
        break;
    case 'addcount':
        addcount();
        break;
}
function addcount(){
    $_id = $_GET['id'];
    $_arr = array();
    $_model = new Model();
    $_sql = "UPDATE newlist SET readcount=readcount+1 WHERE id='$_id'";
    $_model->aud($_sql);
    $_arr['msg'] = 0;
    echo json_encode($_arr);
}
//显示全部
function show(){
    $_model = new Model();
    $_arr = array();
    $_sql = "SELECT * FROM newlist ";
    $_object = Validate::checkObject($_model->all($_sql));
    foreach($_object as $_value){
        $_value->date = Tool::changeTime($_value->date);
        $_value->imglist = changeImg($_value->imglist);
    }
    $_arr['data'] = $_object;
    echo json_encode($_arr);
}

// function collect(){
//     $_id = $_GET['id'];
//     $_arr = array();
//     $_user = Validate::getUser($_arr);
//     $_model = new Model();
//     $_sql = "SELECT * FROM userbbs WHERE bbsId='$_id' AND user='$_user'";
//     if($_model->one($_sql)){
//         $_sql = "DELETE FROM userbbs WHERE bbsId='$_id' AND user='$_user'";
//         $_model->aud($_sql);
//         $_arr['msg'] = 1;
//     }else{
//         $_sql = "INSERT INTO userbbs(bbsId,user,date) VALUES ('$_id','$_user',NOW())";
//         $_model->aud($_sql);
//         $_arr['msg'] = 0;
//     }
//     echo json_encode($_arr);
// }

function changeImg($_img){
    $_a = $_img;
    $_a = explode(';', $_a);
    return $_a;
}
?>
