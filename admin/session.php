<?php

    include_once '../config/db.php';
    session_start();
    if(!$_SESSION['admin_id']){
        header('location: login.php');
    }

?>