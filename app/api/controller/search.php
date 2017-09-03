<?php
    require "../init.inc.php";
    $_word = $_GET['word'];
    $_model = new Model();
    $_arr = array();
    $_sql = "SELECT 
                     c.*
             FROM 
                    onlinecourse o
            LEFT JOIN
                    onlinechildtitle c
                ON 
                    o.id=c.courseId
             WHERE 
                o.name LIKE '%$_word%'
            OR
                o.info LIKE '%$_word%'
            OR
                c.name LIKE '%$_word%'";
    $_arr['on'] = $_model->all($_sql);
    $_sql = "SELECT 
                    o.* 
                FROM 
                    offlinecourse o
                LEFT JOIN
                    offlinechildtitle c
                ON 
                    o.id=c.courseId
                WHERE
                    o.name LIKE '%$_word%'
                OR 
                    c.name LIKE '%$_word%'
                ";
    $_arr['off'] = $_model->all($_sql);
    
    echo json_encode($_arr);
 ?>