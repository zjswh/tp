<?php
    require "../init.inc.php";
    switch($_GET['action']){
        case 'show':
            show();
            break;
    }
    
    function show(){
        $_token = $_GET['token'];
        $_model = new onCourseModel();
        $_arr = array();
        $_arr['state'] = Validate::checkToken($_token);
        $_arr['data']  = Validate::checkObject($_model->getAllCourseType());
        echo json_encode($_arr);
    }
?>
