<?php
    require "../init.inc.php";
    switch($_GET['action']){
        case 'show':
            show();
            break;
    }
    function show(){
        $_model = new onCourseModel();
        $_arr = array();
        $_arr['data']  = Validate::checkObject($_model->getCourse());
        echo json_encode($_arr);
    }
?>