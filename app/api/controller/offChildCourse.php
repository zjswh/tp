<?php
    require "../init.inc.php";
    switch($_GET['action']){
        case 'show':
            show();
            break;
    }
    function show(){
        $_model = new offCourseModel();
        $_model->courseId = $_GET['id'];
        $_arr = array();
        $_arr['data']  = Validate::checkObject($_model->getOneOffCourse());
        echo json_encode($_arr);
    }
?>
