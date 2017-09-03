<?php

    
    $_content = htmlspecialchars($_POST['text']);
    if(!empty($_content)){
        $_sql = "INSERT INTO mess(toone,fromone,content) VALUES('user','admin','{$_content}')";
        $res = $_mysqli->query($_sql);
        echo json_encode($_content);
    }
    

?>
