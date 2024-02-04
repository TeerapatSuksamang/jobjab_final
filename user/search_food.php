<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหารายการอาหาร</title>
</head>
<body>
    <?php
    
        include 'nav.php';
    
    ?>

    <div class="container">
        <div class="row my-5">
                <h3><a href="see_restaurant.php" class="btn"><h3>&#11148;</h3></a>
                    ค้นหารายการอาหาร
                </h3>
                <form action="search_food.php" class="form-control d-flex p-3 mb-3 shadow" method="post">
                    <input type="search" class="form-control me-2" name="text" placeholder="ค้นหารายการอาหาร" value="<?php echo (isset($_POST['text']) ? $_POST['text'] : '') ?>">
                    <input type="submit" class="btn btn-primary" value="ค้นหา" name="search">
                </form>

            <div class="row">
                <?php
                    if(isset($_POST['text'])){
                        $text = $_POST['text'];
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_name` LIKE '%$text%' AND `res_id` = '".$_SESSION['see_res']."' ");
                    } else {
                        $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `res_id` = '".$_SESSION['see_res']."'");
                    }   
                    if($select_food -> num_rows > 0){
                        while($row_food = mysqli_fetch_array($select_food)){
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                        <a href="" class="text-dark" data-bs-toggle="modal" data-bs-target="#see_food_<?php echo $row_food['food_id'] ?>">
                            <div class="card shadow mb-3">
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
                <?php }} else { ?>
                    <p class="text-center blockquote-footer mt-4">ไม่พบเมนูนี้</p>
                <?php } ?>
            </div>
        </div>
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