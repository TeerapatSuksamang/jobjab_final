<?php

    include_once 'nav.php';
    if(isset($_POST['submit'])){
        $old_pass = $_POST['old_password'];
        $new_pass = $_POST['new_password'];

        if($old_pass == $row['password']){
            $sql = mysqli_query($conn, "UPDATE `rider` SET `password` = '$new_pass' WHERE `rider_id` = '".$_SESSION['rider_id']."' ");
            echo $sql ? alert('เปลี่ยนรหัสผ่านสำเร็จ', 'profile.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'password_edit.php');
        } else {
            alert('รหัสเก่าผ่านไม่ถูกต้อง', 'password_edit.php');
        }
    }

?>