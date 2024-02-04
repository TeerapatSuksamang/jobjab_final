<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวร้าน</title>
</head>
<body>
    <?php
    
        include 'nav.php';
        $permis = 'user';
        include '../template/banner.php';
    
    ?>

    <ul class="nav nav-tabs ps-5 mb-5" id="review">
        <li class="nav-item ms-5">
            <a href="see_restaurant.php#food" class="nav-link">เมนูอาหาร</a>
        </li>
        <li class="nav-item">
            <a href="see_review.php#review" class="nav-link active">รีวิวร้าน</a>
        </li>
    </ul>

    <div class="container">
        <?php
            $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE (`status` = 5) AND `res_id` = '".$_SESSION['see_res']."' ");
            if($select_order -> num_rows > 0){
                while($row_order = mysqli_fetch_array($select_order)){
                    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '".$row_order['user_id']."' ");
                    $row_user = mysqli_fetch_array($select_user);
        ?>
            <div class="card mb-5 shadow">
                <div class="card-header p-3">
                    <div class="d-flex">
                        <div class="pro-brand">
                            <img src="../upload/<?php echo $row_user['img'] ?>" class="img">
                        </div>
                        <h5 class="mt-2"><?php echo $row_order['username'] ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-secondary"><?php echo $row_order['date'] ?> | <?php echo $row_order['time'] ?></p>
                    <h5><?php echo $row_order['review'] ?></h5>
                    <span class="text-secondary">รายการที่สั่ง : 
                        <?php
                            $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_code` = '".$row_order['order_code']."' ");
                            while($row_food = mysqli_fetch_array($select_food)){
                                echo $row_food['food_name'].', ';
                            }
                        ?>
                    </span>
                </div>
            </div>
        <?php }} else { ?>
            <p class="text-center blockquote-none">ร้านนี้ยังไม่มีรีวิว</p>
        <?php } ?>
    </div>
</body>
</html>