<?php
    require_once('connection.php');

    if (isset($_COOKIE['cc_usr'])){
        setcookie("cc_usr", "",time()-(3600));
        echo "Logout successfully";

       
        header("location: index.php");
    }else{
        echo "Something wrong!!!!!!!!!!!!!";
    }
?>