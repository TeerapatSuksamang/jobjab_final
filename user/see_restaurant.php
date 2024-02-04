<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
</head>
<body>
    <?php
    
        include 'nav.php';
        $permis = 'user';
        include '../template/banner.php';
        if(!$_SESSION['cart_arr']){
            $_SESSION['cart_arr'] = array();
        }
    
    ?>

    <ul class="nav nav-tabs ps-5 mb-5" id="food">
        <li class="nav-item ms-5">
            <a href="see_restaurant.php#food" class="nav-link active">เมนูอาหาร</a>
        </li>
        <li class="nav-item">
            <a href="see_review.php#review" class="nav-link">รีวิวร้าน</a>
        </li>
    </ul>

    <div class="container-fluid">
        <h1 class="text-center mb-3">หมวดหมู่อาหาร</h1>
        <div class="row mt-4">
            <?php
                $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['see_res']."' ");
                while($row_type = mysqli_fetch_array($select_type)){
            ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                    <a href="#<?php echo $row_type['food_type'] ?>" class="text-dark">
                        <div class="card mb-3">
                            <div class="card-img-top hover-img" style="height: 200px;">
                                <img src="../upload/<?php echo $row_type['img'] ?>" class="img">
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title"><?php echo $row_type['food_type'] ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <hr>
    </div>

    <nav class="navbar navbar-expand navbar-light bg-light sticky-top shadow">
        <a href="search_food.php" class="btn btn-outline-primary mx-2">🔍</a>
        <div class="container-fluid">
            <div class="text-nowrap" id="">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#promotion" class="nav-link">โปรโมชั้น</a>
                    </li>
                    <?php
                        $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['see_res']."' ");
                        while($row_type = mysqli_fetch_array($select_type)){
                    ?>
                        <li class="nav-item">
                            <a href="#<?php echo $row_type['food_type'] ?>" class="nav-link"><?php echo $row_type['food_type'] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="pt-5" id="promotion">
            <h1 class="mt-4">โปรโมชั้น</h1>
            <div class="row">
                <?php
                    $select_pro = mysqli_query($conn, "SELECT * FROM `food` WHERE `discount` != 0 AND `res_id` = '".$_SESSION['see_res']."' ");
                    while($row_pro = mysqli_fetch_array($select_pro)){
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                        <a href="" class="text-dark" data-bs-toggle="modal" data-bs-target="#see_food_<?php echo $row_pro['food_id'] ?>">
                            <div class="card mb-3">
                                <div class="card-img-top hover-img" style="height: 200px;">
                                    <img src="../upload/<?php echo $row_pro['img'] ?>" class="img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row_pro['food_name'] ?></h5>
                                    <h6>
                                        <s class="text-secondary">฿<?php echo $row_pro['price'] ?></s>
                                        <span class="text-success">฿<?php echo $row_pro['new_price'] ?></span>
                                        <span class="text-danger">(ลด <?php echo $row_pro['discount'] ?>%)</span>
                                    </h6>
                                    <p>
                                        <?php
                                            if($row_pro['star'] != 0){
                                                for($i=1; $i<=$row_pro['star']; $i++){
                                                    echo '⭐';
                                                }
                                                echo $row_pro['star'].' ('.$row_pro['qty_sale'].' เรตติ้ง)';
                                            } else {
                                                echo '⭐ยังไม่มีคะแนน';
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>

        <?php
            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '".$_SESSION['see_res']."' ");
            while($row_type = mysqli_fetch_array($select_type)){
        ?>
            <div class="pt-5" id="<?php echo $row_type['food_type'] ?>">
                <h1 class="mt-4"><?php echo $row_type['food_type'] ?></h1>
                <div class="row">
                    <?php
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_type` = '".$row_type['food_type']."' AND `res_id` = '".$_SESSION['see_res']."' ");
                        while($row_food = mysqli_fetch_array($select_food)){
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                            <a href="" class="text-dark" data-bs-toggle="modal" data-bs-target="#see_food_<?php echo $row_food['food_id'] ?>">
                                <div class="card mb-3">
                                    <div class="card-img-top hover-img" style="height: 200px;">
                                        <img src="../upload/<?php echo $row_food['img'] ?>" class="img">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row_food['food_name'] ?></h5>
                                        <h6>
                                            <?php 
                                                if($row_food['discount'] != 0){ 
                                                    $price = $row_food['new_price'];
                                            ?>
                                                <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                                <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                                                <span class="text-danger">(ลด <?php echo $row_food['discount'] ?>%)</span>
                                            <?php } else {
                                                $price = $row_food['price'];
                                                echo '฿'.$price;
                                            } ?>
                                        </h6>
                                        <p>
                                            <?php
                                                if($row_food['star'] != 0){
                                                    for($i=1; $i<=$row_food['star']; $i++){
                                                        echo '⭐';
                                                    }
                                                    echo $row_food['star'].' ('.$row_food['qty_sale'].' เรตติ้ง)';
                                                } else {
                                                    echo '⭐ยังไม่มีคะแนน';
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="modal fade" id="see_food_<?php echo $row_food['food_id'] ?>" tabindex="-1" aria-hidden="true" onmousemove="up_<?php echo $row_food['food_id'] ?>()">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $row_food['food_name'] ?></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="add_cart_db.php" method="post">
                                            <img src="../upload/<?php echo $row_food['img'] ?>" class="img" style="width: 100%; height: 180px;">
                                            <p class="my-3">
                                                <?php 
                                                    if($row_food['discount'] != 0){ 
                                                        $price = $row_food['new_price'];
                                                ?>
                                                    <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                                    <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                                                    <span class="text-danger">(ลด <?php echo $row_food['discount'] ?>%)</span>
                                                <?php } else {
                                                    $price = $row_food['price'];
                                                    echo '฿'.$price;
                                                } ?>
                                            </p>
                                            <div class="d-flex gap-2">
                                                <p class="btn btn-primary" onclick="plus_<?php echo $row_food['food_id'] ?>()">+</p>
                                                <input type="number" class="form-control h-25" name="qty" min="0" id="qty_<?php echo $row_food['food_id'] ?>" value="1">
                                                <p class="btn btn-warning" onclick="minus_<?php echo $row_food['food_id'] ?>()">-</p>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                            <input type="hidden" value="<?php echo $row_food['food_id'] ?>" name="food_id">
                                            <input type="submit" class="btn btn-outline-success" id="sum_<?php echo $row_food['food_id'] ?>" name="add_cart" value="เพิ่มลงตะกร้า ฿<?php echo $price ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function plus_<?php echo $row_food['food_id'] ?>(){
                                var input = document.getElementById('qty_<?php echo $row_food['food_id'] ?>');
                                var input_value = parseInt(input.value);
                                input.value = input_value + 1;

                                var sum = document.getElementById('sum_<?php echo $row_food['food_id'] ?>');
                                sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
                            }

                            function minus_<?php echo $row_food['food_id'] ?>(){
                                var input = document.getElementById('qty_<?php echo $row_food['food_id'] ?>');
                                var input_value = parseInt(input.value);
                                if(input_value > 1){
                                    input.value = input_value - 1;
                                    var sum = document.getElementById('sum_<?php echo $row_food['food_id'] ?>');
                                    sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
                                }
                            }

                            function up_<?php echo $row_food['food_id'] ?>(){
                                var input = document.getElementById('qty_<?php echo $row_food['food_id'] ?>');
                                var input_value = parseInt(input.value);
                                var sum = document.getElementById('sum_<?php echo $row_food['food_id'] ?>');
                                sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
                            }

                        </script>
                    <?php } ?>

                </div>
            </div>
            <hr>

        <?php } ?>
    </div>

    <div class="container">
        <div class="position-fixed bottom-0 end-0 p-3">
            <a href="cart.php" class="position-relative btn btn-outline-primary mx-2">
                <h3>🛒</h3>
                <?php if(count($_SESSION['cart_arr']) > 0){ ?>
                    <span class="position-absolute top-0 start-100 bg-danger rounded-pill translate-middle badge"><?php echo count($_SESSION['cart_arr']) ?></span>
                <?php } ?>
            </a>
        </div>
    </div>
</body>
</html>