<?php

    include_once 'session.php';
    if(isset($_GET['order_code'])){
        $order_code = $_GET['order_code'];
        if($_GET['status'] == 0){
            $sql = mysqli_query($conn, "UPDATE `order_detail` SET 
            `status` = 1, 
            `rider_id` = '".$_SESSION['rider_id']."' 
            WHERE `order_code` = '$order_code' ");
            echo $sql ? alert('รับออร์เดอร์แล้ว รอรับอาหารที่ร้านได้เลย', 'status.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'see_restaurant.php');
        } else if($_GET['status'] == 1){
            $status = 2;
        } else if($_GET['status'] == 2){
            $status = 3;
        } else if($_GET['status'] == 3){
            $status = 4;
        }

        $sql = mysqli_query($conn, "UPDATE `order_detail` SET `status` = '$status' WHERE `order_code` = '$order_code' ");
        echo $sql ? alert('อัพเดตสถานะสำเร็จ', 'status.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'status.php');
    }

?>