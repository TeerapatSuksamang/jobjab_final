<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        include '../upload.php';

        if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
            $sql = mysqli_query($conn, "UPDATE `admin` SET
            `firstname` = '$firstname',
            `lastname` = '$lastname',
            `img` = '$filename',
            `username` = '$username',
            `address` = '$address',
            `phone` = '$phone'
            WHERE `admin_id` = '".$_SESSION['admin_id']."' ");
        } else {
            $sql = mysqli_query($conn, "UPDATE `admin` SET
            `firstname` = '$firstname',
            `lastname` = '$lastname',
            `username` = '$username',
            `address` = '$address',
            `phone` = '$phone'
            WHERE `admin_id` = '".$_SESSION['admin_id']."' ");
        }
        echo $sql ? alert('แก้ไขข้อมูลสำเร็จ', 'profile.php') : alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'profile_edit.php');
    }

?>