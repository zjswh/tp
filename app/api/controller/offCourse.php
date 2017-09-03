<?php
    require "../init.inc.php";
    switch($_GET['action']){
        case 'show':
            show();
            break;
        case 'search':
            search();
            break;
    }
    function show(){
        $_model = new offCourseModel();
        $_arr = array();
        $_arr['data']  = Validate::checkObject($_model->getAllOffCourse());
        echo json_encode($_arr);
    }
    function search(){
        $_model = new offCourseModel();
        $_model->word = $_GET['word'];
        $_token = $_GET['token'];
        $_arr = array();
        $_arr['state'] = Validate::checkToken($_token);
        $_arr['data']  = Validate::checkObject($_model->searchCourse());
        echo json_encode($_arr);
    }
?>