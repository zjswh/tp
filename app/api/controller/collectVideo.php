<?php
    require "../init.inc.php";
    switch ($_GET['action']){
        case 'collect':
            collect();
            break;
	   case 'isCollect':
            isCollect();
            break;
        case 'show':
            show();
            break;
        case 'add':
            add();
            break;
    }
    function collect(){
        $_id = $_GET['id'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM uservideo WHERE videoId='$_id' AND user='$_user'";
        if($_model->one($_sql)){
            $_sql = "DELETE FROM uservideo WHERE videoId='$_id' AND user='$_user'";
            $_model->aud($_sql);
            $_arr['msg'] = 1;
        }else{
            $_sql = "INSERT INTO uservideo(videoId,user,date) VALUES ('$_id','$_user',NOW())";
            $_model->aud($_sql);
            $_arr['msg'] = 0;
        }
        echo json_encode($_arr);
    }
    
//     function  add(){
//         $_id = $_GET['id'];
//         $_arr = array();
//         $_user = Validate::getUser($_arr);
//         $_model = new Model();
//         $_sql = "SELECT * FROM lookedvideo WHERE videoId='$_id' AND user='$_user'";
//         if($_model->one($_sql)){
//             $_sql = "UPDATE lookedvideo SET date=NOW() WHERE videoId='$_id' AND user='$_user'";
//             $_model->aud($_sql);
//         }else{
//             $_sql = "INSERT INTO lookedvideo(videoId,user,date) VALUES ('$_id','$_user',NOW())";
//             $_model->aud($_sql);
//         }
        
//         echo json_encode($_arr);
//     }
    function isCollect(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_id = $_GET['id'];
        $_courseId = $_GET['courseId'];
        $_model = new Model();
        $_sql = "SELECT * FROM lookedcourse WHERE courseId='$_courseId' AND user='$_user'";
        if($_model->one($_sql)){
            $_sql = "UPDATE lookedcourse SET date=NOW() WHERE courseId='$_courseId' AND user='$_user'";
        }else{
            $_sql = "INSERT INTO lookedcourse(courseId,user,date) VALUES ('$_courseId','$_user',NOW())";
        }
        $_model->aud($_sql);
        $_sql = "SELECT * FROM lookedvideo WHERE videoId='$_id' AND user='$_user'";
        if($_model->one($_sql)){
            $_sql = "UPDATE lookedvideo SET date=NOW() WHERE videoId='$_id' AND user='$_user'";
        }else{
            $_sql = "INSERT INTO lookedvideo(videoId,user,date) VALUES ('$_id','$_user',NOW())";
        }
        $_model->aud($_sql);
        $_sql = "SELECT * FROM uservideo WHERE videoId='$_id' AND user='$_user'";
        $_arr['collect'] = $_model->one($_sql) ? 1:0;
        echo json_encode($_arr);
    }

    function show(){
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM video WHERE id IN(SELECT videoId FROM uservideo WHERE user='$_user' ORDER BY date DESC) ";
        $_arr['data'] = $_model->all($_sql);
        echo json_encode($_arr);
    }
?>
