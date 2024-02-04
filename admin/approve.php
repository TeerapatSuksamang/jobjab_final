<?php

    include_once 'session.php';
    if(isset($_POST['add_res_type'])){
        $res_type = $_POST['res_type'];
        include '../upload.php';
        $select = mysqli_query($conn, "SELECT * FROM `restaurant_type` WHERE `res_type` = '$res_type' ");
        if($select -> num_rows > 0){
            alert('มีประเภทร้านอาหารนี้แล้ว', 'res_approve.php');
        } else {
            move_uploaded_file($_FILES['img']['tmp_name'], $filepath);
            $sql = mysqli_query($conn, "INSERT INTO `restaurant_type`(`res_type`, `img`) VALUES('$res_type', '$filename') ");
            echo $sql ? header('location: res_approve.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', '.php');
        }
    }

    if(isset($_GET['res_id'])){
        $res_id = $_GET['res_id'];
        $status = 0;
        if($_GET['status'] == 0){
            $status = 1;
        }
        $sql = mysqli_query($conn, "UPDATE `restaurant` SET `status` = '$status' WHERE `res_id` = '$res_id' ");
        echo $sql ? header('location: res_approve.php#'.$res_id) : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'res_approve.php#'.$res_id);
    }

    if(isset($_GET['rider_id'])){
        $rider_id = $_GET['rider_id'];
        $status = 0;
        if($_GET['status'] == 0){
            $status = 1;
        }
        $sql = mysqli_query($conn, "UPDATE `rider` SET `status` = '$status' WHERE `rider_id` = '$rider_id' ");
        echo $sql ? header('location: rider_approve.php#'.$rider_id) : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'rider_approve.php#'.$res_id);
    }

    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $status = 0;
        if($_GET['status'] == 0){
            $status = 1;
        }
        $sql = mysqli_query($conn, "UPDATE `user` SET `status` = '$status' WHERE `user_id` = '$user_id' ");
        echo $sql ? header('location: user_approve.php#'.$user_id) : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'user_approve.php#'.$res_id);
    }

?>