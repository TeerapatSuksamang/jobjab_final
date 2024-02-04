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

        $select_username = mysqli_query($conn, "SELECT * FROM `rider` WHERE `username` = '$username' AND `rider_id` != '".$_SESSION['rider_id']."' ");
        
        if($select_username -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่', 'profile_edit.php');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = mysqli_query($conn, "UPDATE `rider` SET
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `img` = '$filename',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone'
                WHERE `rider_id` = '".$_SESSION['rider_id']."' ");
            } else {
                $sql = mysqli_query($conn, "UPDATE `rider` SET
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone'
                WHERE `rider_id` = '".$_SESSION['rider_id']."' ");
            }
            echo $sql ? alert('แก้ไขข้อมูลสำเร็จ', 'profile.php') : alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'profile_edit.php');
        }
    }

?>