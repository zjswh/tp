<?php
    require "../init.inc.php";
    switch ($_GET['action']){
        case 'show':
            show();
              break;
    }
    function show(){
        // AND UNIX_TIMESTAMP(tranning_date)>UNIX_TIMESTAMP(NOW()) ORDER BY UNIX_TIMESTAMP(tranning_date)-UNIX_TIMESTAMP(NOW()) ASC
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_token = $_GET['token'];
        $_type = $_GET['type'];
        $_id_on = '';
        $_id_off = '';
        $_model = new Model();
        $_sql = "SELECT offlineCourseId FROM ordercourse WHERE user='$_user'";
        $_obj = $_model->all($_sql);
        foreach($_obj as $_value){
                $_sql = "SELECT * FROM offlinechildtitle WHERE isFinish=1 AND courseId='$_value->offlineCourseId' LIMIT 1";
                if($_model->all($_sql)){
                    $_id_on .= $_value->offlineCourseId.',';
                }else{
                    $_id_off .= $_value->offlineCourseId.',';
                }
            
            
        }
        $_id_on = substr($_id_on,0,-1);
        $_id_off = substr($_id_off,0,-1);
        $_object = null;
        if($_type == 1){
            if($_id_on){
                $_sql = "SELECT * FROM offlinecourse WHERE id IN($_id_on)";
                $_object = $_model->all($_sql);
            }
            
        }else{
            if($_id_off){
                $_sql = "SELECT * FROM offlinecourse WHERE id IN($_id_off)";
                $_object = $_model->all($_sql);
            }
            
        }
        if(!!$_object){
            foreach($_object as $_value){
                $_sql = "SELECT
                    COUNT(*)
                    AS
                    count,
                    (SELECT COUNT(*) FROM offlinechildtitle WHERE courseId='$_value->id' AND isFinish=1)
                    AS
                    pro
                    FROM
                    offlinechildtitle
                    WHERE
                    courseId='$_value->id'";
                $_res= $_model->one($_sql);
                if($_res->count){
                    $_pro = $_res->pro/$_res->count;
                    $_pro= $_pro*100;
                    $_value->progress= $_pro.'%';
                }
                
                
            }
        }
        $_arr['data'] = $_object;
        echo json_encode($_arr);
    }
    
    
?>
