<?php

    include_once '../config/db.php';
    session_start();
    if(!$_SESSION['user_id']){
        header('location: login.php');
    }

?>