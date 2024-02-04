<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $res_name = $_POST['res_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $res_type = $_POST['res_type'];

        include '../upload.php';

        $select_res_name = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_name` = '$res_name' ");
        $select_username = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `username` = '$username' ");
        
        if($select_res_name -> num_rows > 0){
            alert('ชื่อร้านอาหารซ้ำ กรุณาเปลี่ยนใหม่', 'register.php');
        } else if($select_username -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่', 'register.php');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = mysqli_query($conn, "INSERT INTO `restaurant`( `res_name`, `firstname`, `lastname`, `img`, `username`, `password`, `address`, `phone`, `res_type`)
                VALUES('$res_name', '$firstname', '$lastname', '$filename', '$username', '$password', '$address', '$phone', '$res_type') ");
            } else {
                $sql = mysqli_query($conn, "INSERT INTO `restaurant`( `res_name`, `firstname`, `lastname`, `username`, `password`, `address`, `phone`, `res_type`)
                VALUES('$res_name', '$firstname', '$lastname', '$username', '$password', '$address', '$phone', '$res_type') ");
            }
            echo $sql ? alert('สมัครใช้งานสำเร็จ กรุณารออนุมัติการใช้งาน', 'login.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'register.php');
        }
    }

?>