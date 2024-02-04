<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username` = '$username' ");
        if($select -> num_rows > 0){
            $select_user = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password' ");
            $row_user = mysqli_fetch_array($select_user);
            if($select_user -> num_rows > 0){
                session_start();
                $_SESSION['admin_id'] = $row_user['admin_id'];
                header('location: profile.php');
            } else {
                alert('รหัสผ่านไม่ถูกต้อง', 'login.php');
            }
        } else {
            alert('ชื่อผู้ใช้ไม่ถูกต้อง', 'login.php');
        }
    }

?>