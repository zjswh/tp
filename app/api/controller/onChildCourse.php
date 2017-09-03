<?php
    require "../init.inc.php";
    switch($_GET['action']){
        case 'show':
            show();
            break;
    }
    function show(){
        $_model = new onCourseModel();
        $_model->courseId = $_GET['id'];
        $_token = $_GET['token'];
        $_arr = array();
        $_arr['state'] = Validate::checkToken($_token);
        if(!!$_object = $_model->getOneOnCourse()){
            $_video = new videoModel();
            foreach($_object as $value){
                $_video->sectionId = $value->id;
                $value->videolist = $_video->getVideo();
            }
            $_arr['data'] = $_object;
            
        }
        echo json_encode($_arr);
    }
    
?>
