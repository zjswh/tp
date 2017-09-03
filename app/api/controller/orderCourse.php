<?php
    require "../init.inc.php";
    switch ($_GET['action']){
        case 'add':
            add();
            break;
        case 'cancel':
            cancel();
            break;
        case 'search':
            search();
            break;
    }
    
    function add(){
        $_id = $_GET['id'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
        $_model = new Model();
        $_sql = "SELECT * FROM user WHERE nickname='$_user'";
        $_res = $_model->one($_sql);
        if($_res->academy == null || $_res->truename == null || $_res->phone == null || $_res->email == null){
            $_arr['msg'] = 1;//'请先完善信息'
            echo json_encode($_arr);
            exit();
        }
        $_sql = "SELECT number,ordernum FROM offlinecourse WHERE id='$_id'";
        $_one = $_model->one($_sql);
        $_maxnum = $_one->number;
        $_num = $_one->ordernum;
        //判断该课程是否满了
        if($_num < $_maxnum){
            $_sql = "SELECT * FROM ordercourse WHERE offlineCourseId='$_id' AND user='$_user'";
            //判断是否已经报名
            if($_model->one($_sql)){
                $_arr['msg'] = 2;//'您已报名！'
                echo json_encode($_arr);
                exit();
            }else{
                $_sql = "INSERT INTO ordercourse(offlineCourseId,user,time) VALUES('$_id','$_user',NOW())";
                if($_model->aud($_sql)){
                    $_sql = "UPDATE offlinecourse SET ordernum=ordernum+1 WHERE id='$_id'";
                    $_model->aud($_sql);
                    $_arr['msg'] = 0;
                    echo json_encode($_arr);
                }
            }
            
        }else{
            $_arr['msg'] = 3;//'报名人数已满'
            echo json_encode($_arr);
        }
    }

    
    function cancel(){
        $_id = $_GET['id'];
        $_arr = array();
        $_user = Validate::getUser($_arr);
//         $_date = time();
        $_model = new Model();
//         $_sql = "SELECT tranning_date FROM offlinecourse WHERE id='$_id'";
//         $_time = strtotime($_model->one($_sql)->tranning_date);
//         if($_time < $_date){
//             $_arr['msg'] = 4;//取消报名失败
           
//         }else if(($_time - $_date) >24*60*60){
//             $_arr['msg'] = 0; //取消成功
//         }else{
//             $_arr['msg'] = 5;//等待审核
//         }
//         if($_arr['msg'] == 0){
//             $_sql = "DELETE FROM ordercourse WHERE user='$_user' AND offlineCourseId='$_id'";
//             if($_model->aud($_sql)){
//                 $_sql = "UPDATE offlinecourse SET ordernum=ordernum-1 WHERE id='$_id'";
//                 $_model->aud($_sql);
//             }
//         }
//         echo json_encode($_arr);
        $_sql = "DELETE FROM ordercourse WHERE user='$_user' AND offlineCourseId='$_id'";
        if($_model->aud($_sql)){
            $_sql = "UPDATE offlinecourse SET ordernum=ordernum-1 WHERE id='$_id'";
            $_model->aud($_sql);
            $_arr['msg'] = 0;
            echo json_encode($_arr);
        }
    }
 ?>
