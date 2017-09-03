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
        
        $_model = new Model();
        $_sql = "SELECT * FROM video WHERE sectionId='{$_GET['id']}'";
        $_res = $_model->total($_sql);
        $_pagesize =  PAGE_SIZE;
        $_count = ceil($_res / $_pagesize);
        $_page = 1;
        if(!isset($_GET['page']) || $_GET['page'] < 1){
            $_page = 1;
        }else{
            $_page = $_GET['page'];
            if($_page > $_count){
                $_page = $_count;
            }
        }

        $_limit = ($_page - 1) * $_pagesize;
        $_sql = "SELECT * FROM video WHERE sectionId='{$_GET['id']}' LIMIT {$_limit},{$_pagesize}";
        if(!!$_object = $_model->all($_sql)){
            $_arr = array('data'=>$_object);
            echo json_encode($_arr);
        }
       

    }

    function search(){
        $_model = new videoModel();
        $_model->word = $_GET['word'];
        if(!!$_object = $_model->searchVideo()){
            $_arr = array('data'=>$_object);
            echo json_encode($_arr);
        }
    }
?>