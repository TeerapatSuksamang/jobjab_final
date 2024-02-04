<?php

    include_once 'session.php';
    if(isset($_POST['buy_order'])){
        $res_id = $_SESSION['see_res'];
        $user_id = $_SESSION['user_id'];

        $all_food_price = $_POST['all_food_price'];
        $cpn_discount = $_POST['cpn_discount'];
        $sum_price = $_POST['sum_price'];

        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        date_default_timezone_set("Asia/Bankok");
        $date = date("d-m-y");
        $time = date("H:i:s");
        $d = str_replace('-', '', $date);
        $t = str_replace(':', '', $time);

        $order_code = $user_id.$res_id.$d.$t;
        // echo $order_code;

        if($sum_price != 0){
            $sql_order = mysqli_query($conn, "INSERT INTO `order_detail`(`order_code`, `res_id`, `total_food_price`, `cpn_discount`, `sum_price`, `user_id`, `username`, `address`, `phone`, `date`, `time`)
            VALUES('$order_code', '$res_id', '$all_food_price', '$cpn_discount', '$sum_price', '$user_id', '$username', '$address', '$phone', '$date', '$time') ");

            if($sql_order){
                foreach($_SESSION['cart_arr'] as $food_id => $food_qty){
                    $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' AND `res_id` = '$res_id' ");
                    while($row_food = mysqli_fetch_array($select_food)){
                        if($row_food['discount'] != 0){
                            $price = $row_food['new_price'];
                        } else {
                            $price = $row_food['price'];
                        }
                        $sql_food_order = mysqli_query($conn, "INSERT INTO `food_order`(`order_code`, `food_id`, `food_name`, `food_img`, `price`, `new_price`, `qty`, `total_price`)
                        VALUES('$order_code', '".$row_food['food_id']."', '".$row_food['food_name']."', '".$row_food['img']."', '".$row_food['price']."', '".$row_food['new_price']."', '$food_qty', '".$food_qty * $price."' ) ");
                    }
                }
                if($sql_food_order and $sql_order){
                    unset($_SESSION['cart_arr']);
                    alert('สั่งซื้อสำเร็จ กำลังค้นหาไรเดอร์', 'status.php');
                } else {
                    alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'cart.php');
                }
            } else {
                alert('เกิดข้อผิดพลาด กรุณาลองอีกครั้งในภายหลัง', 'cart.php');
            }
        } else {
            alert('ยังไม่มีสินค้าในตะกร้า เลือกดูเมนูที่ต้องการเลย', 'see_restaurant.php');
        }
    }

?>