<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        include '../upload.php';

        $select_username = mysqli_query($conn, "SELECT * FROM `rider` WHERE `username` = '$username' ");
        
        if($select_username -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่', 'register.php');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = mysqli_query($conn, "INSERT INTO `rider`(`firstname`, `lastname`, `img`, `username`, `password`, `address`, `phone`)
                VALUES('$firstname', '$lastname', '$filename', '$username', '$password', '$address', '$phone') ");
            } else {
                $sql = mysqli_query($conn, "INSERT INTO `rider`(`firstname`, `lastname`, `username`, `password`, `address`, `phone`)
                VALUES('$firstname', '$lastname', '$username', '$password', '$address', '$phone') ");
            }
            echo $sql ? alert('สมัครใช้งานสำเร็จ กรุณารออนุมัติการใช้งาน', 'login.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'register.php');
        }
    }

?>