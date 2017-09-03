<?php
    require "../init.inc.php";
    switch($_GET['action']){
        case 'show':
            show();
            break;
    }
    function show(){
        $_model = new onCourseModel();
        $_token = $_GET['token'];
        $_arr = array();
        $_arr['state'] = Validate::checkToken($_token);
        $_arr['data']  = Validate::checkObject($_model->getAllOnCourse());
        echo json_encode($_arr);
    }
?>