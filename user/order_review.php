<?php

    include_once 'session.php';
    if(isset($_POST['st1'])){
        $_SESSION['star'] = 1;
        header("location: status.php");
    } else if(isset($_POST['st2'])){
        $_SESSION['star'] = 2;
        header("location: status.php");
    } else if(isset($_POST['st3'])){
        $_SESSION['star'] = 3;
        header("location: status.php");
    } else if(isset($_POST['st4'])){
        $_SESSION['star'] = 4;
        header("location: status.php");
    } else if(isset($_POST['st5'])){
        $_SESSION['star'] = 5;
        header("location: status.php");
    }

    if(isset($_POST['submit_review'])){
        $res_id = $_POST['res_id'];
        $order_code = $_POST['order_code'];
        $star = $_SESSION['star'];
        $review = $_POST['review'];

        $ud_order = mysqli_query($conn, "UPDATE `order_detail` SET `star` = '$star', `review` = '$review', `status` = 5 WHERE `order_code` = '$order_code' ");

        // RES
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$res_id' ");
        $row_res = mysqli_fetch_array($select_res);
        $res_all_rating = $row_res['rating'] + $star;
        $res_all_sale = $row_res['qty_sale'] + 1;
        $res_sum_star = $res_all_rating / $res_all_sale;
        $ud_res = mysqli_query($conn, "UPDATE `restaurant` SET `star` = '$res_sum_star', `rating` = '$res_all_rating', `qty_sale` = '$res_all_sale' WHERE `res_id` = '$res_id' ");

        // food
        $select_food_order = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '$order_code' ");
        while($row_food_order = mysqli_fetch_array($select_food_order)){
            $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '".$row_food_order['food_id']."' ");
            $row_food = mysqli_fetch_array($select_food);

            $food_all_rating = $row_food['rating'] + $star;
            $food_all_sale = $row_food['qty_sale'] + 1;
            $food_sum_star = $food_all_rating / $food_all_sale;
            $ud_food = mysqli_query($conn, "UPDATE `food` SET `star` = '$food_sum_star', `rating` = '$food_all_rating', `qty_sale` = '$food_all_sale' WHERE `food_id` = '".$row_food['food_id']."' ");
        }
        echo ($ud_order and $ud_res and $ud_food) ? alert('รีวิวเสร็จสิ้น', 'history.php') : alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง', 'status.php');
    }

?>