<?php

    include_once 'session.php';
    if(isset($_POST['edit_web_name'])){
        $sql = mysqli_query($conn, "UPDATE `admin` SET `web_name` = '".$_POST['web_name']."' ");
        echo $sql ? header('location: web_manage.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'web_manage.php');
    }

    if(isset($_POST['add_cpn'])){
        $cpn_code = $_POST['cpn_code'];
        $cpn_discount = $_POST['cpn_discount'];
        $select = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `cpn_code` = '$cpn_code' ");
        if($select -> num_rows > 0){
            alert('ชื่อโค้ดส่วนลดซ้ำ', 'web_manage.php');
        } else {
            $sql = mysqli_query($conn, "INSERT INTO `coupon`(`cpn_code`, `cpn_discount`) VALUES('$cpn_code', '$cpn_discount') ");
            echo $sql ? header('location: web_manage.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'web_manage.php');
        }
    }

    if(isset($_GET['del_cpn'])){
        $sql = mysqli_query($conn, "DELETE FROM `coupon` WHERE `cpn_id` = '".$_GET['del_cpn']."' ");
        echo $sql ? header('location: web_manage.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'web_manage.php');
    }

?>