<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $res_name = $_POST['res_name'];
        $res_type = $_POST['res_type'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        include '../upload.php';

        $select_res_name = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_name` = '$res_name' AND `res_id` != '".$_SESSION['res_id']."' ");
        $select_username = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `username` = '$username' AND `res_id` != '".$_SESSION['res_id']."' ");
        
        if($select_res_name -> num_rows > 0){
            alert('ชื่อร้านอาหารซ้ำ กรุณาเปลี่ยนใหม่', 'register.php');
        } else if($select_username -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่', 'register.php');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = mysqli_query($conn, "UPDATE `restaurant` SET
                `res_name` = '$res_name',
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `img` = '$filename',
                `username` = '$username',
                `address` = '$address',
                `res_type` = '$res_type',
                `phone` = '$phone'
                WHERE `res_id` = '".$_SESSION['res_id']."' ");
            } else {
                $sql = mysqli_query($conn, "UPDATE `restaurant` SET
                `res_name` = '$res_name',
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `username` = '$username',
                `address` = '$address',
                `res_type` = '$res_type',
                `phone` = '$phone'
                WHERE `res_id` = '".$_SESSION['res_id']."' ");
            }
            echo $sql ? alert('แก้ไขข้อมูลสำเร็จ', 'profile.php') : alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'profile_edit.php');
        }
    }

?>